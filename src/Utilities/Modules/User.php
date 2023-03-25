<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Contracts\Filterable;
use Ls\ClientAssistant\Core\Contracts\Searchable;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class User implements Filterable, Searchable
{
    public static function getUser(int $id, array $with = []): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/users/' . $id), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
            ]
        ]);

        return Response::single($response);
    }

    public static function getUsers(array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/users'), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }

    /*
     *
     * $keyValues sample = [
     *       'author_id' => 1,
     *       'category_id' => 1,
     * ]
     * */
    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        if (!in_array($orderBy, [OrderByEnum::LATEST, OrderByEnum::FIRST])) {
            throw new \InvalidArgumentException('Order by must be in [first, latest]');
        }

        $response = API::guzzle()->get(API::uri('v1/users'), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
                'per_page' => $perPage,
                'order_by' => $orderBy,
                'filter' => json_encode($keyValues),
            ],
        ]);

        return Response::many($response);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/users'), [
            RequestOptions::QUERY => [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }
}