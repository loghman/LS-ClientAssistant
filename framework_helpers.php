<?php

use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Utilities\Modules\User;

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

if (!function_exists('seo_meta')) {
    function seo_meta($entity_type = null, $entity = null, $section = null, $returnType = 'html')
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

if (!function_exists('sub_words')) {
    function sub_words($content, $max_chars, $ellipsis = ' ...')
    {
        if (mb_strlen($content) <= $max_chars)
            return $content;
        return mb_substr(strip_tags($content), 0, $max_chars) . $ellipsis;
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url($remove_parameters = 0)
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

if (!function_exists('is_active_uri')) {
    function is_active_uri(string $uri): bool
    {
        if (str_starts_with($_SERVER['REQUEST_URI'], '/')) {
            return substr($_SERVER['REQUEST_URI'], 1) == $uri;
        }
        return $_SERVER['REQUEST_URI'] == $uri;
    }
}

if (!function_exists('is_active_uri_param')) {
    function is_active_uri_param(string $param): bool
    {
        return str_contains($_SERVER['REQUEST_URI'], $param);
    }
}

if (!function_exists('abort')) {
    function abort($code, $message = '', array $headers = [])
    {
        http_response_code($code);
        foreach ($headers as $header) header($header);
        view("errors.$code", compact('code', 'message'));
        die();
    }
}

if (!function_exists('get_or_fail')) {
    function get_or_fail($response, $message = null)
    {
        if (empty($response['data']) || empty($response)) abort(404, $message);
        return $response;
    }
}

if (!function_exists('site_url')) {
    function site_url(string $uri)
    {
        return ($_ENV['APP_URL'] ?? '') . '/' . $uri;
    }
}

if (!function_exists('asset_url')) {
    function asset_url(string $path)
    {
        return ($_ENV['APP_URL'] ?? '') . '/assets/' . $path;
    }
}

if (!function_exists('storage_url')) {
    function storage_url(string $path = null)
    {
        return ($_ENV['STORAGE_URL'] ?? '') . '/' . $path;
    }
}

if (!function_exists('base_storage_url')) {
    function base_storage_url()
    {
        return str_replace('/s', '', storage_url());
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

if (!function_exists('generate_storage_jwt_token')) {
    function generate_storage_jwt_token($userId): string
    {
        return \Ls\ClientAssistant\Helpers\Jwt::generate($userId, $_ENV['JWT_SECRET']);
    }
}

if (!function_exists('current_user')) {
    function current_user()
    {
        return \Ls\ClientAssistant\Utilities\Modules\User::getCurrent()['data'] ?? null;
    }
}

if (!function_exists('page_editor')) {
    function page_editor(string $routeName, string $entityType = null, string $entityId = null): array
    {
        $pageMetaResult = GuzzleClient::get('v1/marketing/page-meta/getMetadata', [
            'route_name' => $routeName,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
        ]);

        $pageMeta = $pageMetaResult['data'] ?? [];
        $editMode = ($_GET['mode'] ?? '') == 'edit';
        $user = User::me($_COOKIE['token']);
        $canEdit = in_array('pageeditor:update', ($user['data']['permissions'] ?? []), true);

        return compact('pageMeta', 'editMode', 'canEdit', 'routeName');
    }
}

if (! function_exists('get_cookie_domain')) {
    function get_cookie_domain() {
        $domain = core_url();

        return parse_url($domain)['host'] ?? null;
    }
}