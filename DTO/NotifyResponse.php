<?php

namespace MElaraby\Payfort\DTO;

use Illuminate\Support\Traits\Macroable;
use MElaraby\{Payfort\ResponseCodes, Payfort\ResponseMessages};
use Spatie\{DataTransferObject\DataTransferObject, DataTransferObject\Exceptions\UnknownProperties};

class NotifyResponse extends DataTransferObject
{
    use Macroable;

    /**
     * @param ...$args
     * @throws UnknownProperties
     */
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->splitResponseCode();
    }

    public string $amount;
    public string $response_code;
    public readonly ?string $merchant_extra1;
    public ?string $card_number;
    public string $signature;
    public string $merchant_identifier;
    public string $access_code;
    public ?string $payment_option;
    public ?string $expiry_date;
    public string $customer_ip;
    public string $language;
    public ?string $eci;
    public ?string $fort_id;
    public string $command;
    public ?string $URL3DS;
    public string $response_message;
    public string $merchant_reference;
    public string $customer_email;
    public string $currency;
    public string $customer_name;
    public string $status;
    public ?string $statusCode;
    public ?string $responseCode;


    /**
     * @return $this
     */
    public function splitResponseCode(): self
    {
        $this->statusCode = substr($this->response_code, 0, 2);
        $this->responseCode = substr($this->response_code, 2, 5);
        return $this;
    }

    /**
     * @return bool
     */
    public function isNotifySuccess(): bool
    {
        return $this->isStatusSuccess()
            && $this->isMessageCodeSuccess();
    }

    /**
     * @return bool
     */
    public function isStatusSuccess(): bool
    {
        return $this->statusCode === ResponseCodes::OnHold->value;
    }

    /**
     * @return bool
     */
    public function isMessageCodeSuccess(): bool
    {
        return $this->responseCode === ResponseMessages::ThreeDSecureCheckRequested->value;
    }

    /**
     * @return bool
     */
    public function isDuplicateOrderNumber(): bool
    {
        return $this->isStatusInvalid()
            && $this->responseCode === ResponseMessages::DuplicateOrderNumber->value;
    }

    /**
     * @return bool
     */
    public function isStatusInvalid(): bool
    {
        return $this->statusCode === ResponseCodes::InvalidRequest->value;
    }

    /**
     * @return bool
     */
    public function isTransactionDeclined(): bool
    {
        return $this->responseCode === ResponseMessages::TransactionDeclined->value;
    }

    /**
     * @return bool
     */
    public function isTransactionBlockedByFraudCheck(): bool
    {
        return $this->responseCode === ResponseMessages::TransactionBlockedByFraudCheck->value;
    }

}
