<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

class GeneralSeoMeta extends SeoMeta
{
    public null|string $title;
    public null|string $description;
    public null|string $canonical;
    public bool $noIndex;
    public bool $noFollow;

    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->canonical = $data['canonical'] ?? null;
        $this->noIndex = $data['noIndex'] ?? false;
        $this->noFollow = $data['noFollow'] ?? false;
    }

    public function getTitle()
    {
        return empty($this->title) ? null : "<title>$this->title</title>" . PHP_EOL;
    }

    public function getCanonical()
    {
        $url = $this->canonical ?? get_current_url(true);
        return "<link rel='canonical' href='$url'/>" . PHP_EOL;
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        $metaTags .= empty($this->description) ? null : "<meta name='description' content='$this->description'/>" . PHP_EOL;

        // robots
        $robots = [
            'max-snippet:-1',
            'max-video-preview:-1',
            'max-image-preview:large'
        ];
        if ($this->noIndex) $robots[] = 'noindex';
        if ($this->noFollow) $robots[] = 'nofollow';

        $robots = implode(', ', $robots);
        $metaTags .= "<meta name='robots' content='$robots'/>" . PHP_EOL;

        return $metaTags;
    }

    public function getOpenGraphTags()
    {
    }

    public function getTwitterTags()
    {
    }

    public function getSchema()
    {
        // 2 status : seoColumn existed or not!
        // if existed (like post): begiresh va be view pass bede
        // if not (like blog,index): default schema template
        // include schema.view
    }
}