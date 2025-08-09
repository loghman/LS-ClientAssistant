<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\SitemapService;
use Ls\ClientAssistant\Utilities\Modules\V3\Hook;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Tools\Sitemap;

class SiteMapController
{

    public function __construct(private SitemapService $sitemapService)
    {
    }
    public function sitemap()
    {
        Sitemap::cache('index');
        $siteMaps = [
            [
                'loc' => site_url('sitemap-static.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ],
            [
                'loc' => site_url('sitemap-pages.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ],
            [
                'loc' => site_url('sitemap-lms-products.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ],
            [
                'loc' => site_url('sitemap-hooks.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ],
        ];
        
        $paginatedPostsUrls = $this->sitemapService->generatePaginatedPostsSitemapUrls();
        $siteMaps = array_merge($siteMaps, $paginatedPostsUrls);
        
        WebResponse::sitemap('index', $siteMaps);
    }

    public function staticSiteMap()
    {
        Sitemap::cache('static');
        $statics = config('sitemaps.statics') ?? [];
        WebResponse::sitemap('static', $statics);
    }
    public function postsSiteMap()
    {
        $this->sitemapService->generateDefaultPostsSitemap();
    }

    public function postsSiteMapPaginated(int $page = 1)
    {
        $this->sitemapService->generatePostsSitemap($page);
    }

    public function pagesSiteMap()
    {
        Sitemap::cache('pages');
        $filters = [
            'type' => ['page'],
            'status' => 'published',
            'order-by' => 'published_at',
            'dir' => 'desc',
        ];

        $posts = CMS::queryParams(['filters' => $filters], [
            [
                [
                    'columns' => [
                        'title',
                        'slug',
                        'thumbnail',
                        'content',
                        'updated_at',
                        'published_at',
                        'meta'
                    ]
                ]
            ]
        ], [], 1000)['data']['data'];

        WebResponse::sitemap('posts', $posts, 'pages');
    }

    public function lmsProductsSiteMap()
    {
        Sitemap::cache('products');
        $products = LMSProduct::list([], [], 1000)['data']['data'];
        WebResponse::sitemap('products', $products);
    }

    public function siteMapHooks()
    {
        Sitemap::cache('hooks');
        $hooks = Hook::list(
            ModuleFilter::new()
                ->search('status', 'published')
                ->perPage(50000)
                ->orderBy('created_at')
                ->sortedBy('desc')
        )['data'];

        return WebResponse::sitemap('hooks', $hooks);
    }
}
