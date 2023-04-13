<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Config;

class Paginator
{
    public static function setLink(array $paginatedData): array
    {
        if (isset($paginatedData['data']['first_page_url'])) {
            $needleUrl = substr($paginatedData['data']['first_page_url'], 0, strpos($paginatedData['data']['first_page_url'], 'api'));
            $paginatedData['data']['first_page_url'] = str_replace($needleUrl, Config::get('endpoints.app_url'), $paginatedData['data']['first_page_url']);
            $paginatedData['data']['last_page_url'] = str_replace($needleUrl, Config::get('endpoints.app_url'), $paginatedData['data']['last_page_url']);
            $paginatedData['data']['path'] = str_replace($needleUrl, Config::get('endpoints.app_url'), $paginatedData['data']['path']);

            foreach ($paginatedData['data']['links'] as $link) {
                if (!is_null($link['url'])) {
                    $link['url'] = str_replace($needleUrl, Config::get('endpoints.app_url'), $link['url']);
                }
            }
        }

        return $paginatedData;
    }
}