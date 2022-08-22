<?php

namespace Banxa\Domains\Orders\Builders;

class SellOrderTransaction extends OrderTransaction
{

    /**
     * @param string $accountReference
     * @param string $fiatCode
     * @param string $coinCode
     * @param string|float $fiatAmount
     * @param string $refundAddress
     * @param string|int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     * @return SellOrderTransaction
     */
    public static function createFromFiatAmount(
        string $accountReference,
        string $fiatCode,
        string $coinCode,
        string|float $fiatAmount,
        string $refundAddress,
        string|int|null $paymentMethodId = null,
        string|null $blockchain = null,
        string|null $walletAddressTag = null
    ): static {
        return new static(
            $accountReference,
            $coinCode,
            $fiatCode,
            null,
            $fiatAmount,
            null,
            $refundAddress,
            $paymentMethodId,
            $blockchain,
            $walletAddressTag
        );
    }


    /**
     * @param string $accountReference
     * @param string $fiatCode
     * @param string $coinCode
     * @param string|float $coinAmount
     * @param string $refundAddress
     * @param string|int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     * @return SellOrderTransaction
     */
    public static function createFromCoinAmount(
        string $accountReference,
        string $fiatCode,
        string $coinCode,
        string|float $coinAmount,
        string $refundAddress,
        string|int|null $paymentMethodId = null,
        string|null $blockchain = null,
        string|null $walletAddressTag = null
    ): static {
        return new static(
            $accountReference,
            $coinCode,
            $fiatCode,
            $coinAmount,
            null,
            null,
            $refundAddress,
            $paymentMethodId,
            $blockchain,
            $walletAddressTag
        );
    }

}