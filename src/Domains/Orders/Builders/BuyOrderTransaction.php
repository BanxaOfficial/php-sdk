<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

class BuyOrderTransaction extends OrderTransaction
{
    /**
     * @param string $accountReference
     * @param string $fiatCode
     * @param string $coinCode
     * @param string|float $fiatAmount
     * @param string $walletAddress
     * @param string|int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     * @return BuyOrderTransaction
     */
    public static function createFromFiatAmount(
        string $accountReference,
        string $fiatCode,
        string $coinCode,
        string|float $fiatAmount,
        string $walletAddress,
        string|int|null $paymentMethodId = null,
        string|null $blockchain = null,
        string|null $walletAddressTag = null
    ): static {
        return new static(
            $accountReference,
            $fiatCode,
            $coinCode,
            $fiatAmount,
            null,
            $walletAddress,
            null,
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
     * @param string $walletAddress
     * @param string|int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     * @return BuyOrderTransaction
     */
    public static function createFromCoinAmount(
        string $accountReference,
        string $fiatCode,
        string $coinCode,
        string|float $coinAmount,
        string $walletAddress,
        string|int|null $paymentMethodId = null,
        string|null $blockchain = null,
        string|null $walletAddressTag = null
    ): static
    {
        return new static(
            $accountReference,
            $fiatCode,
            $coinCode,
            null,
            $coinAmount,
            $walletAddress,
            null,
            $paymentMethodId,
            $blockchain,
            $walletAddressTag
        );
    }
}
