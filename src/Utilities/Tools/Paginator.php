<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Config;

class Paginator
{
    public static function setLink(array $paginatedData): array
    {
        if (isset($paginatedData['first_page_url'])) {
            $needleUrl = substr($paginatedData['first_page_url'], 0, strpos($paginatedData['first_page_url'], 'api'));
            $paginatedData['first_page_url'] = str_replace($needleUrl, Config::get('endpoints.base'), $paginatedData['first_page_url']);
            $paginatedData['last_page_url'] = str_replace($needleUrl, Config::get('endpoints.base'), $paginatedData['last_page_url']);
            $paginatedData['path'] = str_replace($needleUrl, Config::get('endpoints.base'), $paginatedData['path']);

            foreach ($paginatedData['links'] as $link) {
                if (!is_null($link['url'])) {
                    $link['url'] = str_replace($needleUrl, Config::get('endpoints.base'), $link['url']);
                }
            }
        }

        return $paginatedData;
    }
}