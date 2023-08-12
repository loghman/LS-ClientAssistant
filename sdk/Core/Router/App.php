<?php

namespace Ls\ClientAssistant\Core\Router;

use Slim\App as SlimApp;

class App
{
    private SlimApp $router;
    private $routeParser;

    public function __construct(SlimApp $router, $routeParser)
    {
        $this->router = $router;
        $this->routeParser = $routeParser;
    }

    public function getRouter(): SlimApp
    {
        return $this->router;
    }

    public function getRouteParser()
    {
        return $this->routeParser;
    }
}