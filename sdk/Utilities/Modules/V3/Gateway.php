<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Gateway
{
    public static function list(): Collection
    {
        try {
            return API::get('client/v3/salesflow/gateway');
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getDefault(): ?array
    {
        $gateways = self::list()->get('result');
        foreach ($gateways as $gateway) {
            if ($gateway['is_default'] === true) {
                return $gateway;
            }
        }

        return $gateways[0];
    }

    public static function get(int $id): Collection
    {
        try {
            return API::get("client/v3/salesflow/gateway/$id");
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}