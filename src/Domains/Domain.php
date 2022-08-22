<?php

declare(strict_types=1);

namespace Banxa\Domains;

use Banxa\Client\HttpClient;
use Banxa\Handlers\ResponseHandler;
use Exception;
use JsonException;

abstract class Domain
{
    private ResponseHandler $responseHandler;

    /**
     * @param HttpClient $client
     */
    public function __construct(
        protected HttpClient $client,
    ) {
        $this->responseHandler = new ResponseHandler();
    }

    /**
     * @return HttpClient
     */
    public function getClient(): HttpClient
    {
        return $this->client;
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setRequestHeaders(array $headers): void
    {
        $this->client->getRequestBuilder()->setHeaders($headers);
    }

    /**
     * @return array
     * @throws JsonException
     * @throws Exception
     */
    public function get(): array
    {
        return $this->responseHandler->handle(
            $this->getClient()->request(
                'GET',
                $this->getPath()
            )
        );
    }

    /**
     * @return array
     * @throws JsonException
     * @throws Exception
     */
    public function create(): array
    {
        return $this->responseHandler->handle(
            $this->getClient()->request(
                'POST',
                $this->getPath(),
                $this->buildPayload(
                    ...func_get_args()
                )
            )
        );
    }
}