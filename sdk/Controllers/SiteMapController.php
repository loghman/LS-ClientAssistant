<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\Hook;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Tools\Sitemap;

class SiteMapController
{
    public function sitemap()
    {
        Sitemap::cache('index');
        
        // Get total pages for posts sitemap
        $totalPages = $this->getPostsTotalPages();
        
        $siteMaps = [
            [
                'loc' => site_url('sitemap-static.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ]
        ];
        
        // Add paginated posts sitemaps
        for ($page = 1; $page <= $totalPages; $page++) {
            $siteMaps[] = [
                'loc' => site_url("sitemap-posts-page{$page}.xml"),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ];
        }
        
        $siteMaps = array_merge($siteMaps, [
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
        ]);
        
        WebResponse::sitemap('index', $siteMaps);
    }

    private function getPostsTotalPages(): int
    {
        $filters = [
            'type' => ['post', 'qa', 'video', 'podcast', 'terminology'],
            'status' => 'published',
        ];

        // Get first page to get total count from pagination meta
        $response = CMS::queryParams([
            'filters' => $filters,
            'page' => 1
        ], [], [], 1);

        $total = $response['data']['total'] ?? 0;
        return (int) ceil($total / 100); // 100 posts per page
    }

    public function staticSiteMap()
    {
        Sitemap::cache('static');
        $statics = config('sitemaps.statics') ?? [];
        WebResponse::sitemap('static', $statics);
    }
    public function postsSiteMap()
    {

        return $this->postsSiteMapPaginated(1);
    }

    public function postsSiteMapPaginated(int $page = 1)
    {
        Sitemap::cache("posts-page{$page}");
        $filters = [
            'type' => ['post', 'qa', 'video', 'podcast', 'terminology'],
            'status' => 'published',
            'order-by' => 'published_at',
            'dir' => 'desc',
        ];

        $posts = CMS::queryParams([
            'filters' => $filters,
            'page' => $page
        ], [
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
        ], [], 100)['data']['data'];

        WebResponse::sitemap('posts', $posts, "posts-page{$page}");
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
