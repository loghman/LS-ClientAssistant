<?php

namespace Ls\ClientAssistant\Utilities\Tools;

use Ls\ClientAssistant\Helpers\Config;

class Paginator
{
    public static function setLink(array $paginatedData): array
    {
        if (isset($paginatedData['data']['first_page_url'])) {
            $actualLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $actualLink = str_replace('?' . $_SERVER['QUERY_STRING'], '', $actualLink);
            $firstPageUrl = $actualLink . ($paginatedData['data']['first_page_url'] ? substr($paginatedData['data']['first_page_url'], strpos($paginatedData['data']['first_page_url'], '?')) : '');
            $lastPageUrl = $actualLink . ($paginatedData['data']['last_page_url'] ? substr($paginatedData['data']['last_page_url'], strpos($paginatedData['data']['last_page_url'], '?')) : '');
            $nextPageUrl = $actualLink . ($paginatedData['data']['next_page_url'] ? substr($paginatedData['data']['next_page_url'], strpos($paginatedData['data']['next_page_url'], '?')) : '');

            $paginatedData['data']['first_page_url'] = $firstPageUrl;
            $paginatedData['data']['last_page_url'] = $lastPageUrl;
            $paginatedData['data']['next_page_url'] = $nextPageUrl;
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