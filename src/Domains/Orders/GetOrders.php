<?php

namespace Banxa\Domains\Orders;

use Banxa\Domains\Domain;
use Banxa\Exceptions\InvalidOrderStatusException;
use Banxa\Library\KeyConstants;
use Banxa\Library\OrderStatus;

class GetOrders extends Domain
{
    private const ORDER_STATUSES = [
        OrderStatus::PENDING_PAYMENT,
        OrderStatus::WAITING_PAYMENT,
        OrderStatus::PAYMENT_RECEIVED,
        OrderStatus::IN_PROGRESS,
        OrderStatus::COIN_TRANSFERRED,
        OrderStatus::CANCELLED,
        OrderStatus::DECLINED,
        OrderStatus::EXPIRED,
        OrderStatus::COMPLETE,
        OrderStatus::REFUNDED,
    ];
    /**
     * @var string
     */
    private string $path = 'api/orders';
    /**
     * @var string $start_date
     */
    private string $start_date;
    /**
     * @var string $end_date
     */
    private string $end_date;
    /**
     * @var array $statuses
     */
    private array $statuses;
    /**
     * @var string|int $per_page
     */
    private string|int $per_page;
    /**
     * @var string|int $page
     */
    private string|int $page;
    /**
     * @var string|null
     */
    private null|string $account_reference;

    /**
     * @return string
     */
    private function buildPath(): string
    {
        return $this->path . '?' . http_build_query($this->buildParameters());
    }

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return $this->buildPath();
    }

    /**
     * @return array
     */
    private function buildParameters(): array
    {
        return array_filter([
            KeyConstants::_START_DATE        => $this->getStartDate(),
            KeyConstants::_END_DATE          => $this->getEndDate(),
            KeyConstants::_STATUS            => $this->getStatus(),
            KeyConstants::_PER_PAGE          => $this->getPerPage(),
            KeyConstants::_PAGE              => $this->getPage(),
            KeyConstants::_ACCOUNT_REFERENCE => $this->getAccountReference(),
        ]);
    }

    /**
     * @return string
     */
    private function getStartDate(): string
    {
        return $this->start_date;
    }

    /**
     * @return string
     */
    private function getEndDate(): string
    {
        return $this->end_date;
    }

    /**
     * @return string
     */
    private function getStatus(): string
    {
        return implode(",", $this->statuses);
    }

    /**
     * @return string|int
     */
    private function getPerPage(): string|int
    {
        return $this->per_page;
    }

    /**
     * @return string|int
     */
    private function getPage(): string|int
    {
        return $this->page;
    }

    /**
     * @return string|null
     */
    private function getAccountReference(): null|string
    {
        return $this->account_reference;
    }

    /**
     * @param string $start_date
     * @return GetOrders
     */
    public function setStartDate(string $start_date): GetOrders
    {
        $this->start_date = $start_date;
        return $this;
    }

    /**
     * @param string $end_date
     * @return GetOrders
     */
    public function setEndDate(string $end_date): GetOrders
    {
        $this->end_date = $end_date;
        return $this;
    }

    /**
     * @param array $statuses
     * @return GetOrders
     */
    public function setStatuses(array $statuses): GetOrders
    {
        $this->validateOrderStatuses($statuses);
        $this->statuses = $statuses;
        return $this;
    }

    /**
     * @param string|int $per_page
     * @return GetOrders
     */
    public function setPerPage(string|int $per_page): GetOrders
    {
        $this->per_page = $per_page;
        return $this;
    }

    /**
     * @param string|int $page
     * @return GetOrders
     */
    public function setPage(string|int $page): GetOrders
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param string|null $account_reference
     * @return GetOrders
     */
    public function setAccountReference(null|string $account_reference): GetOrders
    {
        $this->account_reference = $account_reference;
        return $this;
    }

    /**
     * @param array $statuses
     * @return void
     */
    protected function validateOrderStatuses(array $statuses): void
    {
        $result = array_intersect($statuses, self::ORDER_STATUSES);
        if (count($result) < count($statuses)) {
            throw new InvalidOrderStatusException();
        }
    }


}