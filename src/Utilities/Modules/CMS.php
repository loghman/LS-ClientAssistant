<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Contracts\Filterable;
use Ls\ClientAssistant\Core\Contracts\Searchable;
use Ls\ClientAssistant\Core\Enums\CMSSignalEnum;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class CMS implements Searchable, Filterable
{
    public static function getPost(int $id, array $with = []): Collection
    {
        // Including category
        // with: 'comment', 'product'

        $response = API::guzzle()->get(API::uri('v1/cms/' . $id), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
            ],
        ]);

        return Response::many($response);
    }

    public static function getPosts(array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/cms'), [
            RequestOptions::QUERY => [
                'with' => json_encode($with),
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        $response = API::guzzle()->get(API::uri('v1/cms'), [
            RequestOptions::QUERY => [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ],
        ]);

        return Response::many($response);
    }

    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        if (!in_array($orderBy, [OrderByEnum::FIRST, OrderByEnum::LATEST, OrderByEnum::MOST_COMMENTED, OrderByEnum::MOST_VISITED])) {
            throw new \InvalidArgumentException('Order by must be in [first, latest, most_commented, most_visited]');
        }

        $response = API::guzzle()->get(API::uri('v1/cms'), [
            RequestOptions::QUERY => [
                'filter' => json_encode($keyValues),
                'with' => json_encode($with),
                'per_page' => $perPage,
                'order_by' => $orderBy,
            ],
        ]);

        return Response::many($response);
    }

    public static function signal(int $postId, string $type, string $value): Collection
    {
        if (!in_array($type, [CMSSignalEnum::VISIT, CMSSignalEnum::LIKE, CMSSignalEnum::DISLIKE, CMSSignalEnum::RATE, CMSSignalEnum::BOOKMARK])) {
            throw new \InvalidArgumentException('Type must be in [visit, like, dislike, rate, bookmark]');
        }

        $response = API::guzzle()->put(API::uri('v1/cms/' . $postId . '/signal'), [
            'form_params' => [
                'type' => $type,
                'value' => $value,
            ]
        ]);

        return Response::single($response);
    }
}