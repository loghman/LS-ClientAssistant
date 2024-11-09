<?php

return [
    'base' => $GLOBALS['coreUrl'] ?? 'http://127.0.0.1:8080/api/',
    'app_url' => $GLOBALS['appUrl'] ?? 'http://localhost:2000',
    'enable_cart_payment' => $GLOBALS['enableCartPayment'] === null || $GLOBALS['enableCartPayment'] === 'true',
    'hook-cookie-name' => 'from_hook',
];