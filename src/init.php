<?php

include_once __DIR__ . '/../vendor/autoload.php';

include_once __DIR__ . "/helpers.php";

$guzzle = initGuzzle();
$baseUrl = config('endpoints.base');