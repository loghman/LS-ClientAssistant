<?php

function site_url(string $uri): string
{
    return ($GLOBALS['appUrl'] ?? '')  . $uri;
}

function asset_url(string $path): string
{
    return ($GLOBALS['appUrl'] ?? '') . '/assets/' . $path;
}

function storage_url(string $path = null): string
{
    return ($GLOBALS['storageUrl'] ?? '') . '/' . $path;
}

function core_url(string $path = null): string
{
    return rtrim($GLOBALS['coreUrl'] ?? '', '/api/') . 'framework_helpers.php/' . $path;
}

function redirect($url)
{
    header("Location: $url");
    exit();
}


/*function view(string $view, array $vars = [])
{
    $viewsPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '../views' . DIRECTORY_SEPARATOR);
    $cachePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '../cache' . DIRECTORY_SEPARATOR);
    $blade = new BladeOne($viewsPath, $cachePath, BladeOne::MODE_DEBUG);
    echo $blade->run($view, $vars);
}*/