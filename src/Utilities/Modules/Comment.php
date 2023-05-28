<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Comment
{
    public static function getLMSProductComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'Product',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getPostComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'Post',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getShopProductComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'Shop',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}