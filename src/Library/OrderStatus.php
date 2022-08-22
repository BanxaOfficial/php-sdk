<?php

namespace Banxa\Library;

class OrderStatus
{
    public const PENDING_PAYMENT = 'pendingPayment';
    public const WAITING_PAYMENT = 'waitingPayment';
    public const PAYMENT_RECEIVED = 'paymentReceived';
    public const IN_PROGRESS = 'inProgress';
    public const COIN_TRANSFERRED = 'coinTransferred';
    public const CANCELLED = 'cancelled';
    public const DECLINED = 'declined';
    public const EXPIRED = 'expired';
    public const COMPLETE = 'complete';
    public const REFUNDED = 'refunded';
}