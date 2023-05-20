<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class IP
{
    public static function get(): string
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $tmp = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ipAddress = array_pop($tmp);
        }
        return trim($ipAddress);
    }

    public static function info($ip = null)
    {
        $ip = $ip ?? self::get();
        $json = file_get_contents("http://ip-api.ir/info/{$ip}");
        return Validation::isValidJson($json) ? json_decode($json) : null;
    }
}