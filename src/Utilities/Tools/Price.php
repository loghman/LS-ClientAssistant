<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Price
{
    public static function toPersianPrice($price, $noSpan = 0, $round = 0, $postfix = null): string
    {
        $currencyStr = is_null($postfix) ? "تومان" : "تومان$postfix";
        if ($round === 'hezar' || $round === 'thousand') {
            $price = round($price / 1000) * 1000;
        }

        if ($round === 'million') {
            $price = round($price / 1000000) * 1000000;
        }

        if ($price < 1000) {
            $str = Lang::persianNumbers($price) . " $currencyStr";
        } else if ($price < 1000000) {
            $str = Lang::persianNumbers(round($price / 1000)) . " هزار $currencyStr";
        } else {
            $str = Lang::persianNumbers(round($price / 1000000, 3)) . " میلیون $currencyStr";
        }

        return $str;
    }
}