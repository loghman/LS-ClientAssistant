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

    public static function toPersian($str): string
    {
        $fa_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $en_num = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($en_num, $fa_num, (string)$str);
    }

}