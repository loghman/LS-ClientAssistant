<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Enrollment extends ModuleUtility
{
    public static function get(string $id, array $with = []): Collection
    {
        try {
            return API::get('v1/lms/enrollment/' . $id, [
                'with' => json_encode($with),
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function start(int $id): Collection
    {
        try {
            return API::get('v1/lms/enrollment/' . $id . '/start');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function resume(int $id): Collection
    {
        try {
            return API::get('v1/lms/enrollment/' . $id . '/resume');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            return API::get('v1/lms/enrollment', [
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
            return API::get('v1/lms/enrollment', [
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

    public static function signal(int $enrollmentId, int $productItem, string $type, string $userToken, array $headers = []): Collection
    {
        try {
            if (!in_array($type, ['visited', 'completed', 'played'])) {
                throw new \InvalidArgumentException('Type must be in [visited, completed, played]');
            }

            $response = API::put(sprintf('v1/lms/enrollment/%s/signal/%s', $enrollmentId, $productItem), [
                'signal' => $type,
            ], $headers);

            return Response::success();
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logs(int $enrollmentId, string $userToken, array $headers = []): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $enrollmentId . '/logs'), [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getItemLog($enrollmentId, $productItemId, $userId): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $enrollmentId . '/item/' . $productItemId . '/log'), [
                'user_id' => $userId,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getChapterLog($enrollmentId, $chapter, $userId): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $enrollmentId . '/chapter/' . $chapter . '/log'), [
                'user_id' => $userId,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getLatestLog($enrollmentId, string $userToken, array $headers = []): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $enrollmentId . '/latest-log'), [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function findByUserAndProduct(int $productId, string $userToken, array $headers = []): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $productId . '/product'), [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function findByUserAndProductItem(int $productItemId, string $userToken, array $headers = []): Collection
    {
        try {
            return API::get(('v1/lms/enrollment/' . $productItemId . '/product-item'), [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function rich(array $methods = [], string $userToken = null): Collection
    {
        try {
            return API::get('v1/lms/enrollment/rich', [
                'methods' => $methods,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}