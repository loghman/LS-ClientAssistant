<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Enums\CMSSignalEnum;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

class CMS extends ModuleUtility
{
    public static function get(int|string $idOrSlug, array $with = []): Collection
    {
        return GuzzleClient::get('v1/cms/' . $idOrSlug, [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        if (!in_array($orderBy, [OrderByEnum::FIRST, OrderByEnum::LATEST, OrderByEnum::MOST_COMMENTED, OrderByEnum::MOST_VISITED])) {
            throw new \InvalidArgumentException('Order by must be in [first, latest, most_commented, most_visited]');
        }

        return GuzzleClient::get('v1/cms', [
            'filter' => json_encode($keyValues),
            'with' => json_encode($with),
            'per_page' => $perPage,
            'order_by' => $orderBy,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/cms', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }

    public static function signal(int $postId, string $type, string $value): Collection
    {
        if (!in_array($type, [CMSSignalEnum::VISIT, CMSSignalEnum::LIKE, CMSSignalEnum::DISLIKE, CMSSignalEnum::RATE, CMSSignalEnum::BOOKMARK])) {
            throw new \InvalidArgumentException('Type must be in [visit, like, dislike, rate, bookmark]');
        }

        return GuzzleClient::put('v1/cms/' . $postId . '/signal', [
            'type' => $type,
            'value' => $value,
        ]);
    }
}