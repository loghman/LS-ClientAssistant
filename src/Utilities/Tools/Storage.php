<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;

class Storage
{
    public static function generateJwtToken(string $userToken): ?string
    {
        $guzzle = API::self();
        $response = $guzzle->get('v1/storage-jwt-token', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $userToken,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['data']['jwt-token'] ?? null;
    }
}