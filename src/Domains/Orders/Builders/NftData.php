<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class NftData
{
    /**
     * @param string $purchaseReference
     * @param Nft $nft
     * @param array|null $metaData
     */
    public function __construct(
        private string $purchaseReference,
        private Nft $nft,
        private array|null $metaData
    ) {
    }

    /**
     * @return string
     */
    public function getPurchaseReference(): string
    {
        return $this->purchaseReference;
    }

    /**
     * @return Nft
     */
    public function getNft(): Nft
    {
        return $this->nft;
    }

    /**
     * @return array|null
     */
    public function getMetaData(): ?array
    {
        return $this->metaData;
    }

    /**
     * @param string $purchaseReference
     * @param Nft $nft
     * @param array|null $metaData
     * @return static
     */
    public static function create(string $purchaseReference, Nft $nft, array|null $metaData = null): static
    {
        return new static($purchaseReference, $nft, $metaData);
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            KeyConstants::_META_DATA => array_merge([
                KeyConstants::_PURCHASE_REFERENCE => $this->getPurchaseReference(),
                KeyConstants::_NFT                => $this->getNft()?->toArray(),
            ], $this->getMetaData() ?? [])
        ];
    }


}