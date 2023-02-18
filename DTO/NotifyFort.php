<?php

namespace MElaraby\Payfort\DTO;

use Illuminate\Support\Traits\Macroable;
use Spatie\DataTransferObject\DataTransferObject;

class NotifyFort extends DataTransferObject
{
    use Macroable;

    private readonly string $merchant_reference;
    private readonly string $tokenName;
    private readonly int $amount;
    private readonly string $customerIp;
    private readonly string $customerEmail;
    private readonly string $customerName;
    private readonly string $returnURL;
    private bool $check3DS = false;
    private readonly string $currency;

    /**
     * @return string|null
     */
    public function getMerchantReference(): ?string
    {
        return $this->merchant_reference;
    }

    /**
     * @param string|null $merchant_reference
     * @return NotifyFort
     */
    public function setMerchantReference(?string $merchant_reference): NotifyFort
    {
        $this->merchant_reference = $merchant_reference;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTokenName(): ?string
    {
        return $this->tokenName;
    }

    /**
     * @param string|null $tokenName
     * @return NotifyFort
     */
    public function setTokenName(?string $tokenName): NotifyFort
    {
        $this->tokenName = $tokenName;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return NotifyFort
     */
    public function setAmount(int $amount): NotifyFort
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerIp(): string
    {
        return $this->customerIp;
    }

    /**
     * @param string $customerIp
     * @return NotifyFort
     */
    public function setCustomerIp(string $customerIp): NotifyFort
    {
        $this->customerIp = $customerIp;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     * @return NotifyFort
     */
    public function setCustomerEmail(string $customerEmail): NotifyFort
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     * @return NotifyFort
     */
    public function setCustomerName(string $customerName): NotifyFort
    {
        $this->customerName = $customerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnURL(): string
    {
        return $this->returnURL;
    }

    /**
     * @param string $returnURL
     * @return NotifyFort
     */
    public function setReturnURL(string $returnURL): NotifyFort
    {
        $this->returnURL = $returnURL;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCheck3DS(): bool
    {
        return $this->check3DS;
    }

    /**
     * @param bool $check3DS
     * @return NotifyFort
     */
    public function setCheck3DS(bool $check3DS): NotifyFort
    {
        $this->check3DS = $check3DS;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return strtoupper($this->currency);
    }

    /**
     * @return bool|null
     */
    public function isHaveCurrency(): ?bool
    {
        return !empty($this->currency);
    }

    /**
     * @param string|null $currency
     * @return NotifyFort
     */
    public function setCurrency(?string $currency): NotifyFort
    {
        $this->currency = $currency;
        return $this;
    }

}
