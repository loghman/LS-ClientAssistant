<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;

class User extends ModuleUtility
{
    public static function me($barerToken): Collection
    {
        return GuzzleClient::get(('v1/user/me'), [
            'headers' => ['Authorization' => 'Bearer ' . $barerToken],
        ]);
    }

    public static function get(string $idOrSlug, array $with = []): Collection
    {
        return GuzzleClient::get(('v1/users/' . $idOrSlug), [
            'with' => json_encode($with),
        ]);
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        if (!in_array($orderBy, [OrderByEnum::LATEST, OrderByEnum::FIRST])) {
            throw new \InvalidArgumentException('Order by must be in [first, latest]');
        }

        return GuzzleClient::get('v1/users', [
            'with' => json_encode($with),
            'filter' => json_encode($keyValues),
            'per_page' => $perPage,
            'order_by' => $orderBy,
        ]);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        return GuzzleClient::get('v1/users', [
            's' => $keyword,
            'with' => json_encode($with),
            'columns' => json_encode($columns),
            'per_page' => $perPage,
        ]);
    }
}