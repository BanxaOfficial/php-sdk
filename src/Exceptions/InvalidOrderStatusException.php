<?php

namespace Banxa\Exceptions;

use RuntimeException;
use Throwable;

class InvalidOrderStatusException extends RuntimeException implements Throwable
{
    protected $message = 'Invalid order status provided';
    protected $code = 422;
}