<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Payment extends Cacher
{

    public static function get(string $id, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/salesflow/payment/' . $id, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function list(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/salesflow/payment', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function qPay(
        string  $entityType,
        string  $entityId,
        int  $gatewayId,
        string  $callback,
        ?string $couponLabel = null
    ): Collection {
        try {
            return API::get(
                "client/v3/salesflow/payment/quick/pay/{$gatewayId}",
                [
                    'entity_type' => $entityType,
                    'entity_id' => $entityId,
                    'backUrl' => $callback,
                    'coupon' => $couponLabel,
                ]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
