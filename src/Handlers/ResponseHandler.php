<?php
declare(strict_types=1);

namespace Banxa\Handlers;

use Banxa\Exceptions\HttpException;
use Banxa\Exceptions\ServerException;
use Banxa\Exceptions\UnknownException;
use Exception;
use JsonException;
use Psr\Http\Message\ResponseInterface;

class ResponseHandler
{
    public const IGNORE_DEFLATE = ['spot_price'];

    /**
     * @throws Exception
     */
    public function handle(ResponseInterface $response): array
    {
        if (!in_array($response->getStatusCode(), [
            200,
            201,
            202
        ], true)) {
            $this->handleErrors($response);
        }

        $body = $response->getBody()->__toString();
        $contentType = $response->getHeaderLine('Content-Type');

        if ($this->contentTypeCanNotBeDecoded($contentType)) {
            throw new JsonException(sprintf('Content-Type: %s could not be converted to a json object', $contentType));
        }
        $data = json_decode($body, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JsonException(sprintf('Json could not be decoded due to the following %s', json_last_error()));
        }

        return $this->deflate($data);
    }

    /**
     * @throws Exception
     */
    protected function handleErrors(ResponseInterface $response)
    {
        $statusCode = $response->getStatusCode();
        throw match ($statusCode) {
            400 => HttpException::badRequest($response),
            401 => HttpException::unauthorized($response),
            403 => HttpException::forbidden(),
            422 => HttpException::validationError($response),
            429 => HttpException::tooManyRequests(),
            500 => new ServerException(ServerException::SERVER_EXCEPTION_MESSAGE, 500),
            default => new UnknownException(UnknownException::UNKNOWN_MESSAGE),
        };
    }

    /**
     * @param string $contentType
     * @return bool
     */
    protected function contentTypeCanNotBeDecoded(string $contentType): bool
    {
        return !str_starts_with($contentType, 'application/json') && !str_starts_with($contentType, 'application/octet-stream');
    }

    private function deflate(array $data, int $i = 0)
    {
        if (!is_numeric(key($data)) && !in_array(key($data), self::IGNORE_DEFLATE)) {
            $data = array_shift($data);
            while ($i < 1) {
                $i++;
                $data = $this->deflate($data, $i);
            }
        }
        return $data;
    }
}