<?php

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\NftBuyOrderTransaction;
use PHPUnit\Framework\TestCase;

/** @covers \Banxa\Domains\Orders\Builders\NftBuyOrderTransactionTest */
class NftBuyOrderTransactionTest extends TestCase
{

    /** @test */
    public function it_can_create_a_nft_buy_order_transaction()
    {
        $nftBuyOrderTransaction = NftBuyOrderTransaction::create(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $fiatAmount = 100,
            $walletAddress = "test"
        );
        $this->assertInstanceOf(NftBuyOrderTransaction::class, $nftBuyOrderTransaction);
        $this->assertEquals($accountReference, $nftBuyOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $nftBuyOrderTransaction->getSource());
        $this->assertEquals($coinCode, $nftBuyOrderTransaction->getTarget());
        $this->assertEquals($fiatAmount, $nftBuyOrderTransaction->getSourceAmount());
        $this->assertEquals($walletAddress, $nftBuyOrderTransaction->getWalletAddress());
    }

}
