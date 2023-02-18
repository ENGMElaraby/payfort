<?php

namespace MElaraby\Payfort\DTO;

use MElaraby\{Payfort\ResponseCodes, Payfort\ResponseMessages};
use Illuminate\Support\Traits\Macroable;
use Spatie\{DataTransferObject\DataTransferObject, DataTransferObject\Exceptions\UnknownProperties};

class TokenizationResponse extends DataTransferObject
{
    use Macroable;

    /**
     * @throws UnknownProperties
     */
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->splitResponseCode();
    }

    public readonly ?string $card_number;
    public readonly ?string $card_holder_name;
    public readonly string $signature;
    public readonly ?string $payment_option;
    public readonly string $merchant_identifier;
    public readonly ?string $expiry_date;
    public readonly string $access_code;
    public readonly string $language;
    public readonly string $service_command;
    public readonly string $response_message;
    public readonly string $merchant_reference;
    public readonly string $token_name;
    public readonly string $return_url;
    public readonly ?string $card_bin;
    public readonly string $status;
    public readonly string $response_code;
    public ?string $statusCode;
    public ?string $responseCode;

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
     * @return $this
     */
    public function splitResponseCode(): self
    {
        $this->statusCode = substr($this->response_code, 0, 2);
        $this->responseCode = substr($this->response_code, 2, 5);
        return $this;
    }

    /**
     * @return string[]
     */
    public function exceptParameters(): array
    {
        return ['signature', 'statusCode', 'responseCode', 'service', 'isSuccess'];
    }

    /**
     * @return bool
     */
    public function isTokenizationSuccess(): bool
    {
        return $this->statusCode === ResponseCodes::TokenizationSuccess->value;
    }

    /**
     * @return bool
     */
    public function isTokenizationAlreadyExist(): bool
    {
        return $this->responseCode === ResponseMessages::TokenAlreadyExist->value;
    }

    public function isCardInvalid(): bool
    {
        return $this->responseCode === ResponseMessages::InvalidCardNumber->value;
    }

    public function isCardHolderValid(): bool
    {
        return $this->responseCode === ResponseMessages::InvalidParameterFormat->value;
    }

    public function isInvalidExpiryDate(): bool
    {
        return $this->responseCode === ResponseMessages::InvalidExpiryDate->value;
    }

    /**
     * @return bool
     */
    public function isTransactionBlockedByFraudCheck(): bool
    {
        return $this->responseCode === ResponseMessages::TransactionBlockedByFraudCheck->value;
    }


}
