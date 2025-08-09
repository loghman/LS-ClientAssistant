<?php

namespace Ls\ClientAssistant\Utilities\Tools;


class Sitemap {
    public static function cache(string $name)
    {
        $cache_dir = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'cache'. DIRECTORY_SEPARATOR . 'sitemap';
        $cache_file = $cache_dir . DIRECTORY_SEPARATOR . $name . '.xml';
        if (!is_dir($cache_dir)) {
            mkdir($cache_dir, 0755, true);
        }
        
        $cache_hours = (int) env('SITEMAP_CACHE_HOUR', 6);
        $cache_time = $cache_hours * 60 * 60;
        if (!file_exists($cache_file) or (time() - filemtime($cache_file)) > $cache_time) {
            return false;
        }
        $sitemap_data = file_get_contents($cache_file);
        header('Content-Type: application/xml', true);
        echo $sitemap_data;
        exit();
    }
}