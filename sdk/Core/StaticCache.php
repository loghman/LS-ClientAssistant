<?php

namespace Ls\ClientAssistant\Core;

class StaticCache
{
    protected static $cacheFolder;
    protected static $cacheSlug;
    protected static $cacheFile;
    protected static $cachable = 1;
    const EXPIRE_TIME = 12*3600;   // 12 hour


    public static function isCacheEnable(): bool
    {
        return true;
    }

    public static function init()
    {
        self::$cacheFolder = dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'pages/';
        self::$cacheSlug = $_SERVER['REQUEST_URI'];
        self::$cacheFile = self::$cacheFolder .  md5(self::$cacheSlug) . ".html";
        if (!self::isCacheEnable())
            self::$cachable = 0;
    }

    public static function start()
    {
        self::init();
        if (!self::$cachable) {
            return;
        }

        if (file_exists(self::$cacheFile) && (time() - self::EXPIRE_TIME) < filemtime(self::$cacheFile)) {
            $fileContent = file_get_contents(self::$cacheFile);
            if (strlen($fileContent) < 200) {
                return;
            }
            readfile(self::$cacheFile);
            exit;
        }

        ob_start();
    }

    public static function end()
    {
        // dont cache the page if user logged in
        if(isset($_COOKIE['token'])){
            return;
        }

        if (!self::$cachable) {
            return;
        }

        if(!self::$cacheFile){
            self::init();
        }

        if(!is_dir(self::$cacheFolder)){
            mkdir(self::$cacheFolder);
        }

        # Cache the contents to a cache file
        $cacheContent = ob_get_contents();
        if(empty($cacheContent)){
            return;
        }

        $cachedfile = fopen(self::$cacheFile, 'w+');
        fwrite($cachedfile, "<!-- cached:" . date('Y-m-d H:i:s', filemtime(self::$cacheFile)) . " -->\n");
        fwrite($cachedfile, $cacheContent);
        fclose($cachedfile);
        # Send the output to the browser
        ob_end_flush();
    }

    public static function flush()
    {
        $cacheFolder = dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'custom/';
        $files = glob($cacheFolder . "*"); // get all file names
        foreach ($files as $file) {         // iterate files
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}
