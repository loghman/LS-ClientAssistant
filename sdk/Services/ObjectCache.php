<?php

namespace Ls\ClientAssistant\Services;

class ObjectCache
{
    private static $base = '../cache/static/';
    private static $validtime = 7200;
    
    public static function exists($key){
        $filepath = self::$base . md5($key) . '.oCache';
        return file_exists($filepath) && (time() - filemtime($filepath) < self::$validtime);
    }

    public static function get($key){
        $filepath = self::$base . md5($key) . '.oCache';
        if(self::exists($filepath))
            return unserialize(file_get_contents($filepath));
        return false;
    }

    public static function write($key,$object){
        $filepath = self::$base . md5($key) . '.oCache';
        file_put_contents($filepath,serialize($object));
        return $object;
    }

    public static function flush()
    {
        $cacheFolder = self::$base;
        $files = glob($cacheFolder . "*");
        foreach ($files as $file) {         
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

}