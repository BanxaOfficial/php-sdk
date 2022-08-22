<?php

declare(strict_types=1);

namespace Banxa\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Throwable;

final class HttpException extends RuntimeException implements Throwable
{

    public const VALIDATION_EXCEPTION_MESSAGE = 'Validation exception.';
    public const TOO_MANY_REQUESTS_EXCEPTION_MESSAGE = 'Too many requests.';
    public const FORBIDDEN_EXCEPTION_MESSAGE = 'Forbidden.';

    /**
     * @param ResponseInterface $response
     * @return HttpException
     */
    public static function badRequest(ResponseInterface $response): HttpException
    {
        return new self(self::getErrorTitle($response), 400);
    }

    /**
     * @param bool $devMode
     * @return HttpException
     */
    public static function unauthorized(ResponseInterface $response): HttpException
    {
        return new self(self::getErrorTitle($response), 401);
    }

    /**
     * @return HttpException
     */
    public static function forbidden(): HttpException
    {
        return new self(self::FORBIDDEN_EXCEPTION_MESSAGE, 403);
    }

    /**
     * @throws Exception
     */
    public static function validationError(ResponseInterface $response): HttpException
    {
        return new self(self::VALIDATION_EXCEPTION_MESSAGE . ': ' . self::parseAsStringMessage($response), 422);
    }

    /**
     * @return HttpException
     */
    public static function tooManyRequests(): HttpException
    {
        return new self(self::TOO_MANY_REQUESTS_EXCEPTION_MESSAGE, 429);
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private static function parseAsStringMessage(ResponseInterface $response): string
    {
        $contents = $response->getBody()->getContents();
        try {
            $decoded = json_decode($contents, true);
        return array_key_exists('errors', $decoded) && array_key_exists('detail', $decoded['errors'])
            ? implode(', ', array_values($decoded['errors']['detail']))
            : $contents;
        }catch (Throwable $e){
            throw new HttpException('Invalid data provided, message:'. $contents, 422);
        }
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    protected static function getErrorTitle(ResponseInterface $response): string
    {
        try {
            $contents = $response->getBody()->getContents();
            $decoded = json_decode($contents, true);
            return array_key_exists('errors', $decoded)
                ? $decoded['errors']['title'] . ' (Code: ' . $decoded['errors']['code'] . ')'
                : $contents;
        }catch (Throwable $e){
            throw new HttpException('An unexpected error occurred', 500);
        }
    }
}