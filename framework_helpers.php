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

if (!function_exists('seoMeta')) {
    function seoMeta($entity_type = null, $entity = null, $section = null, $returnType = 'html')
    {
        // validation
        $class = sprintf("Ls\ClientAssistant\Services\Seo\%sSeoMeta", ucfirst($entity_type));
        class_exists($class) || throw new \Exception("Class ($class) Not Found!");

        $seoMeta = new $class($entity);

        if (!empty($section)) {
            $methodName = sprintf('get%s', ucfirst($section));
            method_exists($seoMeta, $methodName) || throw new \Exception("Section ($section) Not Found!");
            return $seoMeta->$methodName();
        }

        return $seoMeta->render($returnType);
    }
}

if (!function_exists('subWords')) {
    function subWords($content, $max_chars, $ellipsis = ' ...')
    {
        if (mb_strlen($content) <= $max_chars)
            return $content;
        return mb_substr(strip_tags($content), 0, $max_chars) . $ellipsis;
    }
}

if (!function_exists('getCurrentUrl')) {
    function getCurrentUrl($remove_parameters = 0)
    {
        $uri = urldecode($_SERVER["REQUEST_URI"]);
        $domain = $_SERVER['HTTP_HOST'];
        if ($remove_parameters)
            $uri = strtok($uri, '?');
        return (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$domain}{$uri}";
    }
}

if (!function_exists('route')) {
    function route(string $path, array $data = [], array $queryParams = [])
    {
        global $routeParser;
        $route = $routeParser->urlFor($path, $data, $queryParams);
        return ($_ENV['APP_URL'] ?? '') . $route;
    }
}