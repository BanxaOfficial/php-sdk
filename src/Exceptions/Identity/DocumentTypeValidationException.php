<?php

namespace Banxa\Exceptions\Identity;

use Exception;

final class DocumentTypeValidationException extends Exception
{
    public const INVALID_DOCUMENT_TYPE = 'The document type %s must match one of: %s';
    public const TOO_MANY_IMAGES_EXCEPTION_FOR_DOCUMENT_TYPE = "Too many documents provided for %s";
    public const MULTIPLE_IMAGES_REQUIRED_EXCEPTION = "The provided %s requires multiple image links";
    public const MISSING_IMAGE_LINKS = "Please provide a image links to the document for %s";
    public const DOCUMENT_NUMBER_NOT_REQUIRED_FOR_DOCUMENT_TYPE = "Document type %s does not require a document number, the documents requiring a document number are %s";
}