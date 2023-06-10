<?php

namespace Ls\ClientAssistant\Services\Seo;

use Ls\ClientAssistant\Services\Seo\SeoMeta;

class PostSeoMeta extends SeoMeta {
    private $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function getTitle()
    {
        $title = $this->post['seo']['title'] ?? $this->post['title'];
        return "<title>$title</title>";
    }

    public function getCanonical()
    {
        $url = $this->post['seo']['canonical_url'] ?? getCurrentUrl(true);
        return "<link rel='canonical' href='$url'/>";
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        $description = $this->post["seo"]["description"] ?? subWords($this->post['content'],165);
        $metaTags .= "<meta name='description' content='$description'/>" . PHP_EOL;

        // keyword
        if (isset($this->post['seo']['keywords'])){
            $keywords = implode(', ',$this->post['seo']['keywords']);
            $metaTags .= "<meta name='keywords' content='$keywords'/>" . PHP_EOL;
        }

        // robots
        $robots = [
            empty($this->post['seo']['noindex']) ? 'index' : 'noindex',
            empty($this->post['seo']['nofollow']) ? 'follow' : 'nofollow',
            'max-snippet:-1',
            'max-video-preview:-1',
            'max-image-preview:large'
        ];
        $robots = implode(', ', $robots);
        $metaTags .= "<meta name='robots' content='$robots'/>" . PHP_EOL;

        // dates
        $publishedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->post['published_at']));
        $metaTags .= "<meta property='article:published_time' content='$publishedTime' />" . PHP_EOL;

        $modifiedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->post['updated_at']));
        $metaTags .= "<meta property='article:modified_time' content='$modifiedTime' />" . PHP_EOL;

        return $metaTags;
    }

    public function getOpenGraphTags()
    {
        $openGraph = '';
        foreach ($this->post['seo']['og'] ?? [] as $openGraphKey => $openGraphValue)
            if (!empty($openGraphValue))
                $openGraph .= "<meta property='og:$openGraphKey' content='$openGraphValue' />" . PHP_EOL;


        if (empty($this->post['seo']['og']['article:author']))
            $openGraph .= "<meta property='og:article:author' content='{$this->post['author']['display_name']}' />" . PHP_EOL;

        if (empty($this->post['seo']['og']['image']))
            $openGraph .= "<meta property='og:image' content='{$this->post['thumbnailUrl']}' />" . PHP_EOL;

        if (empty($this->post['seo']['og']['locale']))
            $openGraph .= "<meta property='og:locale' content='fa_IR' />" . PHP_EOL;

        if (empty($this->post['seo']['og']['title']))
            $openGraph .= "<meta property='og:title' content='{$this->post['title']}' />" . PHP_EOL;

        if (empty($this->post['seo']['og']['description'])){
            $description = subWords($this->post['content'],165);
            $openGraph .= "<meta property='og:description' content='$description' />" . PHP_EOL;
        }


        $updatedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->post['updated_at']));
        $openGraph .= "<meta property='og:updated_time' content='$updatedTime' />" . PHP_EOL;

        //TODO url
        $url = getCurrentUrl(true);
        $openGraph .= "<meta property='og:url' content='$url' />" . PHP_EOL;

        $openGraph .= "<meta property='og:type' content='article' />" . PHP_EOL;

        $openGraph .= "<meta property='og:article:section' content='{$this->post['mainCategory']['name_fa']}' />" . PHP_EOL;

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