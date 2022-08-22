<?php

declare(strict_types=1);

namespace Banxa\Authentication;

use JsonException;


class Authentication
{
    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(
        private string $apiKey,
        private string $apiSecret
    ) {
    }

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @return static
     */
    public static function make(string $apiKey, string $apiSecret): static
    {
        return new static($apiKey, $apiSecret);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $data
     * @param int $nonce
     * @return string
     * @throws JsonException
     */
    public function generateAuthToken(string $method, string $uri, array|null $data, int $nonce): string
    {
        $json = $this->getJsonPayload($data);
        $payload = $this->buildAuthPayload($method, $uri, $nonce, $json);
        return $this->getBearerToken($payload, $nonce);
    }

    /**
     * @param array|null $data
     * @return bool|string|null
     * @throws JsonException
     */
    private function getJsonPayload(array|null $data): bool|string|null
    {
        return $data ? json_encode(
            $data,
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ) : null;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param int $nonce
     * @param string|null $json
     * @return string
     */
    private function buildAuthPayload(string $method, string $uri, int $nonce, string|null $json): string
    {
        $array = array_filter([
            $method,
            $uri,
            $nonce,
            $json
        ]);
        return implode("\n", $array);
    }

    /**
     * @param string $payload
     * @param int $nonce
     * @return string
     */
    private function getBearerToken(string $payload, int $nonce): string
    {
        return implode(':', [
            $this->apiKey,
            self::generateHmacSignature($payload),
            $nonce
        ]);
    }

    /**
     * @param string $payload
     * @return false|string
     */
    private function generateHmacSignature(string $payload): bool|string
    {
        return hash_hmac("sha256", $payload, $this->apiSecret);
    }

}