<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Gateway extends Cacher
{
    public static function list(?int $price = null): Collection
    {
        try {
            $data = null !== $price ? ['price' => $price] : [];
            
            return API::get('client/v3/salesflow/gateway', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getDefault(array $gateways = [], ?int $default = null, ?int $price = null): ?array
    {
        $gateways = empty($gateways) ? self::list($price)->get('data') : $gateways;

        if (null !== $default) {
            foreach ($gateways as $gateway) {
                if ($gateway['id'] === $default) {
                    return $gateway;
                }
            }
        }

        foreach ($gateways as $gateway) {
            if ($gateway['is_default'] === true) {
                return $gateway;
            }
        }

        return $gateways[0];
    }

    public static function findSnapPay(array $gateways): ?array
    {
        return null;
    }

    public static function snapPayEligible(float $amount): Collection
    {
        try {
            return API::get('client/v3/salesflow/gateway/snap-pay-eligible', ['amount' => $amount]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}