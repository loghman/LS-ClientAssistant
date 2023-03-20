<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Ls\ClientAssistant\Core\API;


//TODO: return object if it's single
class LMS
{
    public static function getCourses(string $param = null, bool $includeComments = false): array
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
