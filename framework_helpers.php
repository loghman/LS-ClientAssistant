<?php

use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\Setting;
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
        $class = sprintf("Ls\ClientAssistant\Services\Seo\MetaTags\%sSeoMeta", ucfirst($entity_type));
        if (!class_exists($class)) {
            throw new \Exception("Class ($class) Not Found!");
        }

        $seoMeta = new $class($entity);

        if (!empty($section)) {
            $methodName = sprintf('get%s', ucfirst($section));
            if (!method_exists($seoMeta, $methodName)) {
                throw new \Exception("Section ($section) Not Found!");
            }

            return $seoMeta->$methodName();
        }

        return $seoMeta->render($returnType);
    }
}

if (!function_exists('sitemap')) {
    function sitemap(string $sitemap, array $data): void
    {
        $class = sprintf("Ls\ClientAssistant\Services\Seo\SiteMaps\%sSiteMap", ucfirst($sitemap));
        if (!class_exists($class)) {
            throw new \Exception("Class ($class) Not Found!");
        }
        $sitemap = new $class($data);
        echo $sitemap->render();
    }
}

if (!function_exists('sub_words')) {
    function sub_words($content, $max_chars, $ellipsis = ' ...')
    {
        if (mb_strlen($content) <= $max_chars) {
            return $content;
        }

        return mb_substr(strip_tags($content), 0, $max_chars) . $ellipsis;
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url($remove_parameters = 0)
    {
        $uri = urldecode($_SERVER["REQUEST_URI"]);
        $domain = $_SERVER['HTTP_HOST'];
        if ($remove_parameters) {
            $uri = strtok($uri, '?');
        }

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
        foreach ($headers as $header) {
            header($header);
        }
        view("errors.$code", compact('code', 'message'));
        die();
    }
}

if (!function_exists('get_or_fail')) {
    function get_or_fail($response, $message = null)
    {
        if (empty($response['data']) || empty($response)) {
            abort(404, $message);
        }

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

        return compact('pageMeta', 'editMode', 'canEdit', 'routeName', 'entityType', 'entityId');
    }
}

if (!function_exists('get_cookie_domain')) {
    function get_cookie_domain(): string
    {
        $host = parse_url(core_url())['host'] ?? null;
        $array = explode(".", $host);

        return (array_key_exists(count($array) - 2, $array) ? $array[count($array) - 2] : "") . "." . $array[count($array) - 1];
    }
}

if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        $settings = Setting::all()->toArray();

        if (!$key) {
            return $settings;
        }

        if (($index = array_search($key, array_column($settings, 'key'))) === false) {
            return $default;
        }

        return $settings[$index]['value'] ?? $default;
    }
}

if (!function_exists('get_user_login_fields')) {
    function get_user_login_fields()
    {
        $userLoginFields = json_decode(setting('user_login_fields'), true);

        return !is_array($userLoginFields) || empty($userLoginFields)
            ? Config::get('auth.default_user_login_fields') : $userLoginFields;
    }
}

if (!function_exists('get_registration_fields')) {
    function get_registration_fields()
    {
        $registrationFields = json_decode(setting('registration_fields'), true);
        if (!is_array($registrationFields) || empty($registrationFields)) {
            $registrationFields = Config::get('auth.default_registration_fields');
        }
        sort($registrationFields);

        return $registrationFields;
    }
}

if (!function_exists('get_required_registration_fields')) {
    function get_required_registration_fields()
    {
        $requiredRegistrationFields = json_decode(setting('required_registration_fields'), true);

        return !is_array($requiredRegistrationFields) || empty($requiredRegistrationFields) ?
            Config::get('auth.default_required_registration_fields') : $requiredRegistrationFields;
    }
}

if (!function_exists('get_verification_fields')) {
    function get_verification_fields()
    {
        $verificationFields = json_decode(setting('verification_fields'), true);

        return !is_array($verificationFields) || empty($verificationFields)
            ? Config::get('auth.default_verification_fields') : $verificationFields;
    }
}

if (!function_exists('auth_label')) {
    function auth_label()
    {
        $userLoginFields = get_user_login_fields();
        $usernameLabel = setting('username_label');
        $availableUserLoginFields = Config::get('auth.available_user_login_fields');
        $text = '';
        foreach ($userLoginFields as $field) {
            if ($field == 'username') {
                $trans = $usernameLabel ?? ($availableUserLoginFields[$field] ?? $field);
            } else {
                $trans = $availableUserLoginFields[$field] ?? $field;
            }
            if (empty($text)) {
                $text .= $trans;
                continue;
            }
            $text .= " یا $trans";
        }

        return $text;
    }
}

if (!function_exists('toggle_errors')) {
    function toggle_errors(bool $status): void
    {
        $status = filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN);
        ini_set('display_errors', $status);
        ini_set('display_startup_errors', $status);
        error_reporting($status ? E_ALL : -1);
    }
}

if (!function_exists('is_production_environment')) {
    function is_production_environment(): bool
    {
        return isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'production';
    }
}

