<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Config;
use Exception;

class Setting
{
    private static ?Collection $settings = null;

    private static function fetch(bool $cacheActive = true): void
    {
        if (self::$settings && self::$settings->isNotEmpty() && $cacheActive) {
            return;
        }

        try {
            $response = API::get('v1/platform/settings', ['keys' => Config::get('endpoints.required_settings')]);
            self::$settings = collect($response['data']);
        } catch (Exception $exception) {
            self::$settings = collect();
        }
    }

    public static function get(?string $key = null, mixed $default = null): mixed
    {
        self::fetch();

        if (!$key) {
            return self::$settings;
        }

        $value = self::$settings->where('key', $key)->first();

        if (! $value) {
            self::fetch(false);
            $value = self::$settings->where('key', $key)->first();
        }

        return $value['value'] ?? $default;
    }
}
