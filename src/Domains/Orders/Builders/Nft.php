<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class Nft
{

    /**
     * @param string $name
     * @param string $collection
     * @param NftMedia $nftMedia
     */
    public function __construct(private string $name, private string $collection, private NftMedia $nftMedia)
    {
    }

    /**
     * @param string $name
     * @param string $collection
     * @param NftMedia $nftMedia
     * @return static
     */
    public static function create(string $name, string $collection, NftMedia $nftMedia): static
    {
        return new static($name, $collection, $nftMedia);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            KeyConstants::_NFT_NAME       => $this->getName(),
            KeyConstants::_NFT_COLLECTION => $this->getCollection(),
            KeyConstants::_NFT_MEDIA      => $this->getNftMedia()->toArray()
        ];
    }

    /**
     * @return string
     */
    private function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    private function getCollection(): string
    {
        return $this->collection;
    }

    /**
     * @return NftMedia
     */
    private function getNftMedia(): NftMedia
    {
        return $this->nftMedia;
    }


}