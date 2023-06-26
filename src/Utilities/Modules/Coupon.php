<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\Contracts\ModuleUtility;
use Ls\ClientAssistant\Core\Enums\OrderByEnum;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Coupon
{
    public static function apply($userToken, $cartId, $coupon): Collection
    {
        try {
            return GuzzleClient::post("v1/coupon/apply/$cartId", compact('coupon'), [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function unapply($userToken, $cartId, $couponId): Collection
    {
        try {
            return GuzzleClient::delete("v1/coupon/unapply/$cartId/$couponId", [], [
                'Authorization' => 'Bearer '.$userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}