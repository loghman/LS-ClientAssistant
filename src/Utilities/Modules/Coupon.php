<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;

class Coupon extends ModuleUtility
{
    public static function get(int $id, array $with = []): Collection
    {
        return GuzzleClient::get('v1/coupon/' . $id, [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        return GuzzleClient::get('v1/coupon/', [
            'with' => json_encode($with),
            'filter' => json_encode($keyValues),
            'order_by' => $orderBy,
            'per_page' => $perPage,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/coupon/', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }
}