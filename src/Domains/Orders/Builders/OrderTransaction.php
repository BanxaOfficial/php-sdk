<?php

declare(strict_types=1);

namespace Banxa\Domains\Orders\Builders;

use Banxa\Library\KeyConstants;

class OrderTransaction
{
    /**
     * @param string $accountReference
     * @param string $source
     * @param string $target
     * @param string|float|null $sourceAmount
     * @param string|float|null $targetAmount
     * @param string|null $walletAddress
     * @param string|null $refundAddress
     * @param string|int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     */
    protected function __construct(
        protected string $accountReference,
        protected string $source,
        protected string $target,
        protected string|float|null $sourceAmount,
        protected string|float|null $targetAmount,
        protected string|null $walletAddress,
        protected string|null $refundAddress,
        protected string|int|null $paymentMethodId,
        protected string|null $blockchain,
        protected string|null $walletAddressTag
    ) {
    }


    /**
     * @param string $accountReference
     * @param string $source
     * @param string $target
     * @param string|float|null $sourceAmount
     * @param string|float|null $targetAmount
     * @param string|null $walletAddress
     * @param string|null $refundAddress
     * @param int|null $paymentMethodId
     * @param string|null $blockchain
     * @param string|null $walletAddressTag
     * @return static
     */
    public static function createDynamic(
        string $accountReference,
        string $source,
        string $target,
        string|float|null $sourceAmount,
        string|float|null $targetAmount,
        string|null $walletAddress,
        string|null $refundAddress,
        int|null $paymentMethodId = null,
        string|null $blockchain = null,
        string|null $walletAddressTag = null
    ): static {
        return new static(
            $accountReference,
            $source,
            $target,
            $sourceAmount,
            $targetAmount,
            $walletAddress,
            $refundAddress,
            $paymentMethodId,
            $blockchain,
            $walletAddressTag
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            KeyConstants::_SOURCE             => $this->getSource(),
            KeyConstants::_TARGET             => $this->getTarget(),
            KeyConstants::_SOURCE_AMOUNT      => $this->getSourceAmount(),
            KeyConstants::_TARGET_AMOUNT      => $this->getTargetAmount(),
            KeyConstants::_WALLET_ADDRESS     => $this->getWalletAddress(),
            KeyConstants::_REFUND_ADDRESS     => $this->getRefundAddress(),
            KeyConstants::_ACCOUNT_REFERENCE  => $this->getAccountReference(),
            KeyConstants::_PAYMENT_METHOD_ID  => $this->getPaymentMethodId(),
            KeyConstants::_BLOCKCHAIN         => $this->getBlockchain(),
            KeyConstants::_WALLET_ADDRESS_TAG => $this->getWalletAddressTag(),
        ]);
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @return null|string|float
     */
    public function getSourceAmount(): null|string|float
    {
        return $this->sourceAmount;
    }

    /**
     * @return null|string|float
     */
    public function getTargetAmount(): null|string|float
    {
        return $this->targetAmount;
    }


    /**
     * @return string|null
     */
    public function getWalletAddress(): string|null
    {
        return $this->walletAddress;
    }

    /**
     * @return string|null
     */
    public function getRefundAddress(): string|null
    {
        return $this->refundAddress;
    }

    /**
     * @return string
     */
    public function getAccountReference(): string
    {
        return $this->accountReference;
    }

    /**
     * @return int|string|null
     */
    public function getPaymentMethodId(): int|string|null
    {
        return $this->paymentMethodId;
    }

    /**
     * @return string|null
     */
    public function getBlockchain(): string|null
    {
        return $this->blockchain;
    }

    /**
     * @return string|null
     */
    private function getWalletAddressTag(): string|null
    {
        return $this->walletAddressTag;
    }


}