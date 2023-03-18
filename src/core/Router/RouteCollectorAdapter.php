<?php

namespace Ls\ClientAssistant\Core\Router;

use FastRoute\RouteCollector;

class RouteCollectorAdapter extends RouteCollector
{
    private string $viewAddress;

    public function view($route, $view)
    {
        $this->addRoute('GET', $route, function () use ($view) {
            view($view, $this->viewAddress);
        });
    }

    public function setViewAddress(string $address)
    {
        $this->viewAddress = $address;
    }
}