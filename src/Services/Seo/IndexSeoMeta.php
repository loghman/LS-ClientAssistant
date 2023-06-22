<?php

namespace Ls\ClientAssistant\Services\Seo;

use Ls\ClientAssistant\Services\Seo\SeoMeta;

class IndexSeoMeta extends SeoMeta
{
    public function __construct()
    {
    }

    public function getTitle()
    {
    }

    public function getCanonical()
    {
    }

    public function getMetaTags()
    {

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