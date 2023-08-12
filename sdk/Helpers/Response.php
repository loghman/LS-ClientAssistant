<?php

namespace Ls\ClientAssistant\Helpers;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

class Response
{
    public static function single(ResponseInterface $response): Collection
    {
        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody(), true));
        }

        return collect();
    }

    public static function many(ResponseInterface $response): Collection
    {
        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody(), true));
        }

        return collect();
    }

    public static function parseClientException(ClientException $exception): Collection
    {
        return collect(json_decode($exception->getResponse()->getBody()->getContents() ?? ''));
    }

    public static function parseException(\Exception $exception): Collection
    {
        return collect([
            'success' => false,
            'message' => $exception->getMessage(),
            'data' => [],
        ]);
    }

    public static function success(string $message = '', array $data = []): Collection
    {
        return collect([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function unprocessableEntity(ResponseInterface $response, string $msg, array $data = []): ResponseInterface
    {
        $response->getBody()
            ->write(json_encode(['message' => $msg, 'data' => $data], JSON_UNESCAPED_UNICODE));

        return $response->withStatus(422)->withHeader('Content-Type', 'application/json');
    }
}