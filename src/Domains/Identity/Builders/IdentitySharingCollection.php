<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

use Banxa\Exceptions\Identity\InvalidIdentityProviderException;

class IdentitySharingCollection
{
    /**
     * @var array
     */
    private array $identitySharingProviders;

    /**
     * @throws InvalidIdentityProviderException
     */
    public function __construct(
        array $providers
    ) {
        foreach ($providers as $identitySharingProvider) {
            if ($identitySharingProvider instanceof IdentitySharingProvider) {
                $this->identitySharingProviders[] = [
                    'provider' => $identitySharingProvider->getProvider(),
                    'token'    => $identitySharingProvider->getToken()
                ];
            } else {
                throw new InvalidIdentityProviderException();
            }
        }
    }

    /**
     * @throws InvalidIdentityProviderException
     */
    public static function create(array $identitySharingProviders): static
    {
        return new static($identitySharingProviders);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->identitySharingProviders;
    }
}