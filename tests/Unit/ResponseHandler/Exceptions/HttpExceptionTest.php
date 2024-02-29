<?php

namespace Tests\Unit\ResponseHandler\Exceptions;

use Banxa\Exceptions\HttpException;
use Banxa\Exceptions\ServerException;
use Banxa\Exceptions\UnknownException;
use Banxa\Handlers\ResponseHandler;
use Exception;
use GuzzleHttp\Psr7\Response;
use Tests\BaseTestCase;

/** @covers ResponseHandler::handleErrors */
class HttpExceptionTest extends BaseTestCase
{
    /**
     * @dataProvider exceptionDataProvider
     * @throws Exception
     */
    public function test_exceptions($data)
    {
        $this->expectException($data['exceptionClass']);
        $this->expectExceptionCode($data['expectedCode']);
        $this->expectExceptionMessage($data['expectedMessage']);
        $responseHandler = new ResponseHandler();
        $responseHandler->handle(new Response($data['code'], ['Content-type' => 'application/json'], $data['responseData'] ?? ''));
    }

    public function exceptionDataProvider(): array
    {
        return [
            'Bad Request'                  => [
                [
                    'code'            => $code = 400,
                    'expectedMessage' => 'Could not find source (Code: 3220)',
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                    'responseData'    => '{"errors": {"status": 400,"code": 3220,"title": "Could not find source"}}'
                ]
            ],
            'Bad Request without warnings' => [
                [
                    'code'            => $code = 400,
                    'expectedMessage' => '{"errors": {"status": 400}}',
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                    'responseData'    => '{"errors": {"status": 400}}'
                ]
            ],
            'Unauthorized'                 => [
                [
                    'code'            => $code = 401,
                    'expectedMessage' => 'You are not authorized to access this resource. (Code: 40104)',
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                    'responseData'    => '{"errors": {"status": 401,"code": 40104,"title": "You are not authorized to access this resource."}}'
                ]
            ],
            'Forbidden'                    => [
                [
                    'code'            => $code = 403,
                    'expectedMessage' => HttpException::FORBIDDEN_EXCEPTION_MESSAGE,
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                ]
            ],
            'Validation exception'         => [
                [
                    'code'            => $code = 422,
                    'expectedMessage' => HttpException::VALIDATION_EXCEPTION_MESSAGE . ': The start date field is required., The end date field is required.',
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                    'responseData'    => '{"errors":{"status":422,"code":422,"title":"The given data was invalid.","detail":{"start_date":"The start date field is required.","end_date":"The end date field is required."}}}'
                ]
            ],
            'Too many requests'            => [
                [
                    'code'            => $code = 429,
                    'expectedMessage' => HttpException::TOO_MANY_REQUESTS_EXCEPTION_MESSAGE,
                    'expectedCode'    => $code,
                    'exceptionClass'  => HttpException::class,
                ]
            ],
            'Server exception'             => [
                [
                    'code'            => $code = 500,
                    'expectedMessage' => ServerException::SERVER_EXCEPTION_MESSAGE,
                    'expectedCode'    => $code,
                    'exceptionClass'  => ServerException::class
                ]
            ],

            'Unknown'                      => [
                [
                    'code'            => 501,
                    'expectedMessage' => UnknownException::UNKNOWN_MESSAGE,
                    'expectedCode'    => 0,
                    'exceptionClass'  => UnknownException::class
                ]
            ]
        ];
    }

}