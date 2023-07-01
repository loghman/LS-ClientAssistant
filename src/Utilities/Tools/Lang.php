<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Lang
{
    public static function persianNumbers($input)
    {
        return to_persian_num($input);
    }

    public static function latinNumbers($input)
    {
        return to_english_num($input);
    }
}