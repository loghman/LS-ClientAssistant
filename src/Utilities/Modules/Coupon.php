<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Coupon
{
    public static function apply($userToken, $cartId, $coupon, array $headers = []): Collection
    {
        try {
            return API::post("v1/coupon/apply/$cartId", compact('coupon'), [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function unapply($userToken, $cartId, $couponId, array $headers = []): Collection
    {
        try {
            return API::delete("v1/coupon/unapply/$cartId/$couponId", [], [
                'Authorization: Bearer ' . $userToken,
            ] + $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}