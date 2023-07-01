<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

class DateTime
{
    public static function toPersianDate($enDate, $format = '%d %B %Y، H:i'): string
    {
        return to_persian_date($enDate, $format);
    }

    public static function convertSecondsToPersianTime($seconds): string
    {
        return convert_seconds_to_persian_time($seconds);
    }

    public static function convertSecondsToPersianInLineTime($seconds): string
    {
        return convert_seconds_to_persian_in_line_time($seconds);
    }

    private static function toPersian($date, $format = '%d %B %Y، H:i'): string
    {
        return Lang::persianNumbers(Verta::instance($date)->format($format));
    }
}