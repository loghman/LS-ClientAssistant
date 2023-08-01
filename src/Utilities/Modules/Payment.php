<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Payment
{
    public static function request($userToken, $cartId, $callbackUrl, array $headers = []): Collection
    {
        try {
            return API::post("v1/payment/request/$cartId", ['callbackUrl' => $callbackUrl], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function response($userToken, $paymentId, array $headers = []): Collection
    {
        try {
            return API::post("v1/payment/response/$paymentId", [], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}