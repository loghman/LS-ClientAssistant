<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Str;

class Validation
{
    public static function isValidEmail(string $email): bool
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function isValidMobile(string $mobile): bool
    {
        return preg_match("/(\+98|0)?9\d{9}/", $mobile) || preg_match("/(\+)?\d{10,12}/", $mobile);
    }

    public static function isValidUrl($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    public static function isValidFullName(string $fullName): bool
    {
        return Str::contains(trim($fullName), ' ') && mb_strlen($fullName) > 6;
    }

    public static function isStrongPassword($password): bool
    {
        if (is_null($password) || strlen($password) < 8) {
            return false;
        }

        $lettersCheck = preg_match('/[a-zA-Z]/', $password);
        $digitsCheck = preg_match('/\d/', $password);
        return ($lettersCheck && $digitsCheck);
    }

    public static function isValidDate($date, string $format = 'Y-m-d H:i:s'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    public static function isValidRateValue($rateValue, $max = 5): bool
    {
        $rateValue = ceil($rateValue);
        return ($rateValue > 0 && $rateValue <= $max);
    }

    public static function isValidJson($string): bool
    {
        $first_character = substr(ltrim($string), 0, 1);
        if (!in_array($first_character, ['{', '['])) {
            return false;
        }

        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}