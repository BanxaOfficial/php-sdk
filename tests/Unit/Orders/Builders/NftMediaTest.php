<?php

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\ImageNFTMedia;
use Banxa\Domains\Orders\Builders\VideoNftMedia;
use Tests\BaseTestCase;

/** @covers \Banxa\Domains\Orders\Builders\NftMedia */
class NftMediaTest extends BaseTestCase
{
    /** @test */
    public function it_can_create_an_video_nft_media_object()
    {
        $videoNftMedia = VideoNftMedia::create("testing-link.com.au");
        $this->assertInstanceOf(VideoNftMedia::class, $videoNftMedia);
    }

    /** @test */
    public function it_can_create_an_image_nft_media_object()
    {
        $videoNftMedia = ImageNFTMedia::create("testing-link.com.au");
        $this->assertInstanceOf(ImageNFTMedia::class, $videoNftMedia);
    }

}