if (!function_exists('number_to_letter_persian')) {
    function number_to_letter_persian($number)
    {
        $letters = [
            "صفر",
            "اول",
            "دوم",
            "سوم",
            "چهارم",
            "پنجم",
            "ششم",
            "هفتم",
            "هشتم",
            "نهم",
            "دهم",
            "یازدهم",
            "دوازدهم",
            "سیزدهم",
            "چهاردهم",
            "پانزدهم",
            "شانزدهم",
            "هفدهم",
            "هجدهم",
            "نوزدهم",
            "بیستم",
            "بیست و یکم",
            "بیست و دوم",
            "بیست و سوم",
            "بیست و چهارم",
            "بیست و پنجم",
            "بیست و ششم",
            "بیست و هفتم",
            "بیست و هشتم",
            "بیست و نهم",
            "سی‌ام",
            "سی و یکم",
            "سی و دوم",
            "سی و سوم",
            "سی و چهارم",
            "سی و پنجم",
            "سی و ششم",
            "سی و هفتم",
            "سی و هشتم",
            "سی و نهم",
            "چهلم",
            "چهل و یکم",
            "چهل و دوم",
            "چهل و سوم",
            "چهل و چهارم",
            "چهل و پنجم",
            "چهل و ششم",
            "چهل و هفتم",
            "چهل و هشتم",
            "چهل و نهم",
            "پنجاهم",
            "پنجاه و یکم",
            "پنجاه و دوم",
            "پنجاه و سوم",
            "پنجاه و چهارم",
            "پنجاه و پنجم",
            "پنجاه و ششم",
            "پنجاه و هفتم",
            "پنجاه و هشتم",
            "پنجاه و نهم",
            "شصتم",
            "شصت و یکم",
            "شصت و دوم",
            "شصت و سوم",
            "شصت و چهارم",
            "شصت و پنجم",
            "شصت و ششم",
            "شصت و هفتم",
            "شصت و هشتم",
            "شصت و نهم",
            "هفتادم",
            "هفتاد و یکم",
            "هفتاد و دوم",
            "هفتاد و سوم",
            "هفتاد و چهارم",
            "هفتاد و پنجم",
            "هفتاد و ششم",
            "هفتاد و هفتم",
            "هفتاد و هشتم",
            "هفتاد و نهم",
            "هشتادم",
            "هشتاد و یکم",
            "هشتاد و دوم",
            "هشتاد و سوم",
            "هشتاد و چهارم",
            "هشتاد و پنجم",
            "هشتاد و ششم",
            "هشتاد و هفتم",
            "هشتاد و هشتم",
            "هشتاد و نهم",
            "نودم",
            "نود و یکم",
            "نود و دوم",
            "نود و سوم",
            "نود و چهارم",
            "نود و پنجم",
            "نود و ششم",
            "نود و هفتم",
            "نود و هشتم",
            "نود و نهم",
            "صدم",
            "صد و یکم",
            "صد و دوم",
            "صد و سوم",
            "صد و چهارم",
            "صد و پنجم",
            "صد و ششم",
            "صد و هفتم",
            "صد و هشتم",
            "صد و نهم",
            "صد و دهم",
            "صد و یازدهم",
            "صد و دوازدهم",
            "صد و سیزدهم",
            "صد و چهاردهم",
            "صد و پانزدهم",
            "صد و شانزدهم",
            "صد و هفدهم",
            "صد و هجدهم",
            "صد و نوزدهم",
            "صد و بیستم",
            "صد و بیست و یکم",
            "صد و بیست و دوم",
            "صد و بیست و سوم",
            "صد و بیست و چهارم",
            "صد و بیست و پنجم",
            "صد و بیست و ششم",
            "صد و بیست و هفتم",
            "صد و بیست و هشتم",
            "صد و بیست و نهم",
            "صد و سی‌ام",
            "صد و سی و یکم",
            "صد و سی و دوم",
            "صد و سی و سوم",
            "صد و سی و چهارم",
            "صد و سی و پنجم",
            "صد و سی و ششم",
            "صد و سی و هفتم",
            "صد و سی و هشتم",
            "صد و سی و نهم",
            "صد و چهلم",
            "صد و چهل و یکم",
            "صد و چهل و دوم",
            "صد و چهل و سوم",
            "صد و چهل و چهارم",
            "صد و چهل و پنجم",
            "صد و چهل و ششم",
            "صد و چهل و هفتم",
            "صد و چهل و هشتم",
            "صد و چهل و نهم",
            "صد و پنجاهم",
            "صد و پنجاه و یکم",
            "صد و پنجاه و دوم",
            "صد و پنجاه و سوم",
            "صد و پنجاه و چهارم",
            "صد و پنجاه و پنجم",
            "صد و پنجاه و ششم",
            "صد و پنجاه و هفتم",
            "صد و پنجاه و هشتم",
            "صد و پنجاه و نهم",
            "صد و شصتم",
            "صد و شصت و یکم",
            "صد و شصت و دوم",
            "صد و شصت و سوم",
            "صد و شصت و چهارم",
            "صد و شصت و پنجم",
            "صد و شصت و ششم",
            "صد و شصت و هفتم",
            "صد و شصت و هشتم",
            "صد و شصت و نهم",
            "صد و هفتادم",
            "صد و هفتاد و یکم",
            "صد و هفتاد و دوم",
            "صد و هفتاد و سوم",
            "صد و هفتاد و چهارم",
            "صد و هفتاد و پنجم",
            "صد و هفتاد و ششم",
            "صد و هفتاد و هفتم",
            "صد و هفتاد و هشتم",
            "صد و هفتاد و نهم",
            "صد و هشتادم",
            "صد و هشتاد و یکم",
            "صد و هشتاد و دوم",
            "صد و هشتاد و سوم",
            "صد و هشتاد و چهارم",
            "صد و هشتاد و پنجم",
            "صد و هشتاد و ششم",
            "صد و هشتاد و هفتم",
            "صد و هشتاد و هشتم",
            "صد و هشتاد و نهم",
            "صد و نودم",
            "صد و نود و یکم",
            "صد و نود و دوم",
            "صد و نود و سوم",
            "صد و نود و چهارم",
            "صد و نود و پنجم",
            "صد و نود و ششم",
            "صد و نود و هفتم",
            "صد و نود و هشتم",
            "دویستم"
        ];

        return $letters[$number];
    }
}