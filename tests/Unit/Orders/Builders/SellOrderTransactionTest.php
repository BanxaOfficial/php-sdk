<?php

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\SellOrderTransaction;
use Tests\BaseTestCase;

/** @covers \Banxa\Domains\Orders\Builders\SellOrderTransaction */
class SellOrderTransactionTest extends BaseTestCase
{

    /** @test */
    public function it_can_create_a_sell_order_transaction_from_fiat_amount()
    {
        $sellOrderTransaction = SellOrderTransaction::createFromFiatAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $fiatAmount = 100,
            $refundAddress = "xxxxxxxxxx"
        );
        $this->assertInstanceOf(SellOrderTransaction::class, $sellOrderTransaction);
        $this->assertEquals($accountReference, $sellOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $sellOrderTransaction->getTarget());
        $this->assertEquals($coinCode, $sellOrderTransaction->getSource());
        $this->assertEquals($fiatAmount, $sellOrderTransaction->getTargetAmount());
        $this->assertEquals($refundAddress, $sellOrderTransaction->getRefundAddress());
    }

    /** @test */
    public function it_can_create_a_sell_order_transaction_from_coin_amount()
    {
        $sellOrderTransaction = SellOrderTransaction::createFromCoinAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $coinAmount = 1,
            $refundAddress = "xxxxxxxxxx"
        );
        $this->assertInstanceOf(SellOrderTransaction::class, $sellOrderTransaction);
        $this->assertEquals($accountReference, $sellOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $sellOrderTransaction->getTarget());
        $this->assertEquals($coinCode, $sellOrderTransaction->getSource());
        $this->assertEquals($coinAmount, $sellOrderTransaction->getSourceAmount());
        $this->assertEquals($refundAddress, $sellOrderTransaction->getRefundAddress());
    }

}
