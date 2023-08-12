<?php

namespace Ls\ClientAssistant\Services\Seo\SiteMaps;

class StaticSiteMap extends SiteMap
{
    public function tags(): string
    {
        $tags = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        $tags .= $this->items();
        $tags .= '</urlset>';
        return $tags;
    }

    public function items(): string
    {
        $items = '';
        foreach ($this->data as $item) {
            $item['changefreq'] = $item['changefreq'] ?? 'weekly';
            $item['priority'] = $item['priority'] ?? '1';
            $items .= '<url>' . PHP_EOL;
            $items .= "<loc>{$item['loc']}</loc>" . PHP_EOL;
            $items .= "<changefreq>{$item['changefreq']}</changefreq>" . PHP_EOL;
            $items .= "<priority>{$item['priority']}</priority>" . PHP_EOL;
            $items .= "<lastmod>{$item['lastmod']}</lastmod>" . PHP_EOL;
            $items .= '</url>' . PHP_EOL;
        }
        return $items;
    }
}