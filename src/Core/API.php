<?php

namespace Ls\ClientAssistant\Core;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Tools\Paginator;

class API
{
    public static function guzzle(): Client
    {
        return new Client([
            'base_uri' => Config::get('endpoints.base'),
            'headers' => [
                'Client-Api-Key' => $GLOBALS['apikey'],
            ],
        ]);
    }

    public static function get(string $uri, array $queryParam = [], $headers = []): Collection
    {
        $headerData = array(
            'Client-Api-Key: ' . $GLOBALS['apikey'],
            'Content-Type: application/json'
        );
        $mergedHeaders = array_merge($headerData, $headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, (Config::get('endpoints.base') . $uri . '?' . http_build_query($queryParam)));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $mergedHeaders);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
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
            return collect(json_decode($redisClient->get($cacheKey)));
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
        $headerData = array(
            'Client-Api-Key: ' . $GLOBALS['apikey'],
            'Content-Type: application/json'
        );
        $mergedHeaders = array_merge($headerData, $headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $mergedHeaders);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function post(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headerData = array(
            'Client-Api-Key: ' . $GLOBALS['apikey'],
        );
        $mergedHeaders = array_merge($headerData, $headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $mergedHeaders);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($formParams));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function delete(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headerData = array(
            'Client-Api-Key: ' . $GLOBALS['apikey'],
        );
        $mergedHeaders = array_merge($headerData, $headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $mergedHeaders);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($formParams));

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
        } else {
            return collect($data);
        }
    }
}