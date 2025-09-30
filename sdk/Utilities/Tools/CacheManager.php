<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CacheManager
{
    /**
     * Clear directory cache recursively
     *
     * @param string $cachePath The cache directory path
     * @return bool Returns true if directory was cleared successfully, false otherwise
     */
    public static function clearDirectoryCache(string $cachePath): bool
    {
        if (!is_dir($cachePath)) {
            return false;
        }

        try {
            $iterator = new RecursiveDirectoryIterator($cachePath, FilesystemIterator::SKIP_DOTS);
            $recursiveIterator = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
            
            foreach ($recursiveIterator as $file) {
                if ($file->isDir()) {
                    @rmdir($file->getRealPath());
                } else {
                    @unlink($file->getRealPath());
                }
            }
            
            @rmdir($cachePath);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the default cache path (4 levels up from vendor directory)
     *
     * @return string
     */
    public static function getDefaultCachePath(): string
    {
        return dirname(__DIR__, 6) . '/cache';
    }

    /**
     * Clear the default application cache directory
     *
     * @return bool
     */
    public static function clearDefaultCache(): bool
    {
        return self::clearDirectoryCache(self::getDefaultCachePath());
    }
}
