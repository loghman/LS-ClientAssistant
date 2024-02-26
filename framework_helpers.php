<?php

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\Setting;
use Ls\ClientAssistant\Utilities\Modules\User;
use Illuminate\Container\Container;
use Ls\ClientAssistant\Utilities\Tools\CoreAsset;

if (!function_exists('site_url')) {
    function site_url(string $uri = ''): string
    {
        return ($GLOBALS['appUrl'] ?? '') . $uri;
    }
}

if (!function_exists('asset_url')) {
    function asset_url(string $path): string
    {
        return ($GLOBALS['appUrl'] ?? '') . 'assets/' . $path;
    }
}

if (!function_exists('core_url')) {
    function core_url(string $path = null)
    {
        return rtrim(env('CORE_URL') ?? '', '/api/') . '/' . $path;
    }
}

if (!function_exists('redirect')) {
    function redirect($url, int $responseCode = 0)
    {
        header("Location: $url", true, $responseCode);
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
    function abort($code, $message = '', $buttonText = null, $buttonUrl = null, array $headers = [])
    {
        http_response_code($code);
        foreach ($headers as $header) header($header);

        send_abort_notification($code);

        \Ls\ClientAssistant\Core\Router\WebResponse::view("errors.$code", compact('code', 'message', 'buttonText', 'buttonUrl'));
        die();
    }

}

if (!function_exists('send_abort_notification')) {
    function send_abort_notification($code): void
    {
        if (!filter_var(env('ABORT_NOTIFICATION'), FILTER_VALIDATE_BOOLEAN)) return;
        $redisClient = Ls\ClientAssistant\Core\Cache::getRedisInstance();
        $url = get_current_url();
        $referer = $_SERVER['HTTP_REFERER'] ?? null;
        $filterDomains = env('TELEGRAM_ABORT_FILTER_BY_REFERER_DOMAINS');
        if (!empty($filterDomains) && !in_array(get_main_domain($referer), explode(',', $filterDomains))) return;
        $cacheKey = sprintf('abort_%s_%s', $code, urlencode($url));
        if ($redisClient->exists($cacheKey)) return;

        if (is_static_file($url)) {
            $expire = 24 * 60 * 60;
            $redisClient->set($cacheKey, $url);
            $redisClient->expire($cacheKey, $expire);
        }

        $redisClient->disconnect();

        $ip = get_ip();
        $user = current_user();
        $userData = null;
        if (!is_null($user)) {
            $name = $user['real_name'] ?? $user['display_name'];
            $userData .= "\n👨 <b>User ID:</b> {$user['id']}";
            $userData .= "\n👨 <b>User Name:</b> $name";
        }

        $refererText = !empty($referer) ? "\n<b>REF:</b> " . $_SERVER['HTTP_REFERER'] : null;
        $gregorianDate = date('Y-m-d H:i:s');
        $jalaliTime = verta($gregorianDate);
        $telegramText = <<<TEXT
            <b>$code</b> Abort Happened
            $url$refererText$userData
            🌎 <b>IP:</b> $ip
            ⏰ <b>TG:</b> $gregorianDate
            ⏰ <b>TJ:</b> $jalaliTime
            TEXT;

        telegram_simple_message($telegramText, topicID: env('TELEGRAM_ABORT_TOPIC_ID'));
    }
}

if (!function_exists('get_or_fail')) {
    function get_or_fail($response, $message = null, $buttonText = null, $buttonUrl = null)
    {
        if (empty($response['data']) || empty($response)) {
            abort(404, $message, $buttonText, $buttonUrl);
        }

        return $response;
    }
}

if (!function_exists('site_url')) {
    function site_url(string $uri)
    {
        return (env('APP_URL') ?? '') . '/' . $uri;
    }
}

if (!function_exists('asset_url')) {
    function asset_url(string $path)
    {
        return (env('APP_URL') ?? '') . '/assets/' . $path;
    }
}

if (!function_exists('storage_url')) {
    function storage_url(string $path = null)
    {
        return build_full_url(\setting('_env_statics_base_url'), $path);
    }
}

if (!function_exists('base_storage_url')) {
    function base_storage_url()
    {
        return rtrim(storage_url(), '/s',);
    }
}

if (!function_exists('core_url')) {
    function core_url(string $path = null)
    {
        return rtrim(env('CORE_URL') ?? '', '/api/') . '/' . $path;
    }
}

if (!function_exists('generate_storage_jwt_token')) {
    function generate_storage_jwt_token($userId): string
    {
        return \Ls\ClientAssistant\Helpers\Jwt::generate($userId, env('JWT_SECRET', ''));
    }
}

if (!function_exists('current_user')) {
    function current_user()
    {
        return \Ls\ClientAssistant\Utilities\Modules\User::getCurrent()['data'] ?? null;
    }
}

if (!function_exists('current_user_id')) {
    function current_user_id(): ?int
    {
        return \Ls\ClientAssistant\Utilities\Modules\User::getCurrent()['data']['id'] ?? null;
    }
}

if (!function_exists('current_user_token')) {
    function current_user_token(): ?string
    {
        return \Ls\ClientAssistant\Utilities\Modules\User::getToken();
    }
}

if (!function_exists('page_editor')) {
    function page_editor(string $routeName, string $entityType = null, string $entityId = null): array
    {
        $pageMetaResult = API::get('v1/marketing/page-meta/getMetadata', [
            'route_name' => $routeName,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
        ]);

        $pageMeta = $pageMetaResult['data'] ?? [];
        $editMode = ($_GET['mode'] ?? '') == 'edit';
        $user = User::getCurrent();
        $canEdit = in_array('pageeditor:update', ($user['data']['permissions'] ?? []), true);

        return compact('pageMeta', 'editMode', 'canEdit', 'routeName', 'entityType', 'entityId');
    }
}

if (!function_exists('request')) {
    /**
     * Get an instance of the current request or an input item from the request.
     *
     * @param array|string|null $key
     * @param mixed|null $default
     * @return mixed|Request|string|array|null
     */
    function request(array|string|null $key = null, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return app(Request::class);
        }

        if (is_array($key)) {
            return app(Request::class)->only($key);
        }

        $value = app(Request::class)->__get($key);

        return is_null($value) ? value($default) : $value;
    }
}

