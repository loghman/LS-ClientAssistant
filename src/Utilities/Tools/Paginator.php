<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Config;

class Paginator
{
    public static function setLink(array $paginatedData): array
    {
        if (isset($paginatedData['data']['first_page_url'])) {
            $actualLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $firstPageUrl = $actualLink . substr($paginatedData['data']['first_page_url'], strpos($paginatedData['data']['first_page_url'], '?'));
            $lastPageUrl = $actualLink . substr($paginatedData['data']['last_page_url'], strpos($paginatedData['data']['last_page_url'], '?'));

            $paginatedData['data']['first_page_url'] = $firstPageUrl;
            $paginatedData['data']['last_page_url'] = $lastPageUrl;
            $paginatedData['data']['path'] = $actualLink;

            foreach ($paginatedData['data']['links'] as $key => $link) {
                if (!is_null($link['url'])) {
                    $paginatedData['data']['links'][$key]['url'] = $actualLink . substr($link['url'], strpos($link['url'], '?'));
                }
            }
        }

        return $paginatedData;
    }
}