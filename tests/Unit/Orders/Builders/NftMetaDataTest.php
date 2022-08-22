<?php

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\ImageNFTMedia;
use Banxa\Domains\Orders\Builders\Nft;
use Banxa\Domains\Orders\Builders\NftData;
use Banxa\Domains\Orders\Builders\VideoNftMedia;
use Tests\BaseTestCase;

/** @covers \Banxa\Domains\Orders\Builders\NftData */
class NftMetaDataTest extends BaseTestCase
{

    /** @test */
    public function it_can_create_an_object_with_image_nft_media()
    {
        $nftMetaData = NftData::create(
            "Special Reference",
            Nft::create(
                "Test_name",
                "Collection",
                ImageNFTMedia::create("testinglink.com.au")
            )
        );

        $this->assertInstanceOf(NftData::class, $nftMetaData);
    }

    /** @test */
    public function it_can_create_an_object_with_image_nft_media_and_get_array()
    {
        $nftMetaData = NftData::create(
            "Special Reference",
            Nft::create(
                "Test_name",
                "Collection",
                ImageNFTMedia::create("testinglink.com.au")
            )
        );

        $this->assertIsArray($nftMetaData->toArray());
    }


    /** @test */
    public function it_can_create_an_object_with_video_nft_media()
    {
        $nftMetaData = NftData::create(
            "Special Reference",
            Nft::create(
                "Test_name",
                "Collection",
                VideoNftMedia::create("testinglink.com.au")
            )
        );

        $this->assertIsObject($nftMetaData);
    }

    /** @test */
    public function it_can_create_an_object_with_video_nft_media_and_get_array()
    {
        $nftMetaData = NftData::create(
            "Special Reference",
            Nft::create(
                "Test_name",
                "Collection",
                VideoNftMedia::create("testinglink.com.au")
            )
        );

        $this->assertIsArray($nftMetaData->toArray());
    }

}
