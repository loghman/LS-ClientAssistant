<?php

namespace Ls\ClientAssistant\Core\Router;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements ServerRequestInterface
{
    private array $routeArguments = [];

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function setRouteArguments($routeArguments)
    {
        $this->routeArguments = $routeArguments;
    }

    public function getProtocolVersion()
    {

    }

    public function withProtocolVersion(string $version)
    {

    }

    public function getHeaders()
    {

    }

    public function hasHeader(string $name)
    {

    }

    public function getHeader(string $name)
    {

    }

    public function getHeaderLine(string $name)
    {

    }

    public function withHeader(string $name, $value)
    {

    }

    public function withAddedHeader(string $name, $value)
    {
    }

    public function withoutHeader(string $name)
    {
    }

    public function getBody()
    {
    }

    public function withBody(StreamInterface $body)
    {
    }

    public function getRequestTarget()
    {
    }

    public function withRequestTarget(string $requestTarget)
    {
    }

    public function getMethod()
    {
    }

    public function withMethod(string $method)
    {
    }

    public function getUri()
    {
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false)
    {
    }

    public function getServerParams()
    {
    }

    public function getCookieParams()
    {
    }

    public function withCookieParams(array $cookies)
    {
    }

    public function getQueryParams()
    {
    }

    public function withQueryParams(array $query)
    {
    }

    public function getUploadedFiles()
    {
    }

    public function withUploadedFiles(array $uploadedFiles)
    {
    }

    public function getParsedBody()
    {
    }

    public function withParsedBody($data)
    {
    }

    public function getAttributes()
    {
    }

    public function getAttribute(string $name, $default = null)
    {
        return $this->routeArguments[$name] ?? $default;
    }

    public function withAttribute(string $name, $value)
    {
    }

    public function withoutAttribute(string $name)
    {
    }
}