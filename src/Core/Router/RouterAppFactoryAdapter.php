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
        $GLOBALS['apikey'] = $env['CLIENT_KEY'];
        $GLOBALS['storageUrl'] = $env['STORAGE_URL'] ?? '';
        $GLOBALS['coreUrl'] = $env['CORE_URL'];
        $GLOBALS['appUrl'] = str_ends_with($env['APP_URL'], '/') ? $env['APP_URL'] : $env['APP_URL'] . '/';

        return parent::create($responseFactory, $container, $callableResolver, $routeCollector, $routeResolver, $middlewareDispatcher);
    }
}