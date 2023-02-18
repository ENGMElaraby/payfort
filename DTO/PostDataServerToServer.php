<?php

namespace MElaraby\Payfort\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class PostDataServerToServer extends DataTransferObject
{
    public string $merchant_reference;
    public string $access_code;
    public string $command;
    public string $merchant_identifier;
    public ?string $customer_ip;
    public int $amount;
    public string $currency;
    public string $customer_email;
    public string $customer_name;
    public string $token_name;
    public string $language;
    public ?string $return_url;
    public ?string $check_3ds;
    public ?string $signature;

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
}
