<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Lang
{
    public static function persianNumbers($input)
    {
        $faNum = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $enNum = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($enNum, $faNum, (string)$input);
    }

    public static function latinNumbers($input)
    {
        $faNum = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $enNum = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        return str_replace($faNum, $enNum, (string)$input);
    }
}