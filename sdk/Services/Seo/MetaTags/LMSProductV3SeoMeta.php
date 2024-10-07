<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

class LMSProductV3SeoMeta extends SeoMeta
{
    private $product;
    private $meta;
    private $seo;
    private $description = null;
    private $title = null;
    private $currentUrl;

    public function __construct($product)
    {
        $this->product = $product;
        $this->meta = $product['meta'];
        $this->seo = $product['seo'];
        $this->currentUrl = get_current_url(true);
        if (!empty($this->product['description']['full']) or !empty($this->seo['description']))
            $this->description = sub_words(strip_tags($this->seo['description'] ?? $this->product['description']['full']), 165);
        $this->title = $this->seo['title'] ?? $this->product['title'];
    }

    public function getTitle()
    {
        return "<title>{$this->title}</title>" . PHP_EOL;
    }

    public function getCanonical()
    {
        return "<link rel='canonical' href='$this->currentUrl' />" . PHP_EOL;
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        if (!is_null($this->description)) {
            $metaTags .= "<meta name='description' content='$this->description' />" . PHP_EOL;
        }

        // dates
        $publishedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['created_at']['main']));
        $metaTags .= "<meta property='article:published_time' content='$publishedTime' />" . PHP_EOL;

        $modifiedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['updated_at']['main']));
        $metaTags .= "<meta property='article:modified_time' content='$modifiedTime' />" . PHP_EOL;

        return $metaTags;

    }

    public function getOpenGraphTags()
    {

        $openGraph = '';

        $openGraph .= "<meta property='og:title' content='{$this->title}' />" . PHP_EOL;
        $openGraph .= "<meta property='og:image:alt' content='{$this->title}' />" . PHP_EOL;
        $openGraph .= "<meta property='og:url' content='$this->currentUrl' />" . PHP_EOL;
        $updatedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->product['updated_at']['main']));
        $openGraph .= "<meta property='og:updated_time' content='$updatedTime' />" . PHP_EOL;

        if (!empty($this->banner)) {
//        if (!empty($this->banner_url)) {
            $bannerUrl = get_media_url($this->banner);
//            list($width, $height, $type, $attr) = getimagesize($bannerUrl);
            $openGraph .= "<meta property='og:image' content='{$bannerUrl}' />" . PHP_EOL;
            $openGraph .= "<meta property='og:image:width' content='768' />" . PHP_EOL;
            $openGraph .= "<meta property='og:image:height' content='1024' />" . PHP_EOL;
        }

        if (!is_null($this->description))
            $openGraph .= "<meta property='og:description' content='{$this->description}' />" . PHP_EOL;
        if (!empty($this->product['main_teacher']['display_name']))
            $openGraph .= "<meta property='og:article:author' content='{$this->product['main_teacher']['display_name']}' />" . PHP_EOL;

        $openGraph .= "<meta property='og:type' content='product' />" . PHP_EOL;
        $openGraph .= "<meta property='og:locale' content='fa_IR' />" . PHP_EOL;


        return $openGraph;
    }

    public function getTwitterTags(): string
    {
        $twitterTags = '';

        if (!empty($this->banner)) {
//        if (!empty($this->banner_url)) {
            $bannerUrl = get_media_url($this->banner);
//            $bannerUrl = $this->banner_url;
            $twitterTags .= "<meta name='twitter:title' content='$this->title' />" . PHP_EOL;
            $twitterTags .= "<meta name='twitter:card' content='summary_large_image' />" . PHP_EOL;
            $twitterTags .= "<meta name='twitter:image' content='{$bannerUrl}' />" . PHP_EOL;
            if (!empty($this->description)) {
                $twitterTags .= "<meta name='twitter:description' content='$this->description' />" . PHP_EOL;
            }
        }

        return $twitterTags;

    }

    public function getSchema()
    {
        // 2 status : seoColumn existed or not!
        // if existed (like post): begiresh va be view pass bede
        // if not (like blog,index): default schema template
        // include schema.view
    }
}