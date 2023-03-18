<?php

namespace Ls\ClientAssistant\Core;

use Ls\ClientAssistant\Utilities\View;

class Router extends \AltoRouter
{
    private string $viewsDirectoryAddress = '';

    public function view(string $route, string $view)
    {
        $this->map('GET', $route, function () use ($view) {
            include View::fullAddress($view, $this->viewsDirectoryAddress);
        });
    }

    public function setViewsDirectoryAddress(string $address): void
    {
        $this->viewsDirectoryAddress = $address;
    }
}