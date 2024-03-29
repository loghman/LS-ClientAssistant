<?php

namespace Ls\ClientAssistant\Services\Seo\MetaTags;

abstract class SeoMeta
{

    public function render($type = 'html')
    {
        $method = sprintf('get%sRendered', ucfirst($type));
        if (!method_exists($this, $method)) {
            throw new \Exception('SEO render type is wrong!');
        }
        return $this->$method();
    }

    private function getObjectRendered()
    {
        $seoMeta = new \stdClass;
        $seoMeta->title = $this->getTitle();
        $seoMeta->commonMeta = $this->getCommonMeta();
        $seoMeta->canonical = $this->getCanonical();
        $seoMeta->metaTags = $this->getMetaTags();
        $seoMeta->openGraph = $this->getOpenGraphTags();
        $seoMeta->openGraph = $this->getTwitterTags();
        $seoMeta->schema = $this->getSchema();
        return $seoMeta;
    }

    private function getHtmlRendered()
    {
        $seoMeta = '<!-- Start LS Smart SEO Tags -->' . PHP_EOL;
        $seoMeta .= $this->getTitle() . PHP_EOL;
        $seoMeta .= $this->getCommonMeta() . PHP_EOL;
        $seoMeta .= $this->getCanonical() . PHP_EOL;
        $seoMeta .= $this->getMetaTags() . PHP_EOL;
        $seoMeta .= $this->getOpenGraphTags() . PHP_EOL;
        $seoMeta .= $this->getTwitterTags() . PHP_EOL;
        $seoMeta .= $this->getSchema() . PHP_EOL;
        $seoMeta .= '<!-- END LS Smart SEO Tags -->' . PHP_EOL;
        return $seoMeta;
    }

    public function getCommonMeta(): string
    {
        $commonMeta = '';
        //TODO Social addresses

        //TODO DnsPrefetchDomains

        //TODO FavIcons & Colors

        //TODO og:sit_ename

        return $commonMeta;
    }

    abstract public function getTitle();

    abstract public function getCanonical();

    abstract public function getMetaTags();

    abstract public function getOpenGraphTags();

    abstract public function getTwitterTags();

    abstract public function getSchema();
}