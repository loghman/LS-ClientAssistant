<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Helpers\Response;
use Exception;

class Setting
{
    private static $settings;

    public static function all(): Collection
    {
        if (! is_null(self::$settings)) {
            return self::$settings;
        }

        try {
            $response = API::get('v1/platform/settings', ['keys' => Config::get('endpoints.required_settings')]);
            self::$settings = collect($response['data']);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }

        return self::$settings;
    }
}