<?php

namespace Ls\ClientAssistant\Core;

use Predis\Client as RedisClient;

class Cache
{
    private static $redisInstance;

    public static function getRedisInstance()
    {
        if (!is_null(self::$redisInstance)) {
            return self::$redisInstance;
        }

        $redisHost = $GLOBALS['redisHost'] ?? '127.0.0.1';
        $redisPort = $GLOBALS['redisPort'] ?? 6379;

        $redisClient = new RedisClient([
            'scheme' => 'tcp',
            'host' => $redisHost,
            'port' => $redisPort,
        ]);

        self::$redisInstance = $redisClient;

        return $redisClient;
    }
}