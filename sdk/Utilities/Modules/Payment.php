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

    public static function requestLink(int $cartId, int $gatewayId, string $callbackUrl): Collection
    {
        try {
            return API::post("v1/payment/request-link/$cartId/$gatewayId", [
                'redirect_url' => $callbackUrl,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function check(int $paymentId, string $page): Collection
    {
        try {
            return API::get("v1/payment/$paymentId", ['page' => $page]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}