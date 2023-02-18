<?php

namespace MElaraby\Payfort;

use MElaraby\{Payfort\DTO\Configuration,
    Payfort\DTO\FormData,
    Payfort\DTO\PostDataServerToServer,
    Payfort\DTO\response3DS,
    Payfort\DTO\TokenizationResponse,
    Payfort\Helpers\PayfortHelpers};
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class Payfort
{
    /**
     * @var string  command
     * expected Values ("AUTHORIZATION", "PURCHASE")
     */
    protected string $command = 'PURCHASE';

    /**
     * @var Configuration
     * @props string merchant_identifier your Merchant Identifier account (mid)
     * @props string access_code your access code
     * @props string sha_request_phrase your SHA Request passphrase
     * @props string sha_response_phrase your SHA Response passphrase
     * @props string sha_type your SHA Type (Hash Algorithm) expected Values ("sha1", "sha256", "sha512")
     * @props string currency is order currency
     * @props boolean sandbox is for live account
     */
    private readonly Configuration $configuration;

    /**
     * @throws UnknownProperties
     */
    public function __construct()
    {
        $this->configuration = new Configuration(config('payfort'));
    }

    /**
     * @param array|string|null $parameter
     * @return Configuration|array|string
     */
    protected function getConfiguration(array|string $parameter = null): Configuration|array|string
    {
        if (is_array($parameter)) {
            $configuration = [];
            foreach ($parameter as $param) {
                $configuration[$param] = $this->configuration->$param;
            }
            return $configuration;
        }

        if ($parameter) {
            return $this->configuration->$parameter;
        }

        return $this->configuration;
    }

    /**
     * Function to calc payfort request/response signature following payfort documentation
     *
     * @see https://docs.payfort.com/docs/in-common/build/index.html#signature
     *
     * @param TokenizationResponse $parameters
     * @return string
     */
    public function parseResponseSignature(response3DS|TokenizationResponse $parameters): string
    {
        $arrayParameters = $parameters->except(...$parameters->exceptParameters())->getArrayWithoutNulls();
        ksort($arrayParameters);
        $combinedParams = array_map(static function ($key, $value) {
            return "$key=$value";
        }, array_keys($arrayParameters), array_values($arrayParameters));
        $stringParameters = implode('', $combinedParams);
        $salt = $this->getConfiguration('sha_response_phrase');
        $signature = sprintf('%s%s%s', $salt, $stringParameters, $salt);
        return hash($this->getConfiguration('sha_type'), $signature);
    }

    /**
     * @param FormData|PostDataServerToServer $parameters
     * @param array $except
     * @return void
     */
    protected function calculateRequestSignature(FormData|PostDataServerToServer $parameters, array $except = []): void
    {
        $arrayParameters = $parameters;
        if (count($except)) {
            $arrayParameters = $arrayParameters->except(...$except);
        }
        $arrayParameters = $arrayParameters->toArray();
        ksort($arrayParameters);
        $combinedParams = array_map(static function ($key, $value) {
            return "$key=$value";
        }, array_keys($arrayParameters), array_values($arrayParameters));
        $stringParameters = implode('', $combinedParams);
        $salt = $this->getConfiguration('sha_request_phrase');
        $signature = sprintf('%s%s%s', $salt, $stringParameters, $salt);
        $parameters->signature = hash($this->getConfiguration('sha_type'), $signature);
    }

    /**
     * @param string|int|null $token
     * @return string
     */
    protected function generateTokenName(string|int|null $token): string
    {
        $randomString = time() . '_' . Str::random();

        if (is_null($token)) {
            return sprintf('_%s', $randomString);
        }

        return sprintf('%s_%s', $token, $randomString);
    }

    /**
     * get url of payfort api if sandbox on or off
     * @param bool $isAPI
     * @return string
     */
    protected function getPaymentURL(bool $isAPI = false): string
    {
        if ($isAPI) {
            if ($this->getConfiguration('sandbox')) {
                return $this->getConfiguration('gateway_sandbox_host_api');
            }
            return $this->getConfiguration('gateway_host_api');
        }

        if ($this->getConfiguration('sandbox')) {
            return sprintf('%sFortAPI/paymentPage', $this->getConfiguration('gateway_sandbox_host'));
        }

        return sprintf('%sFortAPI/paymentPage', $this->getConfiguration('gateway_host'));
    }

    /**
     * @param FormData $postData
     * @param bool $autoSubmit
     * @return string
     */
    protected function generatePaymentForm(FormData $postData, bool $autoSubmit = false): string
    {
        $form = PayfortHelpers::asHTML("<form style='display:none' name='payfort_payment_form' id='payfort_payment_form' method='post' action='{$this->getPaymentURL()}'>");

        foreach ($postData->toArrayWithoutNulls() as $name => $value) {
            $form .= PayfortHelpers::asHTML("<input type='hidden' name='$name' value='$value'> ");
        }

        $form .= PayfortHelpers::asHTML('<input type=\'submit\' id=\'submit\'></form>');

        if ($autoSubmit) {
            $form .= PayfortHelpers::asHTML('<script>document.getElementById(\'submit\').click();</script>');
        }

        return $form;
    }

    /**
     * @param response3DS|TokenizationResponse $response
     * @param bool $throwValidationException
     * @return bool
     * @throws ValidationException
     */
    public function isSignatureValid(response3DS|TokenizationResponse $response, bool $throwValidationException = true): bool
    {
        $parseSignature = $this->parseResponseSignature($response);

        if ($response->signature === $parseSignature) {
            return true;
        }

        if ($throwValidationException) {
            throw ValidationException::withMessages([
                'request_failed' => ['Unfortunately your request has failed, Invalid Signature']
            ]);
        }
        return false;
    }



    /**
     * Send server to server request to the Fort
     *
     * @param PostDataServerToServer|array $postData
     * @param string $gatewayUrl
     * @return mixed
     */
    protected function executeCommand(PostDataServerToServer|array $postData, string $gatewayUrl): mixed
    {
        if ($postData instanceof PostDataServerToServer) {
            $postData = $postData->toArray();
        }
        $response = Http::withHeaders(['Content-Type: application/json;charset=UTF-8'])
            ->withUserAgent("Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0")
            ->connectTimeout(0)
            ->post($gatewayUrl, $postData);
        return $response->json();
    }
}
