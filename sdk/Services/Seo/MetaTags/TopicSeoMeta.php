<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

class TopicSeoMeta extends SeoMeta
{
    private $topic;
    private $meta;
    private $description;
    private $currentUrl;

    public function __construct($topic)
    {
        $this->topic = $topic;
        $this->meta = json_decode($topic['meta'] ?? '[]', true);
        $this->currentUrl = get_current_url(true);
        $this->description = sub_words($this->topic['content'], 165);

    }

    public function getTitle()
    {
        return "<title>{$this->topic['title']}</title>" . PHP_EOL;
    }

    public function getCanonical()
    {
        return "<link rel='canonical' href='$this->currentUrl' />" . PHP_EOL;
    }

    public function getMetaTags()
    {
        $metaTags = '';

        // robots
        $metaTags .= "<meta name='robots' content='noindex' />" . PHP_EOL;

        // description
        $metaTags .= "<meta name='description' content='$this->description' />" . PHP_EOL;

        // dates
        $publishedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->topic['created_at']));
        $metaTags .= "<meta property='article:published_time' content='$publishedTime' />" . PHP_EOL;

        $modifiedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->topic['updated_at']));
        $metaTags .= "<meta property='article:modified_time' content='$modifiedTime' />" . PHP_EOL;

        return $metaTags;

    }

    public function getOpenGraphTags()
    {

        $openGraph = '';

        $openGraph .= "<meta property='og:title' content='{$this->topic['title']}' />" . PHP_EOL;
        $openGraph .= "<meta property='og:url' content='$this->currentUrl' />" . PHP_EOL;
        $updatedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->topic['updated_at']));
        $openGraph .= "<meta property='og:updated_time' content='$updatedTime' />" . PHP_EOL;
        $openGraph .= "<meta property='og:description' content='$this->description' />" . PHP_EOL;
        $openGraph .= "<meta property='og:article:author' content='{$this->topic['creator']['display_name']}' />" . PHP_EOL;

        $openGraph .= "<meta property='og:type' content='article' />" . PHP_EOL;
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