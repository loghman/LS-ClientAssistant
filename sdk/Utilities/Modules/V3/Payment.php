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
        string  $callback,
        ?int  $gatewayId,
        ?string $couponLabel = null,
        ?string $verifyUrl = null,
    ): Collection {
        try {
            return API::post(
                'client/v3/salesflow/payment/quick/pay/',
                [
                    'entity_type' => $entityType,
                    'entity_id' => $entityId,
                    'back_url' => $callback,
                    'coupon' => $couponLabel,
                    'gateway' => $gatewayId,
                    'verify_url' => $verifyUrl,
                ]
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function verify(
        int $paymentId,
        string $paymentHash,
        array $data
    ): Collection {
        try {
            return API::post(
                "client/v3/salesflow/payment/{$paymentId}/verify",
                array_merge(['hash' => $paymentHash], $data)
            );
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
