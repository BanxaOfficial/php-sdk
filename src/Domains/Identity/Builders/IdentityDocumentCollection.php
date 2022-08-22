<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

use Banxa\Exceptions\Identity\InvalidIdentityDocumentException;
use Banxa\Exceptions\Identity\InvalidOrMissingImageLinkProtocolException;

class IdentityDocumentCollection
{
    /**
     * @var array
     */
    private array $identityDocuments;

    /**
     * @param array $documents
     * @throws InvalidIdentityDocumentException
     * @throws InvalidOrMissingImageLinkProtocolException
     */
    public function __construct(array $documents)
    {
        foreach ($documents as $identityDocument) {
            if ($identityDocument instanceof IdentityDocument) {
                $this->identityDocuments[] = [
                    'type'   => $identityDocument->getDocumentType(),
                    'images' => $identityDocument->getImageLinks(),
                    'data'   => [
                        'number' => $identityDocument->getDocumentNumber()
                    ]
                ];
            } else {
                throw new InvalidIdentityDocumentException();
            }
        }
    }

    /**
     * @param array $identityDocuments
     * @return IdentityDocumentCollection
     * @throws InvalidIdentityDocumentException
     * @throws InvalidOrMissingImageLinkProtocolException
     */
    public static function create(array $identityDocuments): static
    {
        return new static($identityDocuments);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->identityDocuments;
    }
}