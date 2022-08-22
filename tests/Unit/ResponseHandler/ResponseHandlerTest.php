<?php

namespace Tests\Unit\ResponseHandler;

use Banxa\Handlers\ResponseHandler;
use GuzzleHttp\Psr7\Response;
use Tests\BaseTestCase;

/** @covers ResponseHandler::flattenResponse */
class ResponseHandlerTest extends BaseTestCase
{
    /** @test */
    public function it_can_deflate()
    {
        $response = new Response(200, ['Content-type' => "application/json"], json_encode([
                'data' => [
                    'result' =>
                        [
                            ['a' => 'a'],
                        ]
                ]
            ])
        );
        $responseHandler = new ResponseHandler();
        $result = $responseHandler->handle($response);

        $this->assertArrayNotHasKey('data', $result);
        $this->assertCount(1, $result);
        $this->assertEquals('a', key($result[0]));
    }

    /** @test */
    public function it_can_deflate_one_level()
    {
        $response = new Response(200, ['Content-type' => "application/json"], json_encode([
                'result' =>
                    [
                        ['a' => 'a'],
                    ]
            ])
        );
        $responseHandler = new ResponseHandler();
        $result = $responseHandler->handle($response);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertCount(1, $result);
        $this->assertEquals('a', key($result[0]));
    }

    /** @test */
    public function it_can_avoid_deflate()
    {
        $response = new Response(200, ['Content-type' => "application/json"], json_encode([['a' => 'a']]));
        $responseHandler = new ResponseHandler();
        $result = $responseHandler->handle($response);
        $this->assertArrayNotHasKey('data', $result);
        $this->assertCount(1, $result);
        $this->assertEquals('a', key($result[0]));
    }

}