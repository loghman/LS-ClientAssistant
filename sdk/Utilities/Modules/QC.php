<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class QC extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return API::get('v1/lms/review/' . $idOrSlug, [
                'with' => json_encode($with)
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            return API::get('v1/lms/review', [
                'with' => json_encode($with),
                'filter' => json_encode($keyValues),
                'order_by' => $orderBy,
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function search(string $keyword, array $columns = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            return API::get('v1/lms/review', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addReview(array $data, string $userToken, array $headers = []): Collection
    {
        try {
            return API::post('v1/lms/review', [
                'product_id' => $data['product_id'],
                'item_id' => $data['item_id'],
                'rate' => $data['rate'],
                'comment' => $data['comment'] ?? null,
            ], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function updateReview(array $data, string $userToken, array $headers = []): Collection
    {
        try {
            return API::put('v1/lms/review', [
                'product_id' => $data['product_id'],
                'item_id' => $data['item_id'],
                'rate' => $data['rate'] ?? null,
                'comment' => $data['comment'] ?? null,
            ], [
                    'Authorization: Bearer ' . $userToken,
                ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getProductItemReviews(int $productItemId, array $with = []): Collection
    {
        try {
            return API::get('v1/lms/review/' . $productItemId . '/item', [
                'with' => json_encode($with)
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getProductItemReviewStats(int $productItemId): Collection
    {
        try {
            return API::get('v1/lms/review/' . $productItemId . '/item/stats');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getProductReviews(int $productId, array $with = []): Collection
    {
        try {
            return API::get('v1/lms/review/' . $productId . '/product', [
                'with' => json_encode($with)
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}