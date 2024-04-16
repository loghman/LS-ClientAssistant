<?php

namespace Ls\ClientAssistant\Services\Seo\SiteMaps;

class IndexSiteMap extends SiteMap
{
    public function tags(): string
    {
        $tags = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
        $tags .= $this->items();
        $tags .= '</sitemapindex>';
        echo $tags;
        die;
    }

    public function items(): string
    {
        $items = '';
        foreach ($this->data as $item) {
            $items .= '<sitemap>' . PHP_EOL;
            $items .= "<loc>{$item['loc']}</loc>" . PHP_EOL;
            $items .= "<lastmod>{$item['lastmod']}</lastmod>" . PHP_EOL;
            $items .= '</sitemap>' . PHP_EOL;
        }
        return $items;
    }
}