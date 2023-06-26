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

    public static function convertSecondsToPersianTime($seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $remainingSeconds = $seconds % 60;

        if ($hours > 0) {
            $time = \Carbon\Carbon::createFromTime($hours, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('HH:mm:ss');
        } else {
            $time = \Carbon\Carbon::createFromTime(0, $minutes, $remainingSeconds, 'Asia/Tehran')->isoFormat('mm:ss');
        }

        return Lang::persianNumbers($time);
    }

    public static function convertSecondsToPersianInLineTime($seconds): string
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        if ($hours == 1 and $minutes == 0) {
            return sprintf("%s %s", '۱', 'ساعت');
        }

        if ($hours < 1) {
            return sprintf("%s ساعت و %s دقیقه", Lang::persianNumbers($minutes), $minutes);
        }

        return sprintf("%s ساعت و %s دقیقه", Lang::persianNumbers($hours), Lang::persianNumbers($minutes));
    }

    private static function toPersian($date, $format = '%d %B %Y، H:i'): string
    {
        return Lang::persianNumbers(Verta::instance($date)->format($format));
    }
}