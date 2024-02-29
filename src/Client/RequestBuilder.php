<?php

declare(strict_types=1);

namespace Banxa\Client;

use Banxa\Authentication\Authentication;
use Exception;
use JsonException;

class RequestBuilder
{
    private array $headers = [
        'Content-Type'    => "application/json",
        'Accept-Encoding' => "gzip, deflate, br",
        'Accept'          => "*/*",
        'x-banxa-sdk'     => 'x-ref-sdk-2021'
    ];
    /**
     * @var string[]
     */
    private array $authenticationHeader;

    /**
     * @param Authentication $authentication
     */
    public function __construct(private Authentication $authentication)
    {
    }

    /**
     * @throws JsonException
     */
    public function generateAuthenticationHeader(string $method, string $uri, array|null $payload = null): void
    {
        $this->authenticationHeader = [
            "Authorization" => "Bearer " . $this->authentication->generateAuthToken(
                    $method,
                    $uri,
                    $payload,
                    (int)microtime(true)
                )
        ];
    }

    /**
     * @throws Exception
     */
    public function getHeaders(): array
    {
        if (empty($this->authenticationHeader)) {
            throw new Exception('Authentication required.');
        }
        return array_merge($this->headers, $this->authenticationHeader);
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }


}