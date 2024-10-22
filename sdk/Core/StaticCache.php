<?php

namespace Ls\ClientAssistant\Core;

class StaticCache
{
    private static $cacheFolder = '../cache/pages/';
    protected static $cacheSlug;
    protected static $cacheFile;
    const EXPIRE_TIME = 3*3600;   // 3 hour

    public static function isCacheEnable(): bool
    {
        // dont cache the page if user logged in
        if(!empty($_COOKIE['token']??''))
            return false;

            if ($_SERVER['REQUEST_METHOD'] != 'GET') 
            return false;

        if (!self::shouldCacheUrl()) 
            return false;

        return true;
    }


    public static function init()
    {
        self::$cacheSlug = $_SERVER['REQUEST_URI'];
        self::$cacheFile = self::$cacheFolder .  md5(self::$cacheSlug) . ".html";
    }

    public static function start()
    {
        if (!self::isCacheEnable()) 
            return;
        
        self::init();
        if ( file_exists(self::$cacheFile) && (time() - self::EXPIRE_TIME) < filemtime(self::$cacheFile)) {
            $fileContent = file_get_contents(self::$cacheFile);
            if (strlen($fileContent) < 200) {
                return;
            }

            if(is_valid_json($fileContent))
                header('Content-Type: application/json; charset=utf-8');
            
            header("Pragma: no-cache");
            header("Expires: 0");  
            readfile(self::$cacheFile);
            exit;
        }

        ob_start();
    }

    public static function end()
    {
        if (!self::isCacheEnable()) 
            return;
        

        if(!self::$cacheFile)
            self::init();
        

        if(!is_dir(self::$cacheFolder))
            mkdir(self::$cacheFolder);
        

        # Cache the contents to a cache file
        $cacheContent = ob_get_contents();
        if(empty($cacheContent))
            return;
        
        $cachedfile = fopen(self::$cacheFile, 'w+');
        if(!is_valid_json($cacheContent))
            fwrite($cachedfile, "<!-- cached:" . date('Y-m-d H:i:s', filemtime(self::$cacheFile)) . " -->\n");
        fwrite($cachedfile, $cacheContent);
        fclose($cachedfile);
        # Send the output to the browser
        ob_end_flush();
    }

    public static function flush()
    {
        $files = glob(self::$cacheFolder . "*"); // get all file names
        foreach ($files as $file) {         // iterate files
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
    
    private static function shouldCacheUrl()
    {
        $currentUri = $_SERVER['REQUEST_URI'];
        $mustCacheKeywords = ['course','blog','news','cat','tag','topic','community'];
        $notCacheKeywords = ['auth','login','password','register','logout'];

        foreach ($mustCacheKeywords as $keyword)
            if(str_contains($currentUri,$keyword) )
                return true;

        foreach ($notCacheKeywords as $keyword)
            if(str_contains($currentUri,$keyword))
                return false;
            
        return true;
    }
}
