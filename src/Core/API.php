<?php

namespace Ls\ClientAssistant\Core;

use Ls\ClientAssistant\Utilities\Config;

class API
{
    public static function guzzle()
    {
        return new \GuzzleHttp\Client();
    }

    public static function uri(string $uri): string
    {
        return Config::get('endpoints.base') . $uri;
    }
}