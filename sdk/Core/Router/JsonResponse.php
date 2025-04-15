<?php

namespace Ls\ClientAssistant\Core\Router;

use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use \Symfony\Component\HttpFoundation\JsonResponse as SymfonyJsonResponse;

class JsonResponse extends SymfonyResponse
{
    public static function json(string $msg, int $status, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        $body = [
            'message' => $msg,
            'data' => $data,
            'success' => $status >= SymfonyResponse::HTTP_OK && $status < SymfonyResponse::HTTP_MULTIPLE_CHOICES
        ];

        return new SymfonyJsonResponse($body, $status, $headers);
    }

    public static function successfullyCreated(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_CREATED, $data, $headers);
    }

    public static function success(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_OK, $data, $headers);
    }

    public static function forbidden(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_FORBIDDEN, $data, $headers);
    }

    public static function notFound(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_NOT_FOUND, $data, $headers);
    }

    public static function unprocessableEntity(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, $data, $headers);
    }

    public static function badRequest(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_BAD_REQUEST, $data, $headers);
    }

    public static function notImplemented(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_NOT_IMPLEMENTED, $data, $headers);
    }

    public static function serviceUnavailable(string $msg, array $data = [], array $headers = []): SymfonyJsonResponse
    {
        return self::json($msg, SymfonyResponse::HTTP_SERVICE_UNAVAILABLE, $data, $headers);
    }

    public static function ajaxView($view = null, $data = [], array $mergedData = [])
    {
        $html = (new WebResponse())->getBladeInstance()->make($view, $data)->render();

        return self::success('', array_merge(['html' => $html], $mergedData));
    }
}