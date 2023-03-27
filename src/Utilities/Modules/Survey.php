<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

class Survey extends ModuleUtility
{
    public static function get(int $id, array $with = []): Collection
    {
        return GuzzleClient::get('v1/survey/' . $id, [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        return GuzzleClient::get('v1/survey', [
            'filter' => json_encode($keyValues),
            'with' => json_encode($with),
            'order_by' => $orderBy,
            'per_page' => $perPage,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/survey', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }
}