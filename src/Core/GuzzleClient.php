<?php

namespace Ls\ClientAssistant\Core;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;

class GuzzleClient
{
    public static function get(string $uri, array $queryParam = []): Collection
    {
        $client = new Client(['base_uri' => Config::get('endpoints.base')]);
        $response = $client->get((Config::get('endpoints.base') . $uri), [
            'headers' => [
                'client_api_key' => $GLOBALS['apikey'],
            ],
            RequestOptions::QUERY => $queryParam,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody(), true));
        }

        return collect();
    }

    public static function put(string $uri, array $formParams = []): Collection
    {
        $client = new Client();
        $response = $client->put($uri, [
            'headers' => [
                'client_api_key' => $GLOBALS['apikey'],
            ],
            'form_params' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody(), true));
        }

        return collect();
    }

    public static function post(string $uri, array $formParams = []): Collection
    {
        $client = new Client();
        $response = $client->post($uri, [
            'headers' => [
                'client_api_key' => $GLOBALS['apikey'],
            ],
            'form_params' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(json_decode($response->getBody(), true));
        }

        return collect();
    }
}