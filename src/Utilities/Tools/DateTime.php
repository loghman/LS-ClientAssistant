<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;

class DateTime
{
    public static function toPersianDate($enDate, $format = '%d %B %Y، H:i'): string
    {
        if ($enDate instanceof Carbon) {
            $enDate = $enDate->toDateTimeString();
        }

        return Lang::persianNumbers(self::toPersian($enDate, $format));
    }

    private static function toPersian($date, $format = '%d %B %Y، H:i'): string
    {
        return Lang::persianNumbers(Verta::instance($date)->format($format));
    }
}