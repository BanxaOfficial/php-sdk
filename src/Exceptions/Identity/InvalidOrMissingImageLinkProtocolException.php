<?php

namespace Banxa\Exceptions\Identity;

use Exception;

class InvalidOrMissingImageLinkProtocolException extends Exception
{
    public const EXCEPTION = "Invalid protocol provided for image URL %s";
}