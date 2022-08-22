<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class ImageNFTMedia extends NftMedia
{

    /**
     * @param string $link
     * @return static
     */
    public static function create(string $link): static
    {
        return new static(KeyConstants::_NFT_TYPE_IMAGE, $link);
    }

}