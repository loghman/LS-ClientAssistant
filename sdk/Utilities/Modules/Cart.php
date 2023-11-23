<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Cart
{
    public static function screen(array $with = []): Collection
    {
        try {
            return API::get('v1/cart/screen', ['with' => json_encode($with)]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addItem(
        string $entity_type,
        int $entity_id,
        ?string $coupon,
        ?string $ip,
        array $headers = []
    ): Collection
    {
        try {
            return API::post(
                'v1/cart/add',
                compact('entity_type', 'entity_id', 'coupon', 'ip'),
                $headers
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function deleteItem($itemId, array $headers = []): Collection
    {
        try {
            return API::delete("v1/cart/delete/$itemId", [],  $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}