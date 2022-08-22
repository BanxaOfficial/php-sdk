<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

use Banxa\Exceptions\Identity\DocumentTypeValidationException;
use Banxa\Exceptions\Identity\InvalidOrMissingImageLinkProtocolException;

class IdentityDocument
{
    public const DOCUMENT_TYPES = [
        self::DOCUMENT_TYPE_DRIVING_LICENCE,
        self::DOCUMENT_TYPE_PASSPORT,
        self::DOCUMENT_TYPE_IDENTIFICATION,
        self::DOCUMENT_TYPE_SELFIE,
        self::DOCUMENT_TYPE_PROOF_OF_ADDRESS
    ];
    public const DOCUMENT_TYPE_DRIVING_LICENCE = 'DRIVING_LICENSE';
    public const DOCUMENT_TYPE_PASSPORT = 'PASSPORT';
    public const DOCUMENT_TYPE_IDENTIFICATION = 'IDENTIFICATION';
    public const DOCUMENT_TYPE_SELFIE = 'SELFIE';
    public const DOCUMENT_TYPE_PROOF_OF_ADDRESS = 'PROOF_OF_ADDRESS';

    /**
     * @throws DocumentTypeValidationException
     */
    public function __construct(
        private string $documentType,
        protected array $imageLinks,
        private string|int|null $documentNumber
    ) {
        $this->validateDocumentsInput($documentType, $imageLinks);
    }

    /**
     * @param string $type
     * @param array $imageLinks
     * @return void
     * @throws DocumentTypeValidationException
     */
    protected function validateDocumentsInput(string $type, array $imageLinks): void
    {
        $this->validateDocumentType($type);
        $this->validateDocumentNumberRequirement($type);
        if (0 === count($imageLinks)) {
            throw new DocumentTypeValidationException(
                sprintf(DocumentTypeValidationException::MISSING_IMAGE_LINKS, $type), 422
            );
        }
        if (1 === count($imageLinks) && $this->typeRequiresMultipleDocuments($type)) {
            throw new DocumentTypeValidationException(
                sprintf(DocumentTypeValidationException::MULTIPLE_IMAGES_REQUIRED_EXCEPTION, $type), 422
            );
        }
        if (2 == count($imageLinks) && false === $this->typeRequiresMultipleDocuments($type)) {
            throw new DocumentTypeValidationException(
                sprintf(DocumentTypeValidationException::TOO_MANY_IMAGES_EXCEPTION_FOR_DOCUMENT_TYPE, $type), 422
            );
        }
        if (count($imageLinks) > 2) {
            throw new DocumentTypeValidationException(
                sprintf(DocumentTypeValidationException::TOO_MANY_IMAGES_EXCEPTION_FOR_DOCUMENT_TYPE, $type), 422
            );
        }
    }

    /**
     * @param string $type
     * @return void
     * @throws DocumentTypeValidationException
     */
    protected function validateDocumentType(string $type): void
    {
        if (!in_array($type, self::DOCUMENT_TYPES)) {
            throw new DocumentTypeValidationException(
                sprintf(
                    DocumentTypeValidationException::INVALID_DOCUMENT_TYPE,
                    $type,
                    implode(' ', self::DOCUMENT_TYPES)
                ), 422
            );
        }
    }

    /**
     * @param string $type
     * @return void
     * @throws DocumentTypeValidationException
     */
    protected function validateDocumentNumberRequirement(string $type): void
    {
        if (false === in_array($type, [
                self::DOCUMENT_TYPE_PASSPORT,
                self::DOCUMENT_TYPE_DRIVING_LICENCE,
                self::DOCUMENT_TYPE_IDENTIFICATION
            ])) {
            throw new DocumentTypeValidationException(
                sprintf(
                    DocumentTypeValidationException::DOCUMENT_NUMBER_NOT_REQUIRED_FOR_DOCUMENT_TYPE,
                    $type,
                    implode(' ', [
                        self::DOCUMENT_TYPE_PASSPORT,
                        self::DOCUMENT_TYPE_DRIVING_LICENCE,
                        self::DOCUMENT_TYPE_IDENTIFICATION
                    ])
                ), 422
            );
        }
    }

    private function typeRequiresMultipleDocuments(string $type): bool
    {
        return in_array($type, [
            self::DOCUMENT_TYPE_DRIVING_LICENCE,
            self::DOCUMENT_TYPE_IDENTIFICATION
        ]);
    }

    /**
     * @throws DocumentTypeValidationException
     */
    public static function create(string $documentType, array $imageLinks, string|null $documentNumber = null): static
    {
        return new static($documentType, $imageLinks, $documentNumber);
    }

    /**
     * @return array
     * @throws InvalidOrMissingImageLinkProtocolException
     */
    public function getImageLinks(): array
    {
        $links = [];
        foreach ($this->imageLinks as $link) {
            if (!str_starts_with($link, 'https://')) {
                throw new InvalidOrMissingImageLinkProtocolException(
                    sprintf(InvalidOrMissingImageLinkProtocolException::EXCEPTION, $link), 422
                );
            }
            $links[]['link'] = $link;
        }
        return $links;
    }

    /**
     * @return string
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * @return int|string|null
     */
    public function getDocumentNumber(): int|string|null
    {
        return $this->documentNumber;
    }


}