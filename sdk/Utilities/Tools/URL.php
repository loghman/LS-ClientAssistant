<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class URL
{
    public static function getReferer(): ?string
    {
        return get_referer();
    }

    public static function redirectJs($url = '', $delay_ms = 500): string
    {
        return js_redirect_script($url, $delay_ms);
    }
}