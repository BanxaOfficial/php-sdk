<?php

namespace Banxa\Domains\Prices;

use Banxa\Domains\Domain;
use Banxa\Library\KeyConstants;

class GetPrices extends Domain
{

    /**
     * @var string
     */
    private string $path = 'api/prices';

    /**
     * @var string
     */
    private string $source;

    /**
     * @var string
     */
    private string $target;

    /**
     * @var string|float
     */
    private string|float $source_amount;

    /**
     * @var string|int|null
     */
    private string|int|null $payment_method_id;

    /**
     * @var string|null
     */
    private null|string $blockchain;

    /**
     * @param string $source
     * @return GetPrices
     */
    public function setSource(string $source): GetPrices
    {
        $this->source = strtoupper($source);
        return $this;
    }

    /**
     * @param string $target
     * @return GetPrices
     */
    public function setTarget(string $target): GetPrices
    {
        $this->target = strtoupper($target);
        return $this;
    }

    /**
     * @param float|string $source_amount
     * @return GetPrices
     */
    public function setSourceAmount(float|string $source_amount): GetPrices
    {
        $this->source_amount = $source_amount;
        return $this;
    }


    /**
     * @param string|int|null $payment_method_id
     * @return GetPrices
     */
    public function setPaymentMethodId(string|int|null $payment_method_id): GetPrices
    {
        $this->payment_method_id = $payment_method_id;
        return $this;
    }

    /**
     * @param null|string $blockchain
     * @return GetPrices
     */
    public function setBlockchain(null|string $blockchain): GetPrices
    {
        $this->blockchain = $blockchain;
        return $this;
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return string
     */
    private function buildPath(): string
    {
        return $this->path . '?' . http_build_query($this->buildParameters());
    }

    /**
     * @return array
     */
    private function buildParameters(): array
    {
        return array_filter([
            KeyConstants::_SOURCE            => $this->getSource(),
            KeyConstants::_TARGET            => $this->getTarget(),
            KeyConstants::_SOURCE_AMOUNT     => $this->getSourceAmount(),
            KeyConstants::_PAYMENT_METHOD_ID => $this->getPaymentMethodId(),
            KeyConstants::_BLOCKCHAIN        => $this->getBlockchain(),
        ]);
    }

    /**
     * @return string
     */
    private function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    private function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return string|float
     */
    private function getSourceAmount(): string|float
    {
        return $this->source_amount;
    }


    /**
     * @return string|int|null
     */
    private function getPaymentMethodId(): string|int|null
    {
        return $this->payment_method_id;
    }

    /**
     * @return string|null
     */
    private function getBlockchain(): string|null
    {
        return $this->blockchain;
    }

}