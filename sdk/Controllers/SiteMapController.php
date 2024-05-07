<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\Hook;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;

class SiteMapController
{
    public function sitemap()
    {
        $siteMaps = [
            [
                'loc' => site_url('sitemap-static.xml'),
                'lastmod' => '2024-05-07T19:12:26+03:30'
            ],
            [
                'loc' => site_url('sitemap-posts.xml'),
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
        WebResponse::sitemap('index', $siteMaps);
    }

    public function staticSiteMap()
    {
        $statics = config('sitemaps.statics') ?? [];
        WebResponse::sitemap('static', $statics);
    }
    public function postsSiteMap()
    {
        sitemap_cache('posts');
        $filters = [
            'type' => ['post', 'qa', 'video', 'podcast', 'terminology'],
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

        WebResponse::sitemap('posts', $posts);
    }

    public function pagesSiteMap()
    {
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

        WebResponse::sitemap('posts', $posts);
    }

    public function lmsProductsSiteMap()
    {
        sitemap_cache('products');
        $products = LMSProduct::list([], [], 1000)['data']['data'];
        WebResponse::sitemap('products', $products);
    }

    public function siteMapHooks()
    {
        sitemap_cache('hooks');
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
