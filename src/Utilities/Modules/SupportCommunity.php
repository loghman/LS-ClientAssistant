<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class SupportCommunity
{
    public static function stats(): Collection
    {
        try {
            return GuzzleClient::get('v1/support/community/stats');
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}