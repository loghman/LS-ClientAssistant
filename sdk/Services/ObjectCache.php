<?php

namespace Ls\ClientAssistant\Services;

class ObjectCache
{
    private static $cacheFolder = '../cache/static/';
    private static $validtime = 3600;
    
    public static function exists($key){
        $filepath = self::$cacheFolder . md5($key) . '.oCache';
        return file_exists($filepath) && (time() - filemtime($filepath) < self::$validtime);
    }

    public static function get($key){
        $filepath = self::$cacheFolder . md5($key) . '.oCache';
        if(self::exists($key))
            return unserialize(file_get_contents($filepath));
        return false;
    }

    public static function write($key,$object){
        if(!is_dir(self::$cacheFolder)){
            mkdir(self::$cacheFolder);
        }
        $filepath = self::$cacheFolder . md5($key) . '.oCache';
        file_put_contents($filepath,serialize($object));
        return $object;
    }

    public static function flush()
    {
        $cacheFolder = self::$cacheFolder;
        $files = glob($cacheFolder . "*");
        foreach ($files as $file) {         
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

}
