<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Comment
{
    public static function getLMSProductComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'lms_products',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getPostComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'cms_posts',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getShopProductComments(int $id, int $perPage = 20): Collection
    {
        try {
            return GuzzleClient::get('v1/comment', [
                'entity_type' => 'shop_products',
                'entity_id' => $id,
                'per_page' => $perPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}