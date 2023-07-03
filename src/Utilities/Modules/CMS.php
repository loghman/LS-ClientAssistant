<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Core\Enums\CMSSignalEnum;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Helpers\Response;

class CMS extends ModuleUtility
{
    public static function get(string $idOrSlug, array $with = []): Collection
    {
        try {
            return GuzzleClient::get('v1/cms/' . $idOrSlug, [
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
            if (!in_array($orderBy, [OrderByEnum::FIRST, OrderByEnum::LATEST, OrderByEnum::MOST_COMMENTED, OrderByEnum::MOST_VISITED])) {
                throw new \InvalidArgumentException('Order by must be in [first, latest, most_commented, most_visited]');
            }

            return GuzzleClient::get('v1/cms', [
                'filter' => json_encode($keyValues),
                'with' => json_encode($with),
                'per_page' => $perPage,
                'order_by' => $orderBy,
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
            return GuzzleClient::get('v1/cms', [
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

    public static function signal(int $postId, string $type, string $value): Collection
    {
        try {
            if (!in_array($type, [CMSSignalEnum::VIEWS, CMSSignalEnum::LIKES, CMSSignalEnum::DISLIKES, CMSSignalEnum::RATES, CMSSignalEnum::BOOKMARKS])) {
                throw new \InvalidArgumentException('Type must be in [visit, like, dislike, rate, bookmark]');
            }

            return GuzzleClient::put('v1/cms/' . $postId . '/signal', [
                'type' => $type,
                'value' => $value,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function queryParams(array $queryParams, array $customParams = [], array $with = [], int $perPage = 20): Collection
    {
        try {
            $data = [
                'with' => $with,
                'per_page' => $perPage,
                'custom_params' => $customParams
            ];

            foreach ($queryParams as $key => $value) {
                $data[$key] = $value;
            }

            return GuzzleClient::get('v1/cms/param', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function categories(array $keyValue = []): Collection
    {
        try {
            return GuzzleClient::get('v1/term', [
                'type' => 'category',
                'module' => 'cms',
                'filter' => json_encode($keyValue),
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addComment($postId, array $data = []): Collection
    {
        try {
            return GuzzleClient::post('v1/comment', [
                'entity_id' => $postId,
                'entity_type' => 'post',
                'author_name' => $data['name'] ?? null,
                'author_email' => $data['email'] ?? null,
                'content' => $data['content'] ?? null,
                'ip' => $data['ip'] ?? get_ip(),
                'rate' => $data['rate'] ?? null,
                'user_code' => $data['code'] ?? null,
                'parent_id' => $data['parent_id'] ?? null,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}