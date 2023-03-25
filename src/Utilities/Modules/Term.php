<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Contracts\Filterable;
use Ls\ClientAssistant\Core\Contracts\Searchable;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class Term implements Searchable, Filterable
{

    public static function getTerm(int $id, array $with = []): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/term/' . $id), [
            RequestOptions::QUERY => [
                'with' => json_encode($with)
            ],
        ]);

        return Response::single($response);
    }

    public static function getTerms(array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/term'), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }

    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/term'), [
            RequestOptions::QUERY => [
                'filter' => json_encode($keyValues),
                'with' => json_encode($with),
                'per_page' => $perPage,
                'order_by' => $orderBy
            ],
        ]);

        return Response::many($response);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/term'), [
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