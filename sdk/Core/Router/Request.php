<?php

namespace Ls\ClientAssistant\Core\Router;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest
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

    public function getAttribute(string $name, $default = null)
    {
        return $this->routeArguments[$name] ?? $default;
    }
}