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
                'Api-Key' => $GLOBALS['apikey'],
            ],
        ]);
    }

    public static function get(string $uri, array $queryParam = [], $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, (Config::get('endpoints.base') . $uri . '?' . http_build_query($queryParam)));
        curl_setopt($curl, CURLOPT_INTERFACE, get_ip());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return self::parseData($response);
    }

    public static function put(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $headers = self::handleHeaders($headers);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, Config::get('endpoints.base') . $uri);
        curl_setopt($curl, CURLOPT_INTERFACE, get_ip());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formParams));

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
        curl_setopt($curl, CURLOPT_INTERFACE, get_ip());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($formParams));

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
        curl_setopt($curl, CURLOPT_INTERFACE, get_ip());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
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

    private function handleHeaders(array $headers): array
    {
        $headerData = [
            'Api-Key: ' . $GLOBALS['apikey'],
            'Content-Type: application/json',
        ];

        if (!empty($headers)) {
            $headerData[] = 'JWT: ' . self::generateJwt($headers);
        }

        return array_merge($headerData, $headers);
    }

    private static function generateJwt(array &$headers): string
    {
        $key = $GLOBALS['apikey'];

        $payload = [
            'iss' => $GLOBALS['appUrl'],
            'aud' => $GLOBALS['appUrl'],
            'iat' => \Carbon\Carbon::now()->timestamp,
            'exp' => \Carbon\Carbon::now()->addHour()->timestamp,
            'ip' => $headers['ip'] ?? null,
            'token' => $headers['authorization'] ?? null,
        ];

        unset($headers['authorization']);
        unset($headers['ip']);

        return \Firebase\JWT\JWT::encode($payload, $key, 'HS256');
    }
}