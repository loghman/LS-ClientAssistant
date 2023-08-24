<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class Shop extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'shop', 'get', $idOrSlug);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_shop'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];

            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/shop/product/' . $idOrSlug, [
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
            $cacheKey = make_cache_unique_key($GLOBALS['appName'], 'shop', 'list', $keyValues);
            $cacheConfig = [
                'is_active' => (bool)setting('client_cache_request_shop'),
                'expiration_time' => (int)setting('client_cache_revalidation_time'),
            ];

            return API::getOrFromCache($cacheKey, $cacheConfig, 'v1/shop/product/list', [
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
            return API::get('v1/shop/product/list', [
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
}