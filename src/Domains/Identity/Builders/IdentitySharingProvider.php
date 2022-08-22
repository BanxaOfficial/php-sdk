<?php

declare(strict_types=1);

namespace Banxa\Domains\Identity\Builders;

class IdentitySharingProvider
{
    /**
     * @param string $provider
     * @param string $token
     */
    public function __construct(
        private string $provider,
        private string $token
    ) {
    }

    /**
     * @param string $provider
     * @param string $token
     * @return static
     */
    public static function create(string $provider, string $token): static
    {
        return new static($provider, $token);
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}