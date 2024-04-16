<?php

namespace Ls\ClientAssistant\Services\Seo\SiteMaps;

abstract class siteMap
{
    public function __construct(public ?array $data = null)
    {
    }

    public function render(): string
    {
        header('Content-Type: text/xml');
        $siteMap = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $siteMap .= $this->tags();
        echo $siteMap;
        die;
    }

    abstract public function tags(): string;

    abstract public function items(): string;
}