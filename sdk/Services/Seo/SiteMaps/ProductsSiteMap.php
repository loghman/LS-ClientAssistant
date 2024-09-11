<?php

namespace Ls\ClientAssistant\Services\Seo\SiteMaps;

class ProductsSiteMap extends SiteMap
{
    public function tags(): string
    {
        $tags = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . PHP_EOL;
        $tags .= $this->items();
        $tags .= '</urlset>';
        return $tags;
    }

    public function items(): string
    {
        $items = '';
        foreach ($this->data as $item) {
            $item['changefreq'] = $item['changefreq'] ?? 'hourly';
            $item['priority'] = $item['priority'] ?? '0.8';
            $item['caption'] = strip_tags(html_entity_decode($item['description'], ENT_COMPAT, 'UTF-8'));
            $item['loc'] = site_url('course/' . $item['slug']);
            $item['lastmod'] = date('Y-m-d\TH:i:s+03:30', strtotime($item['updated_at']));

            $item['caption'] = sub_words($item['caption'], 165);

            $items .= '<url>' . PHP_EOL;
            $items .= "<loc>{$item['loc']}</loc>" . PHP_EOL;
            $items .= "<changefreq>{$item['changefreq']}</changefreq>" . PHP_EOL;
            $items .= "<priority>{$item['priority']}</priority>" . PHP_EOL;
            $items .= "<lastmod>{$item['lastmod']}</lastmod>" . PHP_EOL;

            if (!empty($item['banner'])) {
                $bannerUrl = get_media_url($item['banner']);
//            if (!empty($item['banner_url'])) {
                $items .= "<image:image>" . PHP_EOL;
                $items .= "<image:loc>$bannerUrl</image:loc>" . PHP_EOL;
//                $items .= "<image:loc>{$item['banner_url']}</image:loc>" . PHP_EOL;
                if (!empty($item['caption']))
                    $items .= "<image:caption>{$item['caption']}</image:caption>" . PHP_EOL;
                $items .= "<image:title>{$item['title']}</image:title>" . PHP_EOL;
                $items .= "</image:image>" . PHP_EOL;
            }

            $items .= '</url>' . PHP_EOL;
        }
        return $items;
    }
}