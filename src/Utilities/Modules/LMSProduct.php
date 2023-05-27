<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

class LMSProduct extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        return GuzzleClient::get('v1/lms/product/' . $idOrSlug, [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        return GuzzleClient::get('v1/lms/product', [
            'with' => json_encode($with),
            'filter' => json_encode($keyValues),
            'order_by' => $orderBy,
            'per_page' => $perPage,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/lms/product', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }

    public static function queryParams(array $params, array $with = [], int $perPage = 20): Collection
    {
        $data = [
            'with' => $with,
            'per_page' => $perPage,
        ];

        foreach ($params as $key => $value) {
            $data[$key] = $value;
        }

        return GuzzleClient::get('v1/lms/product/param', $data);
    }

    public static function chapters(int $productId): Collection
    {
        return GuzzleClient::get(sprintf('v1/lms/product/%s/chapters', $productId));
    }

    public static function chapterStats(int $productId, int $chapterId): Collection
    {
        return GuzzleClient::get(sprintf('v1/lms/product/%s/chapter/%s/stats', $productId, $chapterId));
    }
}
