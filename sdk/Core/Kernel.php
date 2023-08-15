<?php

namespace Ls\ClientAssistant\Core;

use Illuminate\View\Engines\EngineResolver;
use Ls\ClientAssistant\Core\Middlewares\StaticCacheMiddleware;
use Ls\ClientAssistant\Core\Router\App;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Ls\ClientAssistant\Core\Router\WebResponse;

class Kernel
{
    public function boot(string $envPath, string $routesPath)
    {
        $this->bootEnv($envPath);
        return $this->bootRouter($routesPath);
    }

    private function bootEnv(string $envPath): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable($envPath);
        $dotenv->safeLoad();
    }

    private function bootRouter(string $routesPath): App
    {
        $this->setGlobalVariablesFromEnv($_ENV);
        $request = Request::capture();
        $container = new Container();
        $events = new Dispatcher($container);
        $router = new Router($events, $container);

        $container->bind(Request::class, function ($app) {
            return Request::capture();
        });

        $routeFiles = glob($routesPath);
        $routeFiles = array_merge($routeFiles, client_assistant_routes());

        foreach ($routeFiles as $route) {
            include_once $route;
        }

        $router->fallback(function () {
            WebResponse::view('errors.404');
        });

        $staticCacheMiddleware = new StaticCacheMiddleware();

        $response = $staticCacheMiddleware->handle(Request::capture(), function ($request) use ($router) {
            return $router->dispatch($request);
        });

        return new App($router, $response);
    }

    public function registerBlade(string $viewsPath, string $cachePath): Factory
    {
        $filesystem = new Filesystem;

        $viewPaths = [$viewsPath]; // Add more paths if needed
        $viewFinder = new FileViewFinder($filesystem, $viewPaths);

        $bladeCompiler = new BladeCompiler($filesystem, ($cachePath . DIRECTORY_SEPARATOR . 'static'));

        $engineResolver = new EngineResolver;
        $engineResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $dispatcher = new Dispatcher;
        return new Factory($engineResolver, $viewFinder, $dispatcher);
    }

    private function setGlobalVariablesFromEnv($env)
    {
        $GLOBALS['apikey'] = $env['CLIENT_KEY'];
        $GLOBALS['appName'] = $env['APP_NAME'];
        $GLOBALS['storageUrl'] = $env['STORAGE_URL'] ?? '';
        $GLOBALS['coreUrl'] = $env['CORE_URL'];
        $GLOBALS['appUrl'] = str_ends_with($env['APP_URL'], '/') ? $env['APP_URL'] : $env['APP_URL'] . '/';
        $GLOBALS['redisHost'] = $env['REDIS_HOST'];
        $GLOBALS['redisPort'] = $env['REDIS_PORT'];
    }
}