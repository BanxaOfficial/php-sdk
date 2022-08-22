<?php

namespace Banxa\Domains\Orders;

use Banxa\Domains\Domain;
use Banxa\Domains\Orders\Builders\NftData;
use Banxa\Domains\Orders\Builders\OrderTransaction;
use Banxa\Library\KeyConstants;

class CreateNftOrder extends Domain
{
    /**
     * @var string
     */
    private string $path = 'api/orders/nft/buy';

    /**
     * @param OrderTransaction $orderTransaction
     * @param NftData $nftData
     * @param string $returnUrlOnSuccess
     * @param string|null $returnUrlOnFailure
     * @param string|null $returnUrlOnCancelled
     * @param string|null $iframeRefererDomain
     * @return array
     */
    protected function buildPayload(
        OrderTransaction $orderTransaction,
        NftData $nftData,
        string $returnUrlOnSuccess,
        string|null $returnUrlOnFailure,
        string|null $returnUrlOnCancelled,
        string|null $iframeRefererDomain,

    ): array {
        $payload = array_filter(
            array_merge($orderTransaction->toArray(), $nftData->toArray(), array_filter([
                KeyConstants::_RETURN_URL_TYPE_ON_SUCCESS   => $returnUrlOnSuccess,
                KeyConstants::_RETURN_URL_TYPE_ON_FAILURE   => $returnUrlOnFailure,
                KeyConstants::_RETURN_URL_TYPE_ON_CANCELLED => $returnUrlOnCancelled,
            ]))
        );

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