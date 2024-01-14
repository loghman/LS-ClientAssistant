<?php

namespace Ls\ClientAssistant\Core;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Tools\IP;
use Ls\ClientAssistant\Utilities\Tools\Paginator;
use Symfony\Component\HttpFoundation\Response;

class API
{
    public static function guzzle(): Client
    {
        return new Client([
            'base_uri' => Config::get('endpoints.base'),
            'headers' => [
                'Api-Key' => $GLOBALS['apikey'],
            ],
        ]);
    }

    public static function get(string $uri, array $queryParam = [], $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, (Config::get('endpoints.base') . $uri . '?' . http_build_query($queryParam)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode == Response::HTTP_SERVICE_UNAVAILABLE) {
            include_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'maintenance-mode.blade.php';
            die;
        }
        curl_close($curl);

        return self::parseData($response);
    }

    public static function getOrFromCache(string $cacheKey, array $config, string $uri, array $queryParam = [], $headers = []): Collection
    {
        if (!$config['is_active']) {
            return self::get($uri, $queryParam, $headers);
        }
        $redisClient = Cache::getRedisInstance();

        if ($redisClient->exists($cacheKey)) {
            return collect(json_decode($redisClient->get($cacheKey), true));
        }

        $data = self::get($uri, $queryParam, $headers);
        $expire = ((int)$config['expiration_time']) * 60;
        $redisClient->set($cacheKey, json_encode($data->toArray()));
        $redisClient->expire($cacheKey, $expire);
        $redisClient->disconnect();

        return $data;
    }

    public static function put(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function post(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function patch(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));

        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function delete(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));
        if (!empty($_ENV['IGNORE_SSL']) and $_ENV['IGNORE_SSL'] == true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function parseData($response): Collection
    {
        $data = json_decode($response ?? '', true);

        if (isset($data['data']['data'])) {
            return collect(Paginator::setLink($data));
        } else if(is_array($data)) {
            return collect($data);
        }

        return collect([
            'success' => false,
            'data' => [],
            'message' => $response
        ]);
    }

    private static function handleHeaders(array $headers): array
    {
        $ip = IP::get();

        foreach ($headers as $key => $header) {
            if (str_contains(strtolower($header), 'authorization: bearer')) {
                unset($headers[$key]);
            }
        }

        $version = \Composer\InstalledVersions::getVersion('ls/client-assistant');
        $cookies = self::mergeCookies();

        $headerData = [
            'Api-Key: ' . $GLOBALS['apikey'],
            'Content-Type: application/json',
            'REAL-HTTP-CLIENT-IP: ' . $ip,
            'REAL-HTTP-CLIENT-AGENT: ' . $_SERVER['HTTP_USER_AGENT'] ?? '',
            'REAL-HTTP-CLIENT-REFERRER: ' . ($_SERVER['HTTP_REFERER'] ?? ''),
            'Authorization: Bearer ' . User::getToken(),
            "Cookie: $cookies",
            'LSPWEB-SDK-VERSION: '. $version
        ];

        if (!empty($headers)) {
            $headerData[] = 'JWT: ' . self::generateJwt($headers);
        }

        return array_merge($headerData, $headers);
    }

    public static function mergeCookies(): string
    {
        $str = '';
        foreach ($_COOKIE as $key => $value) {
            $str .="$key=$value;";
        }
        return $str;
    }

    private static function generateJwt(array &$headers): string
    {
        $key = $GLOBALS['apikey'];

        $payload = [
            'iss' => $GLOBALS['appUrl'],
            'aud' => $GLOBALS['appUrl'],
            'iat' => \Carbon\Carbon::now()->timestamp,
            'exp' => \Carbon\Carbon::now()->addHour()->timestamp,
            'ip' => $headers['ip'] ?? $_SERVER['REMOTE_ADDR'],
            'token' => $headers['authorization'] ?? null,
        ];

        unset($headers['authorization']);
        unset($headers['ip']);

        return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
    }
}