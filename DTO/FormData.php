<?php

namespace MElaraby\Payfort\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class FormData extends DataTransferObject
{

    /**
     * @var string $service_command
     * expected Values ("AUTHORIZATION", "PURCHASE", "TOKENIZATION")
     */
    public string $service_command = 'TOKENIZATION';
    public readonly string $language;
    public readonly string $merchant_identifier;
    public readonly string $token_name;
    public readonly string $access_code;
    public readonly string $merchant_reference;
    public readonly string $card_holder_name;
    public readonly string $card_number;
    public readonly string $expiry_date;
    public readonly string $card_security_code;
    public readonly string $return_url;
    public ?string $signature;


    /**
     * @return array
     */
    public function toArrayWithoutNulls(): array
    {
        $postData = $this->toArray();
        foreach ($postData as $key => $value) {
            if (is_null($value)) {
                unset($postData[$key]);
            }
        }
        return $postData;
    }
}
