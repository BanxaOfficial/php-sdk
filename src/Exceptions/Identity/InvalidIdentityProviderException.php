<?php

namespace Banxa\Exceptions\Identity;

use Banxa\Domains\Identity\Builders\IdentitySharingProvider;
use Exception;

final class InvalidIdentityProviderException extends Exception
{
    protected $code = 500;
    protected $message = 'Provided identity providers should consist only of ' . IdentitySharingProvider::class . ' types';
}