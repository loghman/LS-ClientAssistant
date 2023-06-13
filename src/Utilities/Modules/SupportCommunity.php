<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class SupportCommunity
{
    public const TOPIC_FILTER_NEWEST = 'newest';
    public const TOPIC_FILTER_MOST_CONTROVERSIAL = 'mostControversial';
    public const TOPIC_FILTER_NO_REPLIES = 'noReplies';

    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community/' . $idOrSlug, [
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
            return GuzzleClient::get('v1/support/community', [
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

    public static function stats(): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community/stats');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function topics(string $idOrSlug, int $perPage = 20, $page = null, $filter = null): Collection
    {
        try {
            return GuzzleClient::get(sprintf("v1/support/community/%s/topics", $idOrSlug), [
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
            return GuzzleClient::get(sprintf("v1/support/community/%s/best-users", $idOrSlug));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function bestTopics(string $idOrSlug): Collection
    {
        try {
            return GuzzleClient::get(sprintf("v1/support/community/%s/best-topics", $idOrSlug));
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}