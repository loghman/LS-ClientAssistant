<?php

namespace Ls\ClientAssistant\Core;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Tools\Paginator;

class GuzzleClient
{
    public static function get(string $uri, array $queryParam = []): Collection
    {
        $client = new Client([
            'base_uri' => Config::get('endpoints.base'),
            'headers' => [
                'Client-Api-Key' => $GLOBALS['apikey'],
            ],
        ]);

        $response = $client->get((Config::get('endpoints.base') . $uri), [
            RequestOptions::QUERY => $queryParam,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(Paginator::setLink(json_decode($response->getBody(), true)));
        }

        return collect();
    }

    public static function put(string $uri, array $formParams = []): Collection
    {
        $client = new Client();
        $response = $client->put($uri, [
            'headers' => [
                'Client-Api-Key' => $GLOBALS['apikey'],
            ],
            'form_params' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(Paginator::setLink(json_decode($response->getBody(), true)));
        }

        return collect();
    }

    public static function post(string $uri, array $formParams = []): Collection
    {
        $client = new Client();
        $response = $client->post($uri, [
            'headers' => [
                'Client-Api-Key' => $GLOBALS['apikey'],
            ],
            'form_params' => $formParams,
        ]);

        if (in_array($response->getStatusCode(), [200, 201])) {
            return collect(Paginator::setLink(json_decode($response->getBody(), true)));
        }

        return collect();
    }
}