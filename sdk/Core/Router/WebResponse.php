<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\Kernel;
use Ls\ClientAssistant\Core\StaticCache;
use Ls\ClientAssistant\Services\BladeLazyLoadService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class WebResponse
{
    private $blade;

    public function __construct()
    {
        $this->blade = $this->getBladeInstance();
    }

    /**
     * @throws \Exception
     */
    public static function sitemap(string $sitemap, array $data): void
    {
        sitemap($sitemap, $data);
    }

    public static function view($view = null, $data = [])
    {
        $content = self::make($view, $data);
        $content = BladeLazyLoadService::filterContent($content);

        echo $content;
        StaticCache::end();
        exit();
    }

    public static function viewExist($view)
    {
        return (new self())->getBladeInstance()->exists($view);
    }

    public static function redirect(string $toRoute = ''): RedirectResponse
    {
        return new RedirectResponse(site_url($toRoute), 302, []);
    }

    public static function redirectToFullUrl(string $fullUrl): RedirectResponse
    {
        return new RedirectResponse($fullUrl, 302, []);
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