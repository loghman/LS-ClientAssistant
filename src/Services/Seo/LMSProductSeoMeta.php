<?php

namespace Ls\ClientAssistant\Services\Seo;

use Ls\ClientAssistant\Services\Seo\SeoMeta;

class LMSProductSeoMeta extends SeoMeta
{
    private $product;
    private $meta;
    private $description = null;
    private $currentUrl;

    public function __construct($product)
    {
        $this->product = $product;
        $this->meta = json_decode($product['meta'] ?? '[]', true);
        $this->currentUrl = get_current_url(true);
        if (!empty($this->product['description']))
            $this->description = sub_words($this->product['description'], 165);

    }

    public function getTitle()
    {
        return "<title>{$this->product['title']}</title>" . PHP_EOL;
    }

    public function getCanonical()
    {
        return "<link rel = 'canonical' href = '$this->currentUrl' />" . PHP_EOL;
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        if (!is_null($this->description)) {
            $metaTags .= "<meta name = 'description' content = '$this->description' />" . PHP_EOL;
        }

        // dates
        $publishedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['created_at']));
        $metaTags .= "<meta property = 'article:published_time' content = '$publishedTime' />" . PHP_EOL;

        $modifiedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['updated_at']));
        $metaTags .= "<meta property = 'article:modified_time' content = '$modifiedTime' />" . PHP_EOL;

        return $metaTags;

    }

    public function getOpenGraphTags()
    {

        $openGraph = '';

        $openGraph .= "<meta property = 'og:title' content = '{$this->product['title']}' />" . PHP_EOL;
        $openGraph .= "<meta property = 'og:image:alt' content = '{$this->product['title']}' />" . PHP_EOL;
        $openGraph .= "<meta property = 'og:url' content = '$this->currentUrl' />" . PHP_EOL;
        $updatedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['updated_at']));
        $openGraph .= "<meta property = 'og:updated_time' content = '$updatedTime' />" . PHP_EOL;

        if (!empty($this->meta['banner_url']))
            $openGraph .= "<meta property = 'og:image' content = '{$this->meta['banner_url']}' />" . PHP_EOL;
        if (!is_null($this->description))
            $openGraph .= "<meta property = 'og:description' content = '$this->description' />" . PHP_EOL;
        if (!empty($this->product['main_teacher']['display_name']))
            $openGraph .= "<meta property = 'og:article:author' content = '{$this->product['main_teacher']['display_name']}' />" . PHP_EOL;

        $openGraph .= "<meta property = 'og:type' content = 'product' />" . PHP_EOL;
        $openGraph .= "<meta property = 'og:locale' content = 'fa_IR' />" . PHP_EOL;

//        $openGraph .= "<meta property = 'og:image:type' content = '' />" . PHP_EOL;
//        $openGraph .= "<meta property = 'og:image:width' content = '' />" . PHP_EOL;
//        $openGraph .= "<meta property = 'og:image:height' content = '' />" . PHP_EOL;

        return $openGraph;
    }

    public function getSchema()
    {
        // 2 status : seoColumn existed or not!
        // if existed (like post): begiresh va be view pass bede
        // if not (like blog,index): default schema template
        // include schema.view
    }
}