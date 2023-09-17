<?php

namespace Ls\ClientAssistant\Services;

class BladeLazyLoadService
{
    public static function filterContent($content): string
    {
        # remove empty lines
        $content = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content));
        # special replacements
        $from = ['<img ', '<iframe ', 'خروجی:', 'خروجی :', 'src="https://www.aparat'];
        $to = ['<img loading="lazy" ', '<iframe loading="lazy" ', '', '', 'async src="https://www.aparat'];
        # grammer fix replacements
        $from = array_merge($from, [' نمی ', ' می ', ' ها ', ' های ', ' تر ', ' تری ', ' ترین ']);
        $to = array_merge($to, [' نمی‌', ' می‌', '‌ها ', '‌های ', '‌تر ', '‌تری ', '‌ترین ']);

        return str_replace($from, $to, $content);
    }
}