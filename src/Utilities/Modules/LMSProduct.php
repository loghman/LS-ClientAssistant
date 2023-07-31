<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class LMSProduct extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'lms_product', 'get', $idOrSlug);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_lms'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];

            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/lms/product/' . $idOrSlug, [
                'with' => json_encode($with),
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
            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'lms_product', 'list', $keyValues);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_lms'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];

            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/lms/product', [
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
            return API::get('v1/lms/product', [
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

    public static function rich(array $methods = [], string $userToken = null): Collection
    {
        try {
            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'lms_product', 'rich', $methods);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_lms'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];

            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/lms/product/rich', [
                'methods' => $methods,
            ], [
                'Authorization: Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
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

            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'lms_product', 'queryParams', $data);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_lms'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];
            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/lms/product/param', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function chapters(int $productId, string $userToken = null, array $with = []): Collection
    {
        $headers = [];
        if (!is_null($userToken)) {
            $headers = [
                'Authorization: Bearer ' . $userToken,
            ];
        }
        try {
            return API::get(sprintf('v1/lms/product/%s/chapters', $productId), [
                'with' => json_encode($with),
            ], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function chapterStats(int $productId, int $chapterId, string $userToken): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/chapter/%s/stats', $productId, $chapterId), [], [
                'Authorization: Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function nextItem(int $productId, int $itemId): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/item/%s/next', $productId, $itemId));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function prevItem(int $productId, int $itemId): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/item/%s/prev', $productId, $itemId));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function nextChapter(int $productId, int $chapterId): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/item/%s/next', $productId, $chapterId));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function prevChapter(int $productId, int $chapterId): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/item/%s/prev', $productId, $chapterId));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function faculty(int $productId): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/faculty', $productId));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function demo(int $productId, int $count = 7): Collection
    {
        try {
            return API::get(sprintf('v1/lms/product/%s/demo', $productId), [
                'count' => $count,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function createTopic(array $data, string $userToken): Collection
    {
        try {
            return API::post('v1/support/topic', [
                'entity_type' => 'lms_product_items',
                'entity_id' => $data['item_id'],
                'title' => $data['title'],
                'content' => $data['content'],
                'attachment' => $data['attachment'] ?? null,
                'is_anonymous' => $data['is_anonymous'] ?? null,
                'section' => $data['section'] ?? null,
                'community' => $data['community'] ?? null,
                'department' => $data['department'] ?? null,
            ], [
                'Authorization: Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function stats(): Collection
    {
        try {
            return API::get('v1/lms/product/stats');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function latest(int $count): Collection
    {
        try {
            return API::get('v1/lms/product', [
                'count' => $count,
                'order_by' => OrderByEnum::LATEST,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function byHighestStudentAmount($perPage = 12): Collection
    {
        try {
            return API::get('v1/lms/product/by-highest-student-amount', [
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
