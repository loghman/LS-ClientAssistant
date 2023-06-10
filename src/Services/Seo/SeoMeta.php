<?php

namespace Ls\ClientAssistant\Services\Seo;

use Illuminate\Contracts\Support\Renderable;

abstract class SeoMeta {

    public function render($type = 'html')
    {
        $method = sprintf('get%sRendered', ucfirst($type));
        method_exists($this,$method) || throw new \Exception('SEO render type is wrong!');
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
        $seoMeta .= $this->getSchema() . PHP_EOL;
        $seoMeta .= '<!-- END LS Smart SEO Tags -->' . PHP_EOL;
        return $seoMeta;
    }

    public function getCommonMeta()
    {
        //TODO Social addresses

        //TODO DnsPrefetchDomains

        //TODO FavIcons & Colors

        //TODO og:sit_ename
    }

    abstract public function getTitle();
    abstract public function getCanonical();
    abstract public function getMetaTags();
    abstract public function getOpenGraphTags();
    abstract public function getSchema();
}