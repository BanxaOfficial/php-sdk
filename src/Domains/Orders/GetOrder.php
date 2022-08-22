<?php

namespace Banxa\Domains\Orders;

use Banxa\Domains\Domain;

class GetOrder extends Domain
{

    /**
     * @var string
     */
    private string $path = 'api/orders';

    /**
     * @var string
     */
    private string $orderId;

    /**
     * @return string
     */
    private function buildPath(): string
    {
        return $this->path . DIRECTORY_SEPARATOR . $this->getOrderId();
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return string|null
     */
    private function getOrderId(): null|string
    {
        return $this->orderId;
    }

    /**
     * @param string $orderId
     * @return GetOrder
     */
    public function setOrderId(string $orderId): GetOrder
    {
        $this->orderId = $orderId;
        return $this;
    }


}