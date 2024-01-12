<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use GuzzleHttp\RequestOptions;
use Ls\ClientAssistant\Core\API;

class Storage
{
    public static function generateJwtToken(string $userToken): ?string
    {
        $guzzle = API::guzzle();
        $response = $guzzle->get('v1/storage-jwt-token', [
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $userToken,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true)['data']['jwt-token'] ?? null;
    }
}