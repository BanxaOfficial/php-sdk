<?php

declare(strict_types=1);

namespace Tests\Unit\Orders\Builders;

use Banxa\Domains\Orders\Builders\BuyOrderTransaction;
use Tests\BaseTestCase;

/** @covers \Banxa\Domains\Orders\Builders\BuyOrderTransaction */
class BuyOrderTransactionTest extends BaseTestCase
{

    /** @test */
    public function it_can_create_a_buy_order_transaction_from_fiat_amount()
    {
        $buyOrderTransaction = BuyOrderTransaction::createFromFiatAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $fiatAmount = 100,
            $walletAddress = "test",
            $paymentMethodId = 6003
        );
        $this->assertInstanceOf(BuyOrderTransaction::class, $buyOrderTransaction);
        $this->assertEquals($accountReference, $buyOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $buyOrderTransaction->getSource());
        $this->assertEquals($coinCode, $buyOrderTransaction->getTarget());
        $this->assertEquals($fiatAmount, $buyOrderTransaction->getSourceAmount());
        $this->assertEquals($walletAddress, $buyOrderTransaction->getWalletAddress());
        $this->assertEquals($paymentMethodId, $buyOrderTransaction->getPaymentMethodId());
    }

    /** @test */
    public function it_can_create_a_buy_order_transaction_from_fiat_amount_as_string()
    {
        $buyOrderTransaction = BuyOrderTransaction::createFromFiatAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $fiatAmount = "100",
            $walletAddress = "test",
            $paymentMethodId = 6003
        );
        $this->assertIsObject($buyOrderTransaction);
        $this->assertEquals($accountReference, $buyOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $buyOrderTransaction->getSource());
        $this->assertEquals($coinCode, $buyOrderTransaction->getTarget());
        $this->assertEquals($fiatAmount, $buyOrderTransaction->getSourceAmount());
        $this->assertEquals($walletAddress, $buyOrderTransaction->getWalletAddress());
        $this->assertEquals($paymentMethodId, $buyOrderTransaction->getPaymentMethodId());
    }


    /** @test */
    public function it_can_create_a_buy_order_transaction_from_coin_amount()
    {
        $buyOrderTransaction = BuyOrderTransaction::createFromCoinAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $coinAmount = 100,
            $walletAddress = "test",
            $paymentMethodId = 6003
        );
        $this->assertIsObject($buyOrderTransaction);
        $this->assertEquals($accountReference, $buyOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $buyOrderTransaction->getSource());
        $this->assertEquals($coinCode, $buyOrderTransaction->getTarget());
        $this->assertEquals($coinAmount, $buyOrderTransaction->getTargetAmount());
        $this->assertEquals($walletAddress, $buyOrderTransaction->getWalletAddress());
        $this->assertEquals($paymentMethodId, $buyOrderTransaction->getPaymentMethodId());
    }

    /** @test */
    public function it_can_create_a_buy_order_transaction_from_coin_amount_as_string()
    {
        $buyOrderTransaction = BuyOrderTransaction::createFromCoinAmount(
            $accountReference = "Testing",
            $fiatCode = "AUD",
            $coinCode = "BTC",
            $coinAmount = "100",
            $walletAddress = "test",
            $paymentMethodId = 6003
        );
        $this->assertIsObject($buyOrderTransaction);
        $this->assertEquals($accountReference, $buyOrderTransaction->getAccountReference());
        $this->assertEquals($fiatCode, $buyOrderTransaction->getSource());
        $this->assertEquals($coinCode, $buyOrderTransaction->getTarget());
        $this->assertEquals($coinAmount, $buyOrderTransaction->getTargetAmount());
        $this->assertEquals($walletAddress, $buyOrderTransaction->getWalletAddress());
        $this->assertEquals($paymentMethodId, $buyOrderTransaction->getPaymentMethodId());
    }


}
