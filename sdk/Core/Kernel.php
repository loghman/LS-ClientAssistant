<?php

namespace Ls\ClientAssistant\Core;

use Illuminate\View\Engines\EngineResolver;
use Ls\ClientAssistant\Core\Router\App;
use Ls\ClientAssistant\Core\Router\RequestResponseArgs;
use \Ls\ClientAssistant\Core\Router\RouterAppFactoryAdapter;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Illuminate\Events\Dispatcher;

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
        $router = RouterAppFactoryAdapter::createWithApiKey($_ENV);

        $router->addErrorMiddleware(true, true, true);
        $routeCollector = $router->getRouteCollector();
        $routeCollector->setDefaultInvocationStrategy(new RequestResponseArgs());

        $routeParser = $routeCollector->getRouteParser();

        toggle_errors($_ENV['APP_DEBUG'] ?? false);
        date_default_timezone_set($_ENV['TIME_ZONE'] ?? 'Asia/Tehran');

        $routeFiles = glob($routesPath);
        $routeFiles = array_merge($routeFiles, client_assistant_routes());

        foreach ($routeFiles as $route) {
            include_once $route;
        }

        $router->map(['GET', 'POST', 'PUT', 'PATCH', 'DELETE'], '/{routes:.+}', function ($request, $response) {
            return $response->view('errors.404');
        });

        return new App($router, $routeParser);
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
}