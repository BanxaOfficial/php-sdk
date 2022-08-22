<?php

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\ImageNFTMedia;
use Banxa\Domains\Orders\Builders\Nft;
use Tests\BaseTestCase;

/** @covers \Banxa\Domains\Orders\Builders\Nft::create */
class NftTest extends BaseTestCase
{

    /** @test */
    public function it_can_create_an_nft_object()
    {
        $nft = Nft::create(
            "Test_name",
            "Collection",
            ImageNFTMedia::create("testing-link.com.au")
        );

        $this->assertInstanceOf(Nft::class, $nft);
    }

    /** @test */
    public function it_can_create_an_nft_object_and_get_array()
    {
        $nft = Nft::create(
            "Test_name",
            "Collection",
            ImageNFTMedia::create("testing-link.com.au")
        );

        $this->assertIsArray($nft->toArray());
    }

}
