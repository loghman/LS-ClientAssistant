<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\StaticCache;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use \Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response implements ResponseInterface
{
    public ResponseInterface $response;
    private $blade;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
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

        return $this->response;
    }

    public function view($view = null, $data = [])
    {
        echo $this->blade->make($view, $data)->render();

        return $this->response;
    }

    public function viewEndStaticCache($view = null, $data = [])
    {
        echo $this->blade->make($view, $data)->render();

        StaticCache::end();

        return $this->response;
    }

    public function viewAjax($view = null, $data = [], array $mergedData = [])
    {
        $html =  $this->blade->make($view, $data)->render();

        return $this->success('', array_merge(['html' => $html], $mergedData));
    }

    public function redirect(string $toRoute = '')
    {
        redirect(site_url($toRoute));

        return $this->response;
    }

    public function getProtocolVersion(): string
    {
        return $this->response->getProtocolVersion();
    }

    public function withProtocolVersion(string $version)
    {
        return $this->response->withProtocolVersion($version);
    }

    public function getHeaders(): array
    {
        return $this->response->getHeaders();
    }

    public function hasHeader(string $name): bool
    {
        return $this->response->hasHeader($name);
    }

    public function getHeader(string $name): array
    {
        return $this->response->getHeader($name);
    }

    public function getHeaderLine(string $name): string
    {
        return $this->response->getHeaderLine($name);
    }

    public function withHeader(string $name, $value)
    {
        return $this->response->withHeader($name, $value);
    }

    public function withAddedHeader(string $name, $value)
    {
        return $this->response->withAddedHeader($name, $value);
    }

    public function withoutHeader(string $name)
    {
        return $this->response->withoutHeader($name);
    }

    public function getBody(): StreamInterface
    {
        return $this->response->getBody();
    }

    public function withBody(StreamInterface $body)
    {
        return $this->response->withBody($body);
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