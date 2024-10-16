<?php

namespace Ls\ClientAssistant\Core;

use Composer\InstalledVersions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Tools\IP;
use Ls\ClientAssistant\Utilities\Tools\Paginator;
use Ls\ClientAssistant\Utilities\Tools\Token;
use Symfony\Component\HttpFoundation\Response;

class API
{
    public static function get(string $uri, array $queryParam = [], array $headers = []): Collection
    {
        return self::sendRequest('GET', $uri, $queryParam, [], $headers);
    }

    public static function post(string $uri, array $formParams = [], array $headers = []): Collection
    {
        return self::sendRequest('POST', $uri, [], $formParams, $headers);
    }

    public static function put(string $uri, array $formParams = [], array $headers = []): Collection
    {
        return self::sendRequest('PUT', $uri, [], $formParams, $headers);
    }

    public static function patch(string $uri, array $formParams = [], array $headers = []): Collection
    {
        return self::sendRequest('PATCH', $uri, [], $formParams, $headers);
    }

    public static function delete(string $uri, array $formParams = [], array $headers = []): Collection
    {
        return self::sendRequest('DELETE', $uri, [], $formParams, $headers);
    }

    public static function getOrFromCache(
        string $cacheKey,
        array  $config,
        string $uri,
        array  $queryParam = [],
        array  $headers = []
    ): Collection {
        if (! $config['is_active']) {
            return self::get($uri, $queryParam, $headers);
        }

        $redisClient = Cache::getRedisInstance();

        if ($redisClient->exists($cacheKey)) {
            return collect(json_decode($redisClient->get($cacheKey), true));
        }

        $data = self::get($uri, $queryParam, $headers);
        $expire = ((int) $config['expiration_time']) * 60;
        $redisClient->set($cacheKey, json_encode($data->toArray()));
        $redisClient->expire($cacheKey, $expire);
        $redisClient->disconnect();

        return $data;
    }

    private static function sendRequest(
        string $method,
        string $uri,
        array  $queryParams = [],
        array  $formParams = [],
        array  $headers = []
    ): Collection {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        $url = Config::get('endpoints.base').$uri;

        if ($method === 'GET' && ! empty($queryParams)) {
            $url .= '?'.http_build_query($queryParams);
        }

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_HEADER => true,
        ]);

        if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        }

        if (! empty($_ENV['IGNORE_SSL']) && ($_ENV['IGNORE_SSL'] === true || $_ENV['IGNORE_SSL'] === 'true')) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $effectiveUrl = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);

        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);

        curl_close($curl);

        return self::processResponse($body, $httpCode, $headers, $effectiveUrl);
    }

    private static function processResponse($response, $httpCode): Collection
    {
        $responseData = json_decode($response ?? '', true);
        $responseData['status_code'] = $httpCode;

        if ($httpCode === Response::HTTP_SERVICE_UNAVAILABLE) {
            include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'maintenance-mode.blade.php';
            die;
        }

        if ($httpCode === Response::HTTP_FORBIDDEN && $responseData['message'] === 'You are not logged in.') {
            self::manuallyLogout();
        }

        if ($httpCode === Response::HTTP_MULTI_STATUS && isset($responseData['data']['redirect'])) {
            header('Location: '.$responseData['data']['redirect'], true, $responseData['data']['code']);
            exit;
        }

        if (isset($responseData['data']['data'])) {
            return collect(Paginator::setLink($responseData));
        }

        if (is_array($responseData)) {
            $responseData['success'] = $responseData['success'] ?? $responseData['status'] ?? false;
            $responseData['data'] = $responseData['data'] ?? $responseData['result'] ?? [];
            $responseData['message'] = $responseData['message'] ?? ($responseData['errors'][0] ?? '');

            return collect($responseData);
        }

        return collect(['success' => false, 'data' => [], 'message' => (string) $response]);
    }

    private static function handleHeaders(array $headers): array
    {
        $headers = self::removeAuthorizationHeader($headers);
        $ip = IP::get();
        $cookies = self::mergeCookies();
        $version = InstalledVersions::getVersion('ls/client-assistant');

        $defaultHeaders = [
            'Api-Key: '.$GLOBALS['apikey'],
            'Content-Type: application/json',
            'REAL-HTTP-CLIENT-IP: '.$ip,
            'REAL-HTTP-CLIENT-AGENT: '.($_SERVER['HTTP_USER_AGENT'] ?? ''),
            'REAL-HTTP-CLIENT-REFERRER: '.($_SERVER['HTTP_REFERER'] ?? ''),
            "Cookie: $cookies",
            'LSPWEB-SDK-VERSION: '.$version,
        ];

        $userToken = User::getToken();
        if (null !== $userToken) {
            $defaultHeaders[] = 'Authorization: Bearer '.User::getToken();
        }

        return array_unique(array_merge($defaultHeaders, $headers));
    }

    private static function mergeCookies(): string
    {
        return implode(
            '; ',
            array_map(
                fn($key, $value) => "$key=$value",
                array_keys($_COOKIE),
                $_COOKIE
            )
        );
    }

    private static function manuallyLogout(): void
    {
        User::clearUserKeyCookie();
        Token::token()->remove();
        header("Refresh: 0");
    }

    private static function removeAuthorizationHeader(array $headers): array
    {
        return array_filter($headers, function ($header) {
            return ! str_contains(strtolower($header), 'authorization: bearer');
        });
    }
}
