<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Cart
{
    public static function screen($userToken, array $headers = []): Collection
    {
        try {
            return API::get('v1/cart/screen', [], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addItem($userToken, $entity_type, $entity_id, $ip, array $headers = []): Collection
    {
        try {
            return API::post(
                'v1/cart/add',
                compact('entity_type', 'entity_id', 'ip'),
                ['Authorization: Bearer ' . $userToken] + $headers
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function deleteItem($userToken, $itemId, array $headers = []): Collection
    {
        try {
            return API::delete("v1/cart/delete/$itemId", [], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}