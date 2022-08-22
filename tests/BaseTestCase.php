<?php

declare(strict_types=1);

namespace Tests;

use Banxa\Banxa;
use Banxa\Client\HttpClient;
use Banxa\Handlers\ResponseHandler;
use GuzzleHttp\Psr7\Response;
use Mockery;
use Mockery\LegacyMockInterface;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class BaseTestCase extends TestCase
{
    protected Banxa $client;
    /**
     * @var HttpClient|LegacyMockInterface|MockInterface
     */
    public HttpClient|LegacyMockInterface|MockInterface $httpClientMock;
    protected ResponseHandler $responseHandler;

    public function setUp(): void
    {
        parent::setUp();
        $this->responseHandler = new ResponseHandler();
    }

    protected function mockHttpClient($responseData, int $responseCode = 200): void
    {
        $this->httpClientMock = Mockery::mock(HttpClient::class);
        $response = new Response($responseCode, ['Content-type' => 'application/json'], $responseData);
        $this->httpClientMock->shouldReceive('request')
            ->andReturn($response);
    }
}