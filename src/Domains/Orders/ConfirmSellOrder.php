<?php

namespace Banxa\Domains\Orders;

use Banxa\Domains\Domain;

class ConfirmSellOrder extends Domain
{

    /**
     * @var string
     */
    private string $path = '/api/orders/{order_id}/confirm';

    /**
     * @var string
     */
    private string $orderId;

    /**
     * @param string $orderId
     * @return ConfirmSellOrder
     */
    public function setOrderId(string $orderId): ConfirmSellOrder
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @param string $txHash
     * @param string $sourceAddress
     * @param string $destinationAddress
     * @param string|null $sourceAddressTag
     * @param string|null $destinationAddressTag
     * @return array
     */
    protected function buildPayload(
        string $txHash,
        string $sourceAddress,
        string $destinationAddress,
        string|null $sourceAddressTag,
        string|null $destinationAddressTag
    ): array {
        $payload = [
            'tx_hash'             => $txHash,
            'source_address'      => $sourceAddress,
            'destination_address' => $destinationAddress
        ];

        if (false === empty($sourceAddressTag)) {
            $payload['source_address_tag'] = $sourceAddressTag;
        }
        if (false === empty($destinationAddressTag)) {
            $payload['destination_address_tag'] = $destinationAddressTag;
        }
        return $payload;
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return string
     */
    private function buildPath(): string
    {
        return str_replace("{order_id}", $this->getOrderId(), $this->path);
    }

    /**
     * @return string
     */
    private function getOrderId(): string
    {
        return $this->orderId;
    }

}