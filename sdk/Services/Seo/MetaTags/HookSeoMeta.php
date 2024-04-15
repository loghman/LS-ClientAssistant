<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

class HookSeoMeta extends SeoMeta
{
    private $hook;

    public function __construct($hook)
    {
        $this->hook = $hook;
    }

    public function getTitle()
    {
        $title = $this->hook['seo']['title'] ?? $this->hook['title_fa'];
        return "<title>$title</title>";
    }

    public function getCanonical()
    {
        $url = $this->hook['seo']['canonical_url'] ?? get_current_url(true);
        return "<link rel='canonical' href='$url'/>";
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        $description = $this->hook["seo"]["description"] ?? sub_words($this->hook['description']['full']??' ', 165);
        $metaTags .= "<meta name='description' content='$description'/>" . PHP_EOL;


        // keyword
//        if (isset($this->hook['seo']['keywords'])) {
//            $keywords = implode(', ', $this->hook['seo']['keywords']);
//            $metaTags .= "<meta name='keywords' content='$keywords'/>" . PHP_EOL;
//        }

        // robots
        $robots = [
            empty($this->hook['seo']['noindex']) ? 'index' : 'noindex',
            empty($this->hook['seo']['nofollow']) ? 'follow' : 'nofollow',
            'max-snippet:-1',
            'max-video-preview:-1',
            'max-image-preview:large'
        ];

        $robots = implode(', ', $robots);
        $metaTags .= "<meta name='robots' content='$robots'/>" . PHP_EOL;

        $publishedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->hook['created_at']['main']));
        $metaTags .= "<meta property='hook:published_time' content='$publishedTime' />" . PHP_EOL;

        $modifiedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->hook['updated_at']['main']));
        $metaTags .= "<meta property='hook:modified_time' content='$modifiedTime' />" . PHP_EOL;
        return $metaTags;
    }

    public function getOpenGraphTags()
    {
        $openGraph = '';
        foreach ($this->hook['seo']['og'] ?? [] as $openGraphKey => $openGraphValue)
            if (!empty($openGraphValue))
                $openGraph .= "<meta property='og:$openGraphKey' content='$openGraphValue' />" . PHP_EOL;


        if (!empty($this->hook['banner']['main']['url'])) {
//            list($width, $height, $type, $attr) = getimagesize($this->hook['hook_logo']);
            $openGraph .= "<meta property='og:image' content='{$this->hook['banner']['main']['url']}' />" . PHP_EOL;
            $openGraph .= "<meta property='og:image:width' content='768' />" . PHP_EOL;
            $openGraph .= "<meta property='og:image:height' content='1024' />" . PHP_EOL;
        }

        $openGraph .= "<meta property='og:locale' content='fa_IR' />" . PHP_EOL;
        $openGraph .= "<meta property='og:title' content='{$this->hook['title_fa']}' />" . PHP_EOL;
        $description = sub_words($this->hook['description']['full']??' ', 165);
        $openGraph .= "<meta property='og:description' content='$description' />" . PHP_EOL;

        $updatedTime = date('Y-m-d\TH:i:s+03:30', strtotime($this->hook['updated_at']['main']));
        $openGraph .= "<meta property='og:updated_time' content='$updatedTime' />" . PHP_EOL;

        //TODO url
        $url = get_current_url(true);
        $openGraph .= "<meta property='og:url' content='$url' />" . PHP_EOL;
        $openGraph .= "<meta property='og:type' content='article' />" . PHP_EOL;
        return $openGraph;
    }

    public function getTwitterTags(): string
    {
        $twitterTags = '';

        $description = sub_words($this->hook['description']['full']??' ', 165);
        if (!empty($description)) {
            $twitterTags .= "<meta name='twitter:description' content='$description' />" . PHP_EOL;
        }

        $twitterTags .= "<meta name='twitter:title' content='{$this->hook['title_fa']}' />" . PHP_EOL;
        $twitterTags .= "<meta name='twitter:card' content='summary_large_image' />" . PHP_EOL;
        if (!empty($this->hook['banner']['main']['url'])) {
            $twitterTags .= "<meta name='twitter:image' content='{$this->hook['banner']['main']['url']}' />" . PHP_EOL;
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