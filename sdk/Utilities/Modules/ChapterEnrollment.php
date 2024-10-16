<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class ChapterEnrollment
{
    public static function forUser(string $userToken, array $headers = []): Collection
    {
        try {
            return API::get('v1/user/chapter-enrollments', [], $headers);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}