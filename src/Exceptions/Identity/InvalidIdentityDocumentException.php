<?php

namespace Banxa\Exceptions\Identity;

use Banxa\Domains\Identity\Builders\IdentityDocument;
use Exception;

final class InvalidIdentityDocumentException extends Exception
{
    protected $code = 500;
    protected $message = 'Provided identity document should consist only of ' . IdentityDocument::class . ' types';
}