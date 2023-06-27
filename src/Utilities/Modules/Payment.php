<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Payment
{
    public static function request($userToken, $cartId, $callbackUrl): Collection
    {
        try {
            return GuzzleClient::post("v1/payment/request/$cartId", ['callbackUrl' => $callbackUrl], [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function response($userToken, $paymentId): Collection
    {
        try {
            return GuzzleClient::post("v1/payment/response/$paymentId", [], [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}