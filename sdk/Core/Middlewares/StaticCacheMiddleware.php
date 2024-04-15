<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\StaticCache;

class StaticCacheMiddleware
{
    public function handle(Request $request, $next)
    {
        if (!empty(current_user())) {
            return $next($request);
        }

        $urlRegex = self::urlRegexPattern();
        foreach ($urlRegex as $regex => $isActive) {
            if ($isActive and preg_match($regex, $request->getRequestUri(), $matches)) {
                StaticCache::start();

                return $next($request);
            }
        }

        $urls = self::usualUrls();
        if (in_array($request->getUri(), array_keys($urls))) {
            if (($urls[$request->getUri()] ?? false)) {
                StaticCache::start();

                return $next($request);
            }
        }

        return $next($request);
    }

    public static function usualUrls(): array
    {
        return [
            site_url('') => setting('client_static_cache_index_page'),
            site_url('blog') => setting('client_static_cache_blog_page'),
            site_url('articles') => setting('client_static_cache_blog_page'),
            site_url('news') => setting('client_static_cache_blog_page'),
            site_url('podcasts') => setting('client_static_cache_blog_page'),
            site_url('community') => setting('client_static_cache_list_communities'),
            site_url('courses') => setting('client_static_cache_list_courses'),
            site_url('shop') => setting('client_static_cache_list_shop_products'),
        ];
    }

    public static function urlRegexPattern(): array
    {
        return [
            '#^\/blog\/([a-zA-Z0-9\-]+)$#' => setting('client_static_cache_single_blog')=="1",
            '#^\/news/([a-zA-Z0-9\-]+)$#' => setting('client_static_cache_single_blog')=="1",
            '#^\/podcasts\/([a-zA-Z0-9\-]+)$#' => setting('client_static_cache_single_blog')=="1",
            '#^\/articles\/([a-zA-Z0-9\-]+)$#' => setting('client_static_cache_single_blog')=="1",
            '#^\/community\/([\w-]+)(/[\w-]+)*$#' => setting('client_static_cache_list_topics')=="1",
            '#^\/community(/[\w\-/]+)?$#' => setting('client_static_cache_single_topic')=="1",
            '#^\/product\/[\w-]+$#' => setting('client_static_cache_single_product')=="1",
            '#^\/course\/[\w-]+$#' => setting('client_static_cache_single_course')=="1",
            '#^\/course\/[\w-]+\/m$#' => setting('client_static_cache_minimal_landing')=="1",
        ];
    }
}