<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\Kernel;
use Ls\ClientAssistant\Core\StaticCache;

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
        $response = new static();

        echo $response->blade->make($view, $data)->render();
        exit;
    }

    public function viewEndStaticCache($view = null, $data = [])
    {
        $response = new static();

        echo $response->blade->make($view, $data)->render();

        StaticCache::end();

        exit;
    }

    public function redirect(string $toRoute = '')
    {
        redirect(site_url($toRoute));

        exit();
    }

    public function getBladeInstance()
    {
        $viewsPath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'views';
        $cachePath = dirname(__DIR__, 6) . DIRECTORY_SEPARATOR . 'cache';
        return (new Kernel())->registerBlade($viewsPath, $cachePath);
    }
}