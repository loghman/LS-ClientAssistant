<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class Faculty
{
    public static function teachersStats(): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/faculty/teachers/stats');
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function mentorsStats(): Collection
    {
        try {
            return GuzzleClient::get('v1/lms/faculty/mentors/stats');
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}