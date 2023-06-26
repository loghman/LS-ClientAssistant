<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Cart
{
    public static function screen($userToken): Collection
    {
        try {
            return GuzzleClient::get('v1/cart/screen', [], [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function addItem($userToken, $entity_type, $entity_id, $ip): Collection
    {
        try {
            return GuzzleClient::post(
                'v1/cart/add', compact('entity_type', 'entity_id', 'ip'),
                ['Authorization' => 'Bearer '.$userToken]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function deleteItem($userToken, $itemId): Collection
    {
        try {
            return GuzzleClient::delete("v1/cart/delete/$itemId", [], [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}