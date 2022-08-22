<?php

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class VideoNftMedia extends NftMedia
{
    /**
     * @param string $link
     * @return static
     */
    public static function create(string $link): static
    {
        return new static(KeyConstants::_NFT_TYPE_VIDEO, $link);
    }

}