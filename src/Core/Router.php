<?php

namespace Core;

class Router extends \AltoRouter
{
    private string $viewsDirectoryAddress = '';

    public function view(string $route, string $view)
    {
        $this->map('GET', $route, function () use ($view) {
            include view($view, $this->viewsDirectoryAddress);
        });
    }

    public function setViewsDirectoryAddress(string $address): void
    {
        $this->viewsDirectoryAddress = $address;
    }
}