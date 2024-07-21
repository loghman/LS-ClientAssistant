<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use Ls\ClientAssistant\Core\Cache;

class Cacher
{
    private static string $originalClass;

    public static function cacheActive(): self
    {
        self::$originalClass = static::class;

        return new self();
    }

    public function __call($name, $arguments)
    {
        if (! method_exists(self::$originalClass, $name)) {
            throw new \Exception("Static method $name does not exist.");
        }

        $cacheKey = make_cache_unique_key($GLOBALS['appName'], self::$originalClass, $name, $arguments);

        $redisClient = Cache::getRedisInstance();

        if ($redisClient->exists($cacheKey)) {
            return collect(json_decode($redisClient->get($cacheKey), true));
        }

        $response = call_user_func_array([self::$originalClass, $name], $arguments);
        if (! $response->get('success')) {
            return $response;
        }
        $expire = (int) setting('client_cache_revalidation_time') * 60;
        $redisClient->set($cacheKey, json_encode($response->toArray()));
        $redisClient->expire($cacheKey, $expire);
        $redisClient->disconnect();

        return $response;
    }
}