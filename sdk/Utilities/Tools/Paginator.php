<?php

namespace Ls\ClientAssistant\Utilities\Tools;

class Paginator
{
    public static function setLink(array $paginatedData): array
    {
        if (isset($paginatedData['data']['first_page_url'])) {
            $currentLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $actualLink = str_replace('?' . ($_SERVER['QUERY_STRING'] ?? ''), '', $currentLink);

            $firstPageUrl = $actualLink . ($paginatedData['data']['first_page_url'] ? substr($paginatedData['data']['first_page_url'], strpos($paginatedData['data']['first_page_url'], '?')) : '');
            $lastPageUrl = $actualLink . ($paginatedData['data']['last_page_url'] ? substr($paginatedData['data']['last_page_url'], strpos($paginatedData['data']['last_page_url'], '?')) : '');
            $nextPageUrl = $actualLink . ($paginatedData['data']['next_page_url'] ? substr($paginatedData['data']['next_page_url'], strpos($paginatedData['data']['next_page_url'], '?')) : '');

            $paginatedData['data']['first_page_url'] = $firstPageUrl;
            $paginatedData['data']['last_page_url'] = $lastPageUrl;
            $paginatedData['data']['next_page_url'] = $nextPageUrl;
            $paginatedData['data']['path'] = $actualLink;

            $matches = [];
            $restOfTheUri = '';
            foreach ($paginatedData['data']['links'] as $key => $link) {
                if (!is_null($link['url'])) {
                    if ($currentLink != $actualLink) {
                        $restOfTheUri = str_replace('?', '&', substr($currentLink, strpos($currentLink, '?')));
                        preg_match_all('/&page=\d+/', $restOfTheUri, $matches);
                    }
                    $paginatedData['data']['links'][$key]['url'] = $actualLink . substr($link['url'], strpos($link['url'], '?')) . str_replace(($matches[0] ??''), '', $restOfTheUri);
                }
            }
        }

        if (isset($paginatedData['first_page_url'])) {
            $currentLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $actualLink = str_replace(('?' . ($_SERVER['QUERY_STRING'] ?? '')), '', $currentLink);

            $firstPageUrl = $actualLink . ($paginatedData['first_page_url'] ? substr($paginatedData['first_page_url'], strpos($paginatedData['first_page_url'], '?')) : '');
            $lastPageUrl = $actualLink . ($paginatedData['last_page_url'] ? substr($paginatedData['last_page_url'], strpos($paginatedData['last_page_url'], '?')) : '');
            $nextPageUrl = $actualLink . ($paginatedData['next_page_url'] ? substr($paginatedData['next_page_url'], strpos($paginatedData['next_page_url'], '?')) : '');

            $paginatedData['first_page_url'] = $firstPageUrl;
            $paginatedData['last_page_url'] = $lastPageUrl;
            $paginatedData['next_page_url'] = $nextPageUrl;
            $paginatedData['path'] = $actualLink;

            $matches = [];
            $restOfTheUri = '';
            foreach ($paginatedData['links'] as $key => $link) {
                if (!is_null($link['url'])) {
                    if ($currentLink != $actualLink) {
                        $restOfTheUri = str_replace('?', '&', substr($currentLink, strpos($currentLink, '?')));
                        preg_match_all('/&page=\d+/', $restOfTheUri, $matches);
                    }

                    $paginatedData['links'][$key]['url'] = $actualLink . substr($link['url'], strpos($link['url'], '?')) . str_replace(($matches[0] ?? ''), '', $restOfTheUri);
                }
            }
        }

        return $paginatedData;
    }
}