<?php

namespace Ls\ClientAssistant\Core;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Tools\Paginator;

class GuzzleClient
{

    public static function self(): Client
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

        $headerData = [];
        $headerData['Client-Api-Key'] = $GLOBALS['apikey'];
        $headerData['Content-Type'] = 'application/json';
        $mergedHeaders = array_merge($headerData, $headers);

        $client = new Client([
            'base_uri' => Config::get('endpoints.base'),
            'headers' => $mergedHeaders
        ]);

        $response = $client->get((Config::get('endpoints.base') . $uri), [
            RequestOptions::QUERY => $queryParam,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return self::parseData($response);
        }

        return collect();
    }

    public static function put(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $client = new Client();

        $headerData = [];
        $headerData['Client-Api-Key'] = $GLOBALS['apikey'];
        $headerData['Content-Type'] = 'application/json';
        $mergedHeaders = array_merge($headerData, $headers);

        $response = $client->put((Config::get('endpoints.base') . $uri), [
            'headers' => $mergedHeaders,
            'json' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return self::parseData($response);
        }

        return collect();
    }

    public static function post(string $uri, array $formParams = [], array $headers = []): Collection
    {
        $client = new Client();
        $headerData = [];
        $headerData['Client-Api-Key'] = $GLOBALS['apikey'];
        $mergedHeaders = array_merge($headerData, $headers);

        $response = $client->post((Config::get('endpoints.base') . $uri), [
            'headers' => $mergedHeaders,
            'form_params' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return self::parseData($response);
        }

        return collect();
    }

    public static function parseData($response): Collection
    {
        $data = json_decode($response->getBody(), true);
        if (isset($data['data']['data'])) {
            return collect(Paginator::setLink($data));
        } else {
            return collect($data);
        }
    }
}