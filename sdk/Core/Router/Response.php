<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\Kernel;
use Ls\ClientAssistant\Core\StaticCache;
use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response
{
    private $blade;

    public function __construct()
    {
        $viewsPath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'views';
        $cachePath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'cache';
        $this->blade = (new Kernel())->registerBlade($viewsPath, $cachePath);
    }

    public function setBlade($blade)
    {
        $this->blade = $blade;
    }

    public function json(string $msg, int $status, array $data = [], array $headers = [])
    {
        $this->response->getBody()->write(json_encode([
            'message' => $msg,
            'data' => $data
        ], JSON_UNESCAPED_UNICODE));

        return $this->response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }

    public function successfullyCreated(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_CREATED, $data, $headers);
    }

    public function success(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_OK, $data, $headers);
    }

    public function forbidden(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_FORBIDDEN, $data, $headers);
    }

    public function notFound(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_NOT_FOUND, $data, $headers);
    }

    public function unprocessableEntity(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY, $data, $headers);
    }

    public function badRequest(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_BAD_REQUEST, $data, $headers);
    }

    public function notImplemented(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_NOT_IMPLEMENTED, $data, $headers);
    }

    public function serviceUnavailable(string $msg, array $data = [], array $headers = [])
    {
        return $this->json($msg, SymfonyResponse::HTTP_SERVICE_UNAVAILABLE, $data, $headers);
    }

    public function sitemap(string $sitemap, array $data)
    {
        sitemap($sitemap, $data);
    }

    public static function view($view = null, $data = [])
    {
        $response = new static();

        echo $response->blade->make($view, $data)->render();
        exit;
    }

    public function viewEndStaticCache($view = null, $data = [])
    {
        echo $this->blade->make($view, $data)->render();

        StaticCache::end();

        return $this->response;
    }

    public static function viewAjax($view = null, $data = [], array $mergedData = [])
    {
        $response = new static();

        $html = $response->blade->make($view, $data)->render();

        return $response->success('', array_merge(['html' => $html], $mergedData));
    }

    public function redirect(string $toRoute = '')
    {
        redirect(site_url($toRoute));

        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function withStatus(int $code, string $reasonPhrase = '')
    {
        return $this->response->withStatus($code, $reasonPhrase);
    }

    public function getReasonPhrase(): string
    {
        return $this->response->getReasonPhrase();
    }
}