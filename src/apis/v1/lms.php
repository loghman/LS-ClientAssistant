<?php

include_once __DIR__ . "/../../init.php";

function lmsGetCourses(string $param = null, bool $includeComments = false): array
{
    global $guzzle;
    global $baseUrl;

    $response = $guzzle->get(($baseUrl . 'v1/lms/product/search'), [
        's' => $param,
    ]);

    if (!in_array($response->getStatusCode(), [200, 201])) {
        return [];
    }

    return json_decode($response->getBody(), true)['data'];
}