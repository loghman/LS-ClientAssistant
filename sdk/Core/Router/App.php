<?php

namespace Ls\ClientAssistant\Core\Router;

class App
{
    private $router;
    private $response;

    public function __construct($router, $response)
    {
        $this->router = $router;
        $this->response = $response;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getResponse()
    {
        return $this->response;
    }
}