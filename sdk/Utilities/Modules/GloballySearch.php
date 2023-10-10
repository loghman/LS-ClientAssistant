<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Ls\ClientAssistant\Core\API;

class GloballySearch
{
    public static function search(string $searchKey, int $postsPage, int $coursesPage, int $topicPage)
    {
        try {
            return API::get('v1/globally-search', [
                's' => $searchKey,
                'posts-page' => $postsPage,
                'topics-page' => $topicPage,
                'courses-page' => $coursesPage,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (Exception $exception) {
            return Response::parseException($exception);
        }
    }
}