<?php

namespace Ls\ClientAssistant\Services;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Tools\Sitemap;

class SitemapService
{
    private const DEFAULT_POSTS_PER_PAGE = 50;
    
    private const POST_TYPES = ['post', 'qa', 'video', 'podcast', 'terminology'];
    
    private const POST_COLUMNS = [
        'title',
        'slug', 
        'thumbnail',
        'content',
        'updated_at',
        'published_at',
        'meta'
    ];

    /**
     * Generate posts sitemap for specific page
     */
    public function generatePostsSitemap(int $page = 1): void
    {
        $this->clearOutputBuffer();
        
        $cacheName = "posts-page{$page}";
        Sitemap::cache($cacheName);
        
        $posts = $this->fetchPosts($page);
        
        WebResponse::sitemap('posts', $posts, $cacheName);
    }

    /**
     * Generate default posts sitemap (first page)
     */
    public function generateDefaultPostsSitemap(): void
    {
        $this->generatePostsSitemap(1);
    }

    /**
     * Generate paginated sitemap URLs for posts
     */
    public function generatePaginatedPostsSitemapUrls(): array
    {
        $totalPosts = $this->getTotalPostsCount();
        $totalPages = ceil($totalPosts / self::DEFAULT_POSTS_PER_PAGE);
        
        $urls = [];
        for ($page = 1; $page <= $totalPages; $page++) {
            $urls[] = [
                'loc' => site_url("sitemap-posts-page{$page}.xml"),
                'lastmod' => date('Y-m-d\TH:i:sP')
            ];
        }
        
        return $urls;
    }

    /**
     * Get total count of published posts
     */
    private function getTotalPostsCount(): int
    {
        $response = CMS::queryParams(
            [
                'filters' => [
                    'type' => self::POST_TYPES,
                    'status' => 'published',
                ],
                'page' => 1
            ],
            [],
            [],
            1
        );

        return $response['data']['total'] ?? 0;
    }

    /**
     * Fetch posts data for sitemap
     */
    private function fetchPosts(int $page): array
    {
        $response = CMS::queryParams(
            [
                'filters' => [
                    'type' => self::POST_TYPES,
                    'status' => 'published',
                    'order-by' => 'published_at',
                    'dir' => 'desc',
                ],
                'page' => $page
            ],
            [
                [
                    [
                        'columns' => self::POST_COLUMNS
                    ]
                ]
            ],
            [],
            self::DEFAULT_POSTS_PER_PAGE
        );
        
        return $response['data']['data'] ?? [];
    }

    /**
     * Clear output buffer to prevent debug interference
     */
    private function clearOutputBuffer(): void
    {
        if (ob_get_level()) {
            ob_clean();
        }
    }
} 