<?php

namespace Ls\ClientAssistant\Core;

use Illuminate\Routing\UrlGenerator;
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

class Kernel
{
    private Container $container;

    public function boot(string $envPath, string $routesPath)
    {
        $this->bootEnv($envPath);

        ErrorHandler::register();

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
        $this->container = Container::getInstance();

        $this->container->singleton(Request::class, function () {
            return Request::capture();
        });
        $request = $this->container->make(Request::class);

        $this->container->singleton('router', function () {
            return new Router(new Dispatcher($this->container), $this->container);
        });
        $router = $this->container->make('router');
        $this->registerUrlGenerator();

        $routeFiles = glob($routesPath);
        $routeFiles = array_merge($routeFiles, client_assistant_routes());
        foreach ($routeFiles as $route) {
            include_once $route;
        }

        $router->fallback(fn() => abort(404, 'صفحه مورد نظر یافت نشد!'));
        $staticCacheMiddleware = new StaticCacheMiddleware();
        $response = $staticCacheMiddleware->handle($request, function ($request) use ($router) {
            return $router->dispatch($request);
        });

        return new App($router, $response);
    }

    public function registerBlade(string $viewsPath, string $cachePath): Factory
    {
        $filesystem = new Filesystem;

        $globalViews = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'views';
        $viewPaths = [$viewsPath, $globalViews]; // Add more paths if needed
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

    protected function registerUrlGenerator()
    {
        $this->container->singleton('url', function ($app) {
            $routes = $this->container->make('router')->getRoutes();

            // The URL generator needs the route collection that exists on the router.
            // Keep in mind this is an object, so we're passing by references here
            // and all the registered routes will be available to the generator.
            $this->container->instance('routes', $routes);

            return new UrlGenerator(
                $routes,
                $this->container->make(Request::class),
                site_url()
            );
        });
    }
}