if (!function_exists('get_cookie_domain')) {
    function get_cookie_domain(): string
    {
        $currentHostUrl = parse_url(request()->url(), PHP_URL_HOST);
        $foreignHostUrl = null;
        if (env('CORE_URL')) {
            $foreignHostUrl = parse_url(env('CORE_URL'), PHP_URL_HOST);
        } elseif (!is_null(setting('client_url'))) {
            $foreignHostUrl = parse_url(setting('client_url'), PHP_URL_HOST);
        }

        if (is_null($currentHostUrl) || is_null($foreignHostUrl) || $currentHostUrl == $foreignHostUrl) {
            return '';
        }

        $urlParts = explode('.', $currentHostUrl);
        $topLevelDomain = end($urlParts);
        $secondLevelDomain = $urlParts[count($urlParts) - 2] ?? '';
        if (empty($secondLevelDomain)) {
            return '';
        }

        // Example: .7learn.com
        return ".$secondLevelDomain.$topLevelDomain";
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
        $status = filter_var(env('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN);
        ini_set('display_errors', $status);
        ini_set('display_startup_errors', $status);
        error_reporting($status ? E_ALL : -1);
    }
}

if (!function_exists('is_production_environment')) {
    function is_production_environment(): bool
    {
        return env('APP_ENV') && env('APP_ENV') == 'production';
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

if (!function_exists('to_persian_date')) {
    function to_persian_date($enDate, $format = '%d %B %Y، H:i')
    {
        if ($enDate instanceof \Carbon\Carbon) {
            $enDate = $enDate->toDateTimeString();
        }

        return to_persian_num(to_verta($enDate, $format));
    }
}

if (!function_exists('to_persian_num')) {
    function to_persian_num($str): string
    {
        $faNum = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $enNum = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($enNum, $faNum, (string)$str);
    }
}

if (!function_exists('to_english_num')) {
    function to_english_num($number)
    {
        $faNum = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $enNum = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($faNum, $enNum, (string)$number);
    }
}

if (!function_exists('to_verta')) {
    function to_verta($date, $format = '%d %B %Y، H:i')
    {
        return \Hekmatinasser\Verta\Verta::instance($date)->format($format);
    }
}

if (!function_exists('to_persian_price')) {
    function to_persian_price($price, $no_span = 0, $round = 0, $postfix = null): string
    {
        if($price == 0){
            return 'رایگان';
        }

        $currencyStr = is_null($postfix) ? "تومان" : "تومان$postfix";
        if ($round === 'hezar' || $round === 'thousand') {
            $price = round($price / 1000) * 1000;
        }

        if ($round === 'million') {
            $price = round($price / 1000000) * 1000000;
        }

        if ($price < 1000) {
            $str = to_persian_num($price) . " $currencyStr";
        } else if ($price < 1000000) {
            $str = to_persian_num(round($price / 1000)) . " هزار $currencyStr";
        } else {
            $str = to_persian_num(round($price / 1000000, 3)) . " میلیون $currencyStr";
        }

        return $str;
    }
}

if (!function_exists('get_referer')) {
    function get_referer()
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }
}

if (!function_exists('js_redirect_script')) {
    function js_redirect_script($url = '', $delay_ms = 500)
    {
        return "<script>
        setTimeout(function() {
            location.href = '$url'
        }, $delay_ms);
        </script>";
    }
}

if (!function_exists('get_ip')) {
    function get_ip()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $tmp = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ipAddress = array_pop($tmp);
        }
        return trim($ipAddress);
    }
}

if (!function_exists('geoip_infos')) {
    function geoip_infos($ip = null)
    {
        $ip = $ip ?? get_ip();
        $json = file_get_contents("http://ip-api.ir/info/{$ip}");
        return \Ls\ClientAssistant\Utilities\Tools\Validation::isValidJson($json) ? json_decode($json) : null;
    }
}

if (!function_exists('convert_seconds_to_persian_time')) {
    function convert_seconds_to_persian_time($seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        if ($hours > 0) {
            $time = \Carbon\Carbon::createFromTime($hours, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('HH:mm:ss');
        } else {
            $time = \Carbon\Carbon::createFromTime(0, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('mm:ss');
        }

        return to_persian_num($time);
    }
}

if (!function_exists('convert_seconds_to_persian_time_without_seconds')) {
    function convert_seconds_to_persian_time_without_seconds($seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        if ($hours > 0) {
            $time = \Carbon\Carbon::createFromTime($hours, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('HH:mm\"');
        } else {
            $time = \Carbon\Carbon::createFromTime(0, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('mm\"');
        }

        return to_persian_num($time);
    }
}

if (!function_exists('convert_seconds_to_persian_in_line_time')) {
    function convert_seconds_to_persian_in_line_time($seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        if ($hours == 1 and $minutes == 0) {
            return sprintf("%s %s", '۱', 'ساعت');
        }

        if ($hours < 1) {
            return sprintf("%s دقیقه", to_persian_num(((int)$minutes)));
        }

        return sprintf("%s ساعت و %s دقیقه", to_persian_num($hours), to_persian_num($minutes));
    }
}

if (!function_exists('convert_byte')) {
    function convert_byte($bytes, $decimals = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $persianUnits = ['بایت', 'کیلوبایت', 'مگابایت', 'گیگابایت', 'ترابایت'];

        $kilobytes = $bytes / 1024;
        $megabytes = $kilobytes / 1024;

        $selectedUnit = 0;
        $formattedValue = $bytes;

        if ($bytes >= 1024) {
            while ($kilobytes >= 1024 && $selectedUnit < count($units) - 1) {
                $kilobytes /= 1024;
                $megabytes /= 1024;
                $selectedUnit++;
            }

            $formattedValue = $selectedUnit === 1 ? round($kilobytes, $decimals) : round($megabytes, $decimals);
        }

        return [
            'unit' => $persianUnits[$selectedUnit],
            'size' => to_persian_num($formattedValue),
        ];
    }
}

if (!function_exists('convert_seconds_to_diff_human_readable')) {
    function convert_datetime_to_diff_human_readable($datetime)
    {
        return to_persian_num((new Hekmatinasser\Verta\Verta($datetime))->formatDifference());
    }
}

if (!function_exists('make_cache_unique_key')) {
    function make_cache_unique_key($appName, $class, $method, $params): string
    {
        $key = sprintf("%s_%s_%s_%s", $appName, $class, $method, serialize($params));

        $key = preg_replace('/[^a-zA-Z0-9_]/', '', $key);

        return str_replace(' ', '', $key);
    }
}

if (!function_exists('client_assistant_routes')) {
    function client_assistant_routes()
    {
        return glob(__DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . '*.php');
    }
}

if (!function_exists('app')) {
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (!function_exists('get_content_index')) {
    function get_content_index($content, $just_featured = 0)
    {
        $tmpContent = strip_tags($content, '<h2><h3>');
        $seperator = '#|||#';
        $tmpContent = str_replace('<h2', "$seperator<h2", $tmpContent);
        $tmpContentArr = explode($seperator, $tmpContent);
        $dom = new domDocument();
        // $dom->preserveWhiteSpace = false;
        $indexs = [];
        if (count($tmpContentArr) < 3) return [];
        foreach ($tmpContentArr as $contentSegment) {
            if(empty($contentSegment)){
                continue;
            }
            @$dom->loadHTML(mb_convert_encoding($contentSegment, 'HTML-ENTITIES', 'UTF-8'));
            $h2 = $dom->getElementsByTagName('h2');
            if (is_null($h2->item(0)) || strlen($h2->item(0)->nodeValue) < 5) {
                continue;
            }
            $index = ['tag' => $h2->item(0)->tagName, 'text' => $h2->item(0)->nodeValue];

            $index['childs'] = null;
            $h3s = $dom->getElementsByTagName('h3');
            for ($i = 0; $i < $h3s->length; $i++) {
                $index['childs'][] = ['tag' => $h3s->item($i)->tagName, 'text' => $h3s->item($i)->nodeValue];
            }
            $indexs[] = $index;
        }
        return $indexs;
    }
}

if (!function_exists('hex_transparencies')) {
    function hex_transparencies($percent)
    {
        $arr = [
            100 => 'FF',
            99 => 'FC',
            98 => 'FA',
            97 => 'F7',
            96 => 'F5',
            95 => 'F2',
            94 => 'F0',
            93 => 'ED',
            92 => 'EB',
            91 => 'E8',
            90 => 'E6',
            89 => 'E3',
            88 => 'E0',
            87 => 'DE',
            86 => 'DB',
            85 => 'D9',
            84 => 'D6',
            83 => 'D4',
            82 => 'D1',
            81 => 'CF',
            80 => 'CC',
            79 => 'C9',
            78 => 'C7',
            77 => 'C4',
            76 => 'C2',
            75 => 'BF',
            74 => 'BD',
            73 => 'BA',
            72 => 'B8',
            71 => 'B5',
            70 => 'B3',
            69 => 'B0',
            68 => 'AD',
            67 => 'AB',
            66 => 'A8',
            65 => 'A6',
            64 => 'A3',
            63 => 'A1',
            62 => '9E',
            61 => '9C',
            60 => '99',
            59 => '96',
            58 => '94',
            57 => '91',
            56 => '8F',
            55 => '8C',
            54 => '8A',
            53 => '87',
            52 => '85',
            51 => '82',
            50 => '80',
            49 => '7D',
            48 => '7A',
            47 => '78',
            46 => '75',
            45 => '73',
            44 => '70',
            43 => '6E',
            42 => '6B',
            41 => '69',
            40 => '66',
            39 => '63',
            38 => '61',
            37 => '5E',
            36 => '5C',
            35 => '59',
            34 => '57',
            33 => '54',
            32 => '52',
            31 => '4F',
            30 => '4D',
            29 => '4A',
            28 => '47',
            27 => '45',
            26 => '42',
            25 => '40',
            24 => '3D',
            23 => '3B',
            22 => '38',
            21 => '36',
            20 => '33',
            19 => '30',
            18 => '2E',
            17 => '2B',
            16 => '29',
            15 => '26',
            14 => '24',
            13 => '21',
            12 => '1F',
            11 => '1C',
            10 => '1A',
            9 => '17',
            8 => '14',
            7 => '12',
            6 => '0F',
            5 => '0D',
            4 => '0A',
            3 => '08',
            2 => '05',
            1 => '03',
            0 => '00'
        ];

        return $arr[$percent];
    }
}

if (!function_exists('make_multi_uri_arguments_to_inline')) {
    function make_multi_uri_arguments_to_inline(array $uri_arguments): string
    {
        $currentSlug = array_filter($uri_arguments, function ($value) {
            return $value != null;
        });

        return implode('/', $currentSlug);
    }
}

if (!function_exists('number_to_letter_persian')) {
    function number_to_letter_persian($number)
    {
        $arr = [
            'صفرم',
            'اول',
            'دوم',
            'سوم',
            'چهارم',
            'پنجم',
            'ششم',
            'هفتم',
            'هشتم',
            'نهم',
            'دهم',
            'یازدهم',
            'دوازدهم',
            'سیزدهم',
            'چهاردهم',
            'پونزدهم',
            'شانزدهم',
            'هفدهم',
            'هجدهم',
            'نوزدهم',
            'بیستم',
        ];

        return $arr[$number];
    }
}

if (!function_exists('clear_static_cache')) {
    function clear_static_cache(): void
    {
        $cacheFolder = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'custom/';
        $cacheFiles = scandir($cacheFolder);

        foreach ($cacheFiles as $file) {
            $filePath = $cacheFolder . $file;
            if (is_file($filePath)) {
                unlink($filePath);
            }
        }
    }
}

if (!function_exists('clear_redis_cache')) {
    function clear_redis_cache(): void
    {
        $redisClient = \Ls\ClientAssistant\Core\Cache::getRedisInstance();
        $redisClient->flushdb();
        $redisClient->disconnect();
    }
}

if (!function_exists('telegram_simple_message')) {
    function telegram_simple_message(string $text, int $chatID = null, int $topicID = null): void
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatID = $chatID ?? env('TELEGRAM_CHAT_ID');
        $domain = env('TELEGRAM_API_DOMAIN') ?? 'mg.solutions';

        if (empty($token) || empty($chatID)) return;

        $curl = curl_init();
        $url = sprintf('https://%s/api/v1/t/sendSimpleMessage/bot%s?message_thread_id=%s&chat_id=-100%s&text=%s',
            $domain,
            $token,
            $topicID,
            $chatID,
            urlencode($text)
        );
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    }
}

if (!function_exists('is_static_file')) {
    function is_static_file(string $url): bool
    {
        if (empty($url)) return false;

        $staticExtensions = [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'bmp',
            'ico',
            'svg',
            'css',
            'js',
            'woff',
            'woff2',
            'ttf',
            'eot',
            'otf',
            'pdf',
            'doc',
            'docx',
            'ppt',
            'pptx',
            'xls',
            'xlsx',
            'txt',
            'mp3',
            'wav',
            'ogg',
            'flac',
            'mp4',
            'avi',
            'wmv',
            'mov',
            'flv',
            'webm',
            'zip',
            'rar',
            'tar',
            'gz',
            'csv',
            'xml',
            'json',
        ];

        $fileExtension = strtolower(pathinfo($url)['extension'] ?? '');
        return in_array($fileExtension, $staticExtensions);
    }
}

if (!function_exists('get_main_domain')) {
    function get_main_domain(?string $url = ''): ?string
    {
        $url = $url ?? '';
        $urlParts = parse_url($url);
        $host = $urlParts['host'] ?? $url;
        $host = preg_replace('/^www\./', '', $host);

        return preg_match('/[a-z0-9-]+\.[a-z.]{2,6}$/i', $host, $matches) ? $matches[0] : null;
    }
}

if (!function_exists('route')) {
    function route($name, $parameters = [], $absolute = true)
    {
        return app('url')->route($name, $parameters, $absolute);
    }
}

if (!function_exists('route_is')) {
    function route_is(...$patterns)
    {
        return app(Request::class)->routeIs(...$patterns);
    }
}

if (!function_exists('config')) {
    function config(string $path)
    {
        $configFolder = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'config/';
        $explodedPath = array_filter(explode('.', $path));
        if (empty($explodedPath)) {
            return null;
        }
        $configFilePath = $configFolder . $explodedPath[0] . '.php';
        if (!file_exists($configFilePath)) {
            return null;
        }
        unset($explodedPath[0]);

        $configFileContent = include $configFilePath;

        $contentOfKey = $configFileContent;
        foreach ($explodedPath as $key) {
            if (isset($contentOfKey[$key])) {
                $contentOfKey = $contentOfKey[$key];
            }
        }
        if ($contentOfKey == $configFileContent) {
            return null;
        }
        return $contentOfKey;
    }
}

if (!function_exists('core_asset')) {
    /**
     * Get the URL for an asset.
     *
     * @param string $asset
     * @param string|null $buildDirectory
     * @return string
     * @throws Exception
     */
    function core_asset(string $asset, string $buildDirectory = null): string
    {
        return (new CoreAsset)->asset($asset, $buildDirectory);
    }
}

if(!function_exists('sdk_path')){
    function sdk_path($path): string{
        return __DIR__ . '/' . $path;
    }
}

if(!function_exists('build_full_url')){
    function build_full_url(string $baseUrl, ?string $path = null): string {
        $baseUrl = rtrim($baseUrl, '/') . '/';
        if(is_null($path)) {
            return $baseUrl;
        }

        $path = ltrim($path, '/');
        return $baseUrl . $path;
    }
}

if(! function_exists('product_duration_to_string')){
    function product_duration_to_string(int $hours): string
    {
        $maxDurationHours = Config::get('lms.max_duration_hours_display');

        return  $hours > $maxDurationHours['en']
            ? sprintf("بیش از %s ساعت", $maxDurationHours['fa'])
            : to_persian_num($hours) . '  ساعت آموزش';
    }
}