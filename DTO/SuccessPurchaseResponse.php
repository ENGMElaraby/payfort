<?php

namespace MElaraby\Payfort\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SuccessPurchaseResponse extends DataTransferObject
{
    public ?string $amount;
    public ?string $response_code;
    public ?string $card_number;
    public ?string $signature;
    public ?string $merchant_identifier;
    public ?string $access_code;
    public ?string $payment_option;
    public ?string $expiry_date;
    public ?string $customer_ip;
    public ?string $language;
    public ?string $eci;
    public ?string $fort_id;
    public ?string $check_3ds;
    public ?string $command;
    public ?string $response_message;
    public ?string $merchant_reference;
    public ?string $authorization_code;
    public ?string $customer_email;
    public ?string $token_name;
    public ?string $currency;
    public ?string $customer_name;
    public ?string $acquirer_response_code;
    public ?string $status;

    /**
     * @return array
     */
    public function getArrayWithoutNulls(): array
    {
        $postData = $this->toArray();
        foreach ($postData as $key => $value) {
            if (is_null($value)) {
                unset($postData[$key]);
            }
        }
        return $postData;
    }

    public function get(string $param)
    {
        return $this->$param;
    }
}
