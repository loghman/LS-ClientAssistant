<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Comment
{
    public static function getLMSProductComments(int $id, int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/comment'), [
            RequestOptions::QUERY => [
                'entity_type' => 'Product',
                'entity_id' => $id,
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }

    public static function getPostComments(int $id, int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/comment'), [
            RequestOptions::QUERY => [
                'entity_type' => 'Post',
                'entity_id' => $id,
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);

    }

    public static function getShopProductComments(int $id, int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/comment'), [
            RequestOptions::QUERY => [
                'entity_type' => 'Shop',
                'entity_id' => $id,
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }
}