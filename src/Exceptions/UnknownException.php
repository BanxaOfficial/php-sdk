<?php

namespace Banxa\Exceptions;

use RuntimeException;
use Throwable;

class UnknownException extends RuntimeException implements Throwable
{
    public const UNKNOWN_MESSAGE = 'An unexpected exception occurred.';
}