<?php

namespace Ls\ClientAssistant\Core\Router;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\MiddlewareDispatcherInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteResolverInterface;

class RouterAppFactoryAdapter extends AppFactory
{
    public static function createWithApiKey(array $env, ?ResponseFactoryInterface $responseFactory = null, ?ContainerInterface $container = null, ?CallableResolverInterface $callableResolver = null, ?RouteCollectorInterface $routeCollector = null, ?RouteResolverInterface $routeResolver = null, ?MiddlewareDispatcherInterface $middlewareDispatcher = null): App
    {
        $GLOBALS['appName'] = $env['APP_NAME'] ?? '7learn';
        $GLOBALS['apikey'] = $env['LS_API_KEY'];
        $GLOBALS['storageUrl'] = $env['STORAGE_URL'] ?? '';
        $GLOBALS['coreUrl'] = $env['CORE_URL'];
        $GLOBALS['appUrl'] = str_ends_with($env['APP_URL'], '/') ? $env['APP_URL'] : $env['APP_URL'] . '/';
        $GLOBALS['redisHost'] = $env['REDIS_HOST'] ?? '127.0.0.1';
        $GLOBALS['redisPort'] = $env['REDIS_PORT'] ?? 6379;

        return parent::create($responseFactory, $container, $callableResolver, $routeCollector, $routeResolver, $middlewareDispatcher);
    }
}