<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class ChapterEnrollment
{
    public static function forUser(string $userToken): Collection
    {
        try {
            return GuzzleClient::put('v1/user/chapter-enrollments', [], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}