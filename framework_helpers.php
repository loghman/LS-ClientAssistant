<?php

if (!function_exists('site_url')) {
    function site_url(string $uri): string
    {
        return ($GLOBALS['appUrl'] ?? '') . $uri;
    }
}

if (!function_exists('asset_url')) {
    function asset_url(string $path): string
    {
        return ($GLOBALS['appUrl'] ?? '') . '/assets/' . $path;
    }
}

if (!function_exists('storage_url')) {
    function storage_url(string $path = null): string
    {
        return ($GLOBALS['storageUrl'] ?? '') . '/' . $path;
    }
}

if (!function_exists('core_url')) {
    function core_url(string $path = null)
    {
        return rtrim($_ENV['CORE_URL'] ?? '', '/api/') . '/' . $path;
    }
}


if (!function_exists('redirect')) {
    function redirect($url)
    {
        header("Location: $url");
        exit();
    }
}

/*function view(string $view, array $vars = [])
{
    $viewsPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '../views' . DIRECTORY_SEPARATOR);
    $cachePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '../cache' . DIRECTORY_SEPARATOR);
    $blade = new BladeOne($viewsPath, $cachePath, BladeOne::MODE_DEBUG);
    echo $blade->run($view, $vars);
}*/