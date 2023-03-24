<?php

namespace Ls\ClientAssistant\Core;

use Ls\ClientAssistant\Core\Contracts\Middleware;
use Ls\ClientAssistant\Helpers\View;

class Router extends \AltoRouter
{
    private array $middlewares = [];
    private string $viewsDirectoryAddress = '';

    public function view(string $route, string $view): self
    {
        $this->map('GET', $route, function () use ($view) {
            include View::fullAddress($view, $this->viewsDirectoryAddress);
        });

        return $this;
    }

    public function setViewsDirectoryAddress(string $address): void
    {
        $this->viewsDirectoryAddress = $address;
    }

    public function middleware(Middleware|array $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}