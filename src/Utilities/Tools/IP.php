<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class IP
{
    public static function get(): string
    {
        return get_ip();
    }

    public static function info($ip = null)
    {
        return geoip_infos($ip);
    }
}