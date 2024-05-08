<?php

namespace Ls\ClientAssistant\Utilities\Tools;


class Sitemap {
    public static function cache(string $name)
    {
        $cache_file = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'cache'. DIRECTORY_SEPARATOR . 'sitemap' . DIRECTORY_SEPARATOR . $name . '.xml';
        $cache_time = env('SITEMAP_CACHE_HOUR', 6) * 60 * 60;
        if (!file_exists($cache_file) or (time() - filemtime($cache_file)) > $cache_time) {
            return false;
        }
        $sitemap_data = file_get_contents($cache_file);
        header('Content-Type: application/xml', true);
        echo $sitemap_data;
        exit();
    }
}