<?php

return [
//    'base' => $GLOBALS['coreUrl'],
//    'app_url' => $GLOBALS['appUrl'],
    'base' => $GLOBALS['coreUrl'] ?? 'http://127.0.0.1:8080/api/',
    'app_url' => $GLOBALS['appUrl'] ?? 'http://localhost:2000',
];