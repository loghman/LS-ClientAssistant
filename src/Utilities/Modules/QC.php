<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class QC extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/review' . $idOrSlug, [
                'with' => json_encode($with)
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/review', [
                'with' => json_encode($with),
                'filter' => json_encode($keyValues),
                'order_by' => $orderBy,
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/review', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addReview(array $data, string $userToken): Collection
    {
        try {
            return GuzzleClient::post('v1/lms/review', [
                'product_id' => $data['product_id'],
                'item_id' => $data['item_id'],
                'rate' => $data['rate'],
                'comment' => $data['comment'] ?? null,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}