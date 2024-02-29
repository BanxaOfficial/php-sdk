<?php

namespace Banxa\Domains\Orders;

use Banxa\Domains\Domain;
use Banxa\Domains\Orders\Builders\OptionalOrderParameters;
use Banxa\Domains\Orders\Builders\OrderTransaction;
use Banxa\Library\KeyConstants;

class CreateOrder extends Domain
{
    /**
     * @var string
     */
    private string $path = 'api/orders';
    private OptionalOrderParameters|null $optionalOrderParameters = null;

    public function setOptionOrderParameters(OptionalOrderParameters|null $optionalOrderParameters): static
    {
        $this->optionalOrderParameters = $optionalOrderParameters;
        return $this;
    }

    /**
     * @param OrderTransaction $orderTransaction
     * @param string $returnUrlOnSuccess
     * @param string|null $returnUrlOnFailure
     * @param string|null $returnUrlOnCancelled
     * @param string|null $metaData
     * @param bool $readOnlyAmounts
     * @param string|null $iframeRefererDomain
     * @return array
     */
    protected function buildPayload(
        OrderTransaction $orderTransaction,
        string $returnUrlOnSuccess,
        string|null $returnUrlOnFailure,
        string|null $returnUrlOnCancelled,
        string|null $metaData,
        bool $readOnlyAmounts,
        string|null $iframeRefererDomain,
    ): array {
        $payload = array_filter(
            array_merge(
                $orderTransaction->toArray(),
                array_filter([
                    KeyConstants::_RETURN_URL_TYPE_ON_SUCCESS => $returnUrlOnSuccess,
                    KeyConstants::_RETURN_URL_TYPE_ON_FAILURE => $returnUrlOnFailure,
                    KeyConstants::_RETURN_URL_TYPE_ON_CANCELLED => $returnUrlOnCancelled,
                ])
            )
        );
        if (isset($this->optionalOrderParameters)) {
            $payload = array_merge($payload, $this->optionalOrderParameters->toArray());
        }
        if ($readOnlyAmounts) {
            $payload = array_merge(
                $payload,
                [KeyConstants::_OPTIONS => [KeyConstants::_READONLY_AMOUNTS => $readOnlyAmounts]]
            );
        }

        if ($metaData) {
            $payload = array_merge($payload, [KeyConstants::_META_DATA => $metaData]);
        }

        if ($iframeRefererDomain) {
            $payload = array_merge($payload, [KeyConstants::_IFRAME_REFERER_DOMAIN => $iframeRefererDomain]);
        }

        return $payload;
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->path;
    }

}