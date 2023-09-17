<?php

include_once __DIR__ . "/vendor/autoload.php";

if(!empty(env('SENTRY_DSN')))
    \Sentry\init(['dsn' => env('SENTRY_DSN') ]);