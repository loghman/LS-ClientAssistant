<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

class IndexSeoMeta extends SeoMeta
{
    private $currentUrl;
    private $title;
    private $description;

    public function __construct()
    {
        $this->currentUrl = get_current_url(true);
        $this->title = setting('site_title');
        $this->description = sub_words(setting('site_description'), 165);
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
        $metaTags .= "<meta name='description' content='$this->description' />" . PHP_EOL;

        return $metaTags;

    }

    public function getOpenGraphTags()
    {

        $openGraph = '';

        $openGraph .= "<meta property='og:title' content='{$this->title}' />" . PHP_EOL;
        $openGraph .= "<meta property='og:url' content='$this->currentUrl' />" . PHP_EOL;
        $openGraph .= "<meta property='og:description' content='$this->description' />" . PHP_EOL;
        $openGraph .= "<meta property='og:type' content='website' />" . PHP_EOL;
        $openGraph .= "<meta property='og:locale' content='fa_IR' />" . PHP_EOL;

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