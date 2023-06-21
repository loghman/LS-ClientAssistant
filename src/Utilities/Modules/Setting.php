<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Helpers\Response;

class Setting
{
    private static $settings;

    public static function all(string $userToken): Collection
    {
        if (! is_null(self::$settings)) {
            return self::$settings;
        }

        try {
            self::$settings = GuzzleClient::post('v1/platform/settings', Config::get('endpoints.required_settings'), [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }

        return self::$settings;
    }
}