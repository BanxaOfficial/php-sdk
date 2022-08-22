<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

abstract class NftMedia
{

    /**
     * @param string $type
     * @param string $link
     */
    public function __construct(private string $type, protected string $link)
    {
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            KeyConstants::_TYPE     => $this->getType(),
            KeyConstants::_NFT_LINK => $this->getLink(),
        ];
    }

    /**
     * @return string
     */
    private function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    private function getLink(): string
    {
        return $this->link;
    }


}