<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class SupportCommunity
{

    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community/' . $idOrSlug, [
                'with' => json_encode($with),
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(array $with = [], array $keyValues = [], int $perPage = 20, $orderBy = OrderByEnum::LATEST): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community', [
                'with' => json_encode($with),
                'filter' => json_encode($keyValues),
                'order_by' => $orderBy,
                'per_page' => $perPage,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function stats(): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community/stats');
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function topics(string $idOrSlug, int $perPage = 20, $page = null): Collection
    {
        try {
            return GuzzleClient::get(sprintf("v1/support/community/%s/topics", $idOrSlug), [
                'per_page' => $perPage,
                'page' => $page,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function bestUsers(string $idOrSlug): Collection
    {
        try {
            return GuzzleClient::get(sprintf("v1/support/community/%s/best-users", $idOrSlug));
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function bestTopics(string $idOrSlug): Collection
    {
        try {
            return GuzzleClient::get(sprintf("v1/support/community/%s/best-topics", $idOrSlug));
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}