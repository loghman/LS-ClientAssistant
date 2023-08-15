<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\Kernel;
use Ls\ClientAssistant\Core\StaticCache;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class WebResponse
{
    private $blade;

    public function __construct()
    {
        $this->blade = $this->getBladeInstance();
    }

    public function sitemap(string $sitemap, array $data)
    {
        sitemap($sitemap, $data);
    }

    public static function view($view = null, $data = [])
    {
        $content = self::make($view, $data);
        echo $content;
        StaticCache::end();
        exit();
    }

    public static function redirect(string $toRoute = ''): RedirectResponse
    {
        return new RedirectResponse(site_url($toRoute), 302, []);
    }

    public function getBladeInstance()
    {
        $viewsPath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'views';
        $cachePath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'cache';
        return (new Kernel())->registerBlade($viewsPath, $cachePath);
    }

    private static function make($view, $data, int $status = 200, array $headers = [])
    {
        $response = new static();

        return $response->blade->make($view, $data)->render();
    }
}