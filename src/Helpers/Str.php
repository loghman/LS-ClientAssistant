<?php

namespace Ls\ClientAssistant\Helpers;

class Str
{

    public static function contains($str, $needle, $case_sensitive = 0): bool
    {
        if ($case_sensitive) {
            $pos = strpos($str, strval($needle));
        } else {
            $pos = stripos($str, strval($needle));
        }
        return $pos !== false;
    }
}