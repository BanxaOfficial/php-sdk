<?php

declare(strict_types=1);

namespace Banxa\Client;

use Banxa\Authentication\Authentication;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    /**
     * The production environment
     */
    private const BASE_URL = 'https://{subdomain}.banxa.com';

    /**
     * The sandbox environment
     */
    private const SANDBOX_URL = 'https://{subdomain}.banxa-sandbox.com';

    /**
     * @var Client
     */
    private Client $client;

    /** @var RequestBuilder $requestBuilder */
    private RequestBuilder $requestBuilder;

    /**
     * @param string $subdomain
     * @param string $apiKey
     * @param string $apiSecret
     * @param bool $testMode
     */
    public function __construct(string $subdomain, string $apiKey, string $apiSecret, bool $testMode)
    {
        $this->requestBuilder = new RequestBuilder(Authentication::make($apiKey, $apiSecret));
        $this->client = new Client([
            'base_uri'    => $this->getUrl($subdomain, $testMode),
            'http_errors' => false
        ]);
    }

    /**
     * @return RequestBuilder
     */
    public function getRequestBuilder(): RequestBuilder
    {
        return $this->requestBuilder;
    }

    /**
     * @return ClientInterface
     */
    private function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return ResponseInterface
     * @throws JsonException
     */
    public function request(string $method, string $uri, array $payload = []): ResponseInterface
    {
        return $this->authorizeRequest($method, $uri, $payload)->{strtolower($method)}($uri, $payload);
    }

    /**
     * @param string $uri
     * @param array|null $query
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Exception
     */
    private function get(string $uri, array|null $query = []): ResponseInterface
    {
        return $this->getClient()->get($uri, [
            'form_params' => $query,
            'headers'     => $this->requestBuilder->getHeaders()
        ]);
    }

    /**
     * @param $uri
     * @param array|null $payload
     * @return ResponseInterface
     * @throws GuzzleException
     * @throws Exception
     */
    private function post($uri, array|null $payload = []): ResponseInterface
    {
        return $this->getClient()->post($uri, [
            'json'    => $payload,
            'headers' => $this->requestBuilder->getHeaders()
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $payload
     * @return $this
     * @throws JsonException
     */
    private function authorizeRequest(string $method, string $uri, array|null $payload): self
    {
        $this->requestBuilder->generateAuthenticationHeader($method, $uri, $payload);
        return $this;
    }

    /**
     * @param string $subdomain
     * @param bool $isTestMode
     * @return string
     */
    private function getUrl(string $subdomain, bool $isTestMode): string
    {
        $targetDomain =  $isTestMode ? self::SANDBOX_URL : self::BASE_URL;
        return str_replace('{subdomain}', $subdomain, $targetDomain);
    }
}
