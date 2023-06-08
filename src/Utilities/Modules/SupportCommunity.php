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
}