<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\StaticCache;

class StaticCacheMiddleware
{
    public function handle(Request $request, $next)
    {
        //        if (User::loggedIn()) {
        //            return $next($request);
        //        }

        $urlRegex = self::urlRegexPattern();
        foreach ($urlRegex as $regex => $isActive) {
            if ($isActive and preg_match($regex, $request->getRequestUri(), $matches)) {
                StaticCache::start();

                return $next($request);
            }
        }

        if (in_array($request->getUri(), array_keys(self::usualUrls()))) {
            StaticCache::start();
        }

        return $next($request);
    }

    public static function usualUrls(): array
    {
        return [
            site_url('') => setting('client_static_cache_index_page'),
            site_url('blog') => setting('client_static_cache_blog_page'),
            site_url('community') => setting('client_static_cache_list_communities'),
            site_url('courses') => setting('client_static_cache_list_courses'),
            site_url('shop') => setting('client_static_cache_list_shop_products'),
        ];
    }

    public static function urlRegexPattern(): array
    {
        return [
            '#^/blog/([a-zA-Z0-9\-]+)$#' => setting('client_static_cache_single_blog'),
//            setting('client_static_cache_list_topics') => '',
//            setting('client_static_cache_single_topic') => '',
//            setting('client_static_cache_single_course') => '',
//            setting('client_static_cache_single_product') => '',
        ];
    }
}