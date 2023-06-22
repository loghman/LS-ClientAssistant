<?php

namespace Ls\ClientAssistant\Services\Seo;

use Ls\ClientAssistant\Services\Seo\SeoMeta;

class GeneralSeoMeta extends SeoMeta
{
    public string $title;
    public string $description;
    public string $canonical;
    public bool $noIndex;
    public bool $noFollow;

    public function __construct(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->canonical = $data['canonical'] ?? null;
        $this->noIndex = $data['noIndex'] ?? null;
        $this->noFollow = $data['noFollow'] ?? null;
    }

    public function getTitle()
    {
        return empty($this->title) ? null : "<title>$this->title</title>";
    }

    public function getCanonical()
    {
        $url = $this->canonical ?? get_current_url(true);
        return "<link rel='canonical' href='$url'/>";
    }

    public function getMetaTags()
    {
        $metaTags = '';
        // description
        $metaTags .= empty($this->description) ? null : "<meta name='description' content='$this->description'/>";

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

    public function getSchema()
    {
        // 2 status : seoColumn existed or not!
        // if existed (like post): begiresh va be view pass bede
        // if not (like blog,index): default schema template
        // include schema.view
    }
}