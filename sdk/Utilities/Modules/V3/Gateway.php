<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Gateway extends Cacher
{
    public static function list(?int $amount = null): Collection
    {
        try {
            $data = null !== $amount ? ['amount' => $amount] : [];

            return API::get('client/v3/salesflow/gateway', $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getDefault(array $gateways = [], ?int $default = null, ?int $amount = null): ?array
    {
        $gateways = empty($gateways) ? self::list($amount)->get('data') : $gateways;

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
}