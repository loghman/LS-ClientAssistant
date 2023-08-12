<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Price
{
    public static function toPersianPrice($price, $noSpan = 0, $round = 0, $postfix = null): string
    {
        return to_persian_price($price, $noSpan, $round, $postfix);
    }
}