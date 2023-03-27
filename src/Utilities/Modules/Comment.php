<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;

class Comment
{
    public static function getLMSProductComments(int $id, int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/comment', [
            'entity_type' => 'Product',
            'entity_id' => $id,
            'per_page' => $perPage,
        ]);
    }

    public static function getPostComments(int $id, int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/comment', [
            'entity_type' => 'Post',
            'entity_id' => $id,
            'per_page' => $perPage,
        ]);
    }

    public static function getShopProductComments(int $id, int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/comment', [
            'entity_type' => 'Shop',
            'entity_id' => $id,
            'per_page' => $perPage,
        ]);
    }
}