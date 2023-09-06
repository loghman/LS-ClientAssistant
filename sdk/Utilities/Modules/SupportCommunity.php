<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class SupportCommunity
{
    public const TOPIC_FILTER_NEWEST = 'newest';
    public const TOPIC_FILTER_MOST_CONTROVERSIAL = 'mostControversial';
    public const TOPIC_FILTER_NO_REPLIES = 'noReplies';

    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return API::get('v1/support/community/' . $idOrSlug, [
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
            return API::get('v1/support/community', [
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
            return API::get('v1/support/community', [
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

    public static function rich(array $methods = []): Collection
    {
        try {
            return API::get('v1/support/community/rich', [
                'methods' => $methods,
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
            return API::get('v1/support/community/stats');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function topics(string $idOrSlug, int $perPage = 20, $page = null, $filter = null): Collection
    {
        try {
            return API::get(sprintf("v1/support/community/%s/topics", $idOrSlug), [
                'per_page' => $perPage,
                'page' => $page,
                'filter_by' => $filter,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function bestUsers(string $idOrSlug): Collection
    {
        try {
            return API::get(sprintf("v1/support/community/%s/best-users", $idOrSlug));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function bestTopics(string $idOrSlug): Collection
    {
        try {
            return API::get(sprintf("v1/support/community/%s/best-topics", $idOrSlug));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function randomUsers($count = 5): Collection
    {
        try {
            return API::get('v1/support/community/random-users', [
                'users_count' => $count,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}