<?php

namespace MElaraby\Payfort\DTO;

use MElaraby\Payfort\Helpers\PayfortHelpers;
use Spatie\{DataTransferObject\DataTransferObject, DataTransferObject\Exceptions\UnknownProperties};

class FormRequest extends DataTransferObject
{
    private string $merchantReference;
    private string $cardHolderName;
    private string $cardNumber;
    private string $expiryDate;
    private string $cardSecurityCode;
    private string $tokenName;
    private string $merchant_extra;
    private string $merchant_extra1;

    /**
     * @throws UnknownProperties
     */
    public function __construct()
    {
        parent::__construct([]);
        $this->tokenName = PayfortHelpers::generateTokenName();

    }

    /**
     * @return string
     */
    public function getMerchantExtra(): string
    {
        return $this->merchant_extra;
    }

    /**
     * @param string $merchant_extra
     * @return FormRequest
     */
    public function setMerchantExtra(string $merchant_extra): FormRequest
    {
        $this->merchant_extra = $merchant_extra;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantExtra1(): string
    {
        return $this->merchant_extra1;
    }

    /**
     * @param string $merchant_extra1
     * @return FormRequest
     */
    public function setMerchantExtra1(string $merchant_extra1): FormRequest
    {
        $this->merchant_extra1 = $merchant_extra1;
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenName(): string
    {
        return $this->tokenName;
    }

    /**
     * @param string $tokenName
     * @return FormRequest
     */
    public function setTokenName(string $tokenName): FormRequest
    {
        $this->tokenName = PayfortHelpers::generateTokenName($tokenName);
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolderName(): string
    {
        return $this->cardHolderName;
    }

    /**
     * @param string $cardHolderName
     * @return FormRequest
     */
    public function setCardHolderName(string $cardHolderName): FormRequest
    {
        $this->cardHolderName = $cardHolderName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     * @return FormRequest
     */
    public function setCardNumber(string $cardNumber): FormRequest
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiryDate(): string
    {
        return $this->expiryDate;
    }

    /**
     * @param string $expiryDate
     * @return FormRequest
     */
    public function setExpiryDate(string $expiryDate): FormRequest
    {
        $this->expiryDate = $expiryDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardSecurityCode(): string
    {
        return $this->cardSecurityCode;
    }

    /**
     * @param string $cardSecurityCode
     * @return FormRequest
     */
    public function setCardSecurityCode(string $cardSecurityCode): FormRequest
    {
        $this->cardSecurityCode = $cardSecurityCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantReference(): string
    {
        return $this->merchantReference;
    }

    /**
     * @param string $merchantReference
     * @return FormRequest
     */
    public function setMerchantReference(string $merchantReference): FormRequest
    {
        $this->merchantReference = $merchantReference;
        return $this;
    }
}
