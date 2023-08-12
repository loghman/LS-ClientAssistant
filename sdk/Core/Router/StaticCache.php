<?php

namespace Ls\ClientAssistant\Core\Router;

class StaticCache
{
    protected static $cacheFolder;
    protected static $cacheSlug;
    protected static $cacheFile;
    protected static $cachable = 1;
    const EXPIRE_TIME = 3600;   // 1 hour


    public static function isCacheEnable(): bool
    {
//        if (!is_production() or env('STATIC_CACHE')==0 or is_user_logged_in() or sizeof($_GET))
//            return false;
        return true;
    }

    public static function init()
    {
        self::$cacheFolder = dirname((__DIR__), 2) . '/cache/';
        self::$cacheSlug = strtok($_SERVER['REQUEST_URI'], '?');
        self::$cacheFile = self::$cacheFolder . md5(self::$cacheSlug) . ".php";
        if (!self::isCacheEnable())
            self::$cachable = 0;
    }

    public static function start()
    {
        if (!is_null(current_user())) {
            return;
        }
        self::init();

        if (!self::$cachable) {
            return;
        }

        if (file_exists(self::$cacheFile) && (time() - self::EXPIRE_TIME) < filemtime(self::$cacheFile)) {
            readfile(self::$cacheFile);
            exit;
        }
        ob_start();
    }

    public static function end()
    {
        if (!is_null(current_user())) {
            return;
        }

        if (!self::$cachable) {
            return;
        }
        # Cache the contents to a cache file
        $cachedfile = fopen(self::$cacheFile, 'w');
        fwrite($cachedfile, "<!-- cached:" . date('Y-m-d H:i:s', filemtime(self::$cacheFile)) . " -->\n");
        fwrite($cachedfile, ob_get_contents());
        fclose($cachedfile);
        # Send the output to the browser
        ob_end_flush();
    }

    public static function flush()
    {
        $cacheFolder = dirname((__DIR__), 2) . '/cache/';
        $files = glob($cacheFolder . "*"); // get all file names
        foreach ($files as $file) {         // iterate files
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
