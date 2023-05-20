<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class URL
{
    public static function getReferer(): ?string
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public static function redirectJs($url = '', $delay_ms = 500): string
    {
        return "<script>
        setTimeout(function() {
            location.href = '$url'
        }, $delay_ms);
        </script>";
    }
}