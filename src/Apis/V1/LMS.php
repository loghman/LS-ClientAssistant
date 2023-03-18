<?php

namespace Ls\ClientAssistant\Apis\V1;

use Ls\ClientAssistant\Core\API;

class LMS
{
    public static function lmsGetCourses(string $param = null, bool $includeComments = false): array
    {

        $response = API::guzzle()->get((API::uri('v1/lms/product/search')), [
            's' => $param,
        ]);

        if (!in_array($response->getStatusCode(), [200, 201])) {
            return [];
        }

        return json_decode($response->getBody(), true)['data'];
    }
}
