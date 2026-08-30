<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Allowed landing origins for GTM postMessage
    |--------------------------------------------------------------------------
    |
    | Origins of campaign landing pages that embed the workflow form in an
    | iframe. Each item must be a full origin (scheme + host, optional port),
    | without a trailing path, e.g. 'https://landing.example.com'.
    |
    | CAMPAIGN BLOCKER: this list MUST be filled from Afrak/product before a
    | real production campaign starts. An empty list in production will NOT
    | fall back to postMessage targetOrigin '*'.
    |
    */
    'allowed_landing_origins' => [
        // 'https://landing.example.com',
    ],
];
