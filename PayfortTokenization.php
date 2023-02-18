<?php

namespace MElaraby\Payfort;

use MElaraby\{Payfort\DTO\FormData,
    Payfort\DTO\FormRequest,
    Payfort\DTO\NotifyFort,
    Payfort\DTO\NotifyResponse,
    Payfort\DTO\PostDataServerToServer
};
use Illuminate\Support\Facades\Http;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class PayfortTokenization extends Payfort
{

    /**
     * @param FormRequest $formRequest
     * @return string
     * @throws UnknownProperties
     */
    public function generateFormRequest(FormRequest $formRequest): string
    {
        $formData = $this->prepareFormData($formRequest);

        return $this->generatePaymentForm($formData);
    }

    /**
     * @param string $merchantReference
     * @param string|float|int $price
     * @return FormData
     * @throws UnknownProperties
     */
    private function prepareFormData(FormRequest $formRequest): FormData
    {
        $formData = new FormData([
            'service_command' => 'TOKENIZATION',
            'language' => $this->getConfiguration('language'),
            'merchant_identifier' => $this->getConfiguration('merchant_identifier'),
            'access_code' => $this->getConfiguration('access_code'),
            'merchant_reference' => $formRequest->getMerchantReference(),
            'token_name' => $formRequest->getTokenName(),
            'card_holder_name' => $formRequest->getCardHolderName(),
            'card_number' => $formRequest->getCardNumber(),
            'expiry_date' => $formRequest->getExpiryDate(),
            'card_security_code' => $formRequest->getCardSecurityCode(),
            'return_url' => route('payment.web-response')
        ]);
        $this->calculateRequestSignature($formData, [
            'card_holder_name',
            'card_number',
            'expiry_date',
            'card_security_code',
            'signature',
        ]);
        return $formData;
    }


    /**
     * @param NotifyFort $fortParams
     * @param bool $useSavedCard
     * @return NotifyResponse
     * @throws UnknownProperties
     */
    public function merchantPageNotifyFort(NotifyFort $fortParams): NotifyResponse
    {
        $postDataServerToServer = new PostDataServerToServer([
            'merchant_reference' => $fortParams->getMerchantReference(),
            'access_code' => $this->getConfiguration('access_code'),
            'command' => $this->command,
            'merchant_identifier' => $this->getConfiguration('merchant_identifier'),
            'customer_ip' => $fortParams->getCustomerIp(),
            'amount' => (int)round($fortParams->getAmount()) * (10 ** 2),
            'currency' => $fortParams->isHaveCurrency() ? $fortParams->getCurrency() : strtoupper($this->getConfiguration('currency')),
            'customer_email' => $fortParams->getCustomerEmail(),
            'customer_name' => $fortParams->getCustomerName(),
            'token_name' => $fortParams->getTokenName(),
            'language' => $this->getConfiguration('language'),
            'return_url' => $fortParams->getReturnURL(),
        ]);

        $except[] = 'signature';

        if (!$fortParams->isCheck3DS()) {
            $postDataServerToServer = $postDataServerToServer->except('check_3ds');
            $except[] = 'check_3ds';
        }

        $this->calculateRequestSignature($postDataServerToServer, $except);

        $response = $this->executeCommand($postDataServerToServer, $this->getPaymentURL(true));

        if ($fortParams->isCheck3DS()) {
            $response['URL3DS'] = $response['3ds_url'];
            unset($response['3ds_url']);
        }

        return new NotifyResponse($response);
    }



}
