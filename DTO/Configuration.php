<?php

namespace MElaraby\Payfort\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Configuration extends DataTransferObject
{
    public bool $sandbox = false;

    public string $merchant_identifier;

    public string $access_code;
    public string $sha_type;
    public string $sha_request_phrase;
    public string $sha_response_phrase;

    public string $currency;
    public string $gateway_host;
    public string $gateway_sandbox_host;
    public string $gateway_host_api;
    public string $gateway_sandbox_host_api;

    public string $language;
}
