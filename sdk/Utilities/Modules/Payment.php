<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Payment
{
    const PAGE_SUCCESS = 'success';
    const PAGE_FAILED = 'failed';

    public static function requestLink($cartId, $callbackUrl): Collection
    {
        try {
            return API::post("v1/payment/request-link/$cartId", ['redirect_url' => $callbackUrl]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function check($paymentId, string $page): Collection
    {
        try {
            return API::get("v1/payment/$paymentId", ['page' => $page]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function qPay(string $entityType, string $entityId, string $callback, ?string $couponLabel = null)
    {
        try {
            return API::get(
                "client/v3/salesflow/payment/quick/pay",
                [
                    'entity_type' => $entityType,
                    'entity_id' => $entityId,
                    'backUrl' => $callback,
                    'coupon' => $couponLabel,
                ]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}