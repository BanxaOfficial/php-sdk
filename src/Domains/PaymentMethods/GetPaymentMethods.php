<?php

namespace Banxa\Domains\PaymentMethods;

use Banxa\Domains\Domain;
use Banxa\Library\KeyConstants;

class GetPaymentMethods extends Domain
{

    /**
     * @var string
     */
    private string $path = 'api/payment-methods';

    /**
     * @var string|null
     */
    private null|string $source;

    /**
     * @var string|null
     */
    private null|string $target;

    /**
     * @return string
     */
    private function buildPath(): string
    {
        return ($this->getSource() && $this->getTarget())
            ? $this->path . '?' . http_build_query($this->buildParameters())
            : $this->path;
    }

    /**
     * @return array
     */
    private function buildParameters(): array
    {
        return array_filter([
            KeyConstants::_SOURCE => $this->getSource(),
            KeyConstants::_TARGET => $this->getTarget(),
        ]);
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return string|null
     */
    private function getSource(): null|string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return GetPaymentMethods
     */
    public function setSource(null|string $source): GetPaymentMethods
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string|null
     */
    private function getTarget(): null|string
    {
        return $this->target;
    }

    /**
     * @param string|null $target
     * @return GetPaymentMethods
     */
    public function setTarget(null|string $target): GetPaymentMethods
    {
        $this->target = $target;
        return $this;
    }

}