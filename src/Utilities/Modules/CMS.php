<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Enums\CMSSignalEnum;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class CMS extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/cms/' . $idOrSlug, [
                'with' => json_encode($with),
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            if (!in_array($orderBy, [OrderByEnum::FIRST, OrderByEnum::LATEST, OrderByEnum::MOST_COMMENTED, OrderByEnum::MOST_VISITED])) {
                throw new \InvalidArgumentException('Order by must be in [first, latest, most_commented, most_visited]');
            }

            return GuzzleClient::get('v1/cms', [
                'filter' => json_encode($keyValues),
                'with' => json_encode($with),
                'per_page' => $perPage,
                'order_by' => $orderBy,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/cms', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function signal(int $postId, string $type, string $value): Collection
    {
        try {
            if (!in_array($type, [CMSSignalEnum::VISIT, CMSSignalEnum::LIKE, CMSSignalEnum::DISLIKE, CMSSignalEnum::RATE, CMSSignalEnum::BOOKMARK])) {
                throw new \InvalidArgumentException('Type must be in [visit, like, dislike, rate, bookmark]');
            }

            return GuzzleClient::put('v1/cms/' . $postId . '/signal', [
                'type' => $type,
                'value' => $value,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function queryParams(array $params, array $with = [], int $perPage = 20): Collection
    {
        try {
            $data = [
                'with' => $with,
                'per_page' => $perPage,
            ];

            foreach ($params as $key => $value) {
                $data[$key] = $value;
            }

            return GuzzleClient::get('v1/cms/param', $data);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}