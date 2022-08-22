<?php

namespace Banxa\Exceptions;

use RuntimeException;
use Throwable;

class ServerException extends RuntimeException implements Throwable
{
    public const SERVER_EXCEPTION_MESSAGE = 'A server error occurred.';
}