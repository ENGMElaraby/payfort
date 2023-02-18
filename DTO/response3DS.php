<?php

namespace MElaraby\Payfort\DTO;

use MElaraby\{Payfort\ResponseCodes, Payfort\ResponseMessages};
use Spatie\DataTransferObject\DataTransferObject;

class response3DS extends DataTransferObject
{
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->splitResponseCode();
    }

    public string $amount;
    public string $response_code;
    public string $card_number;
    /**
     * @var null|string for is mobile
     */
    public readonly ?string $merchant_extra1;
    public ?string $card_holder_name;
    public string $signature;
    public string $merchant_identifier;
    public string $access_code;
    public string $payment_option;
    public string $expiry_date;
    public string $customer_ip;
    public string $language;
    public string $eci;
    public string $fort_id;
    public string $command;
    public string $response_message;
    public string $merchant_reference;
    public string $customer_email;
    public string $currency;
    public string $customer_name;
    public ?string $token_name;
    public ?string $authorization_code;
    public ?string $acquirer_response_code;
    public string $status;
    public ?string $statusCode;
    public ?string $responseCode;
    public ?string $service;


    /**
     * @return $this
     */
    public function splitResponseCode(): self
    {
        $this->responseCode = substr($this->response_code, 0, 2);
        $this->statusCode = substr($this->response_code, 2, 5);
        return $this;
    }

    public function exceptParameters(): array
    {
        return ['signature', 'statusCode', 'responseCode', 'service'];
    }

    /**
     * @return array
     */
    public function getArrayWithoutNulls(): array
    {
        $postData = $this->toArray();
        foreach ($postData as $key => $value) {
            if (is_null($value)){
                unset($postData[$key]);
            }
        }
        return $postData;
    }

    /**
     * @return bool
     */
    public function isPurchaseSuccess(): bool
    {
        return $this->responseCode === \App\Integrations\Payment\Payfort\ResponseCodes::PurchaseSuccess->value;
    }

    /**
     * @return bool
     */
    public function isAuthenticationFailed(): bool
    {
        return $this->statusCode === \App\Integrations\Payment\Payfort\ResponseMessages::AuthenticationFailed->value;
    }

    /**
     * @return bool
     */
    public function isTransactionDeclined(): bool
    {
        return $this->statusCode === ResponseMessages::TransactionDeclined->value;
    }

    /**
     * @return bool
     */
    public function isPurchaseFailure(): bool
    {
        return $this->statusCode === ResponseCodes::PurchaseFailure->value;
    }

    /**
     * @return bool
     */
    public function isTransactionBlockedByFraudCheck(): bool
    {
        return $this->statusCode === ResponseMessages::TransactionBlockedByFraudCheck->value;
    }

    /**
     * @return bool
     */
    public function isInsufficientFunds(): bool
    {
        return $this->statusCode === ResponseMessages::InsufficientFunds->value;
    }

    /**
     * @return bool
     */
    public function isIncomplete(): bool
    {
        return $this->statusCode === ResponseCodes::Incomplete->value;
    }
}
