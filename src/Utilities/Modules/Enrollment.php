<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Enrollment extends ModuleUtility
{
    public static function get(string $id, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/enrollment/' . $id, [
                'with' => json_encode($with),
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/enrollment', [
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
            return GuzzleClient::get('v1/lms/enrollment', [
                's' => $keyword,
                'with' => json_encode($with),
                'columns' => json_encode($columns),
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function signal(int $enrollmentId, int $productItem, string $type, string $userToken): Collection
    {
        try {
            if (!in_array($type, ['visited', 'completed', 'played'])) {
                throw new \InvalidArgumentException('Type must be in [visited, completed, played]');
            }

            $response = GuzzleClient::put(sprintf('v1/lms/enrollment/%s/signal/%s', $enrollmentId, $productItem), [
                'signal' => $type,
            ], ['Authorization' => 'Bearer ' . $userToken]);

            return Response::success();
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function logs(int $enrollmentId, string $userToken): Collection
    {
        try {
            $guzzle = GuzzleClient::self();
            $response = $guzzle->get(('v1/lms/enrollment/' . $enrollmentId . '/logs'), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $userToken,
                ]
            ]);

            return collect(json_decode($response->getBody()->getContents()));
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}