<?php

return [
//    'base' => $GLOBALS['coreUrl'],
//    'app_url' => $GLOBALS['appUrl'],
    'base' => $GLOBALS['coreUrl'] ?? 'http://127.0.0.1:8080/api/',
    'app_url' => $GLOBALS['appUrl'] ?? 'http://localhost:2000',
    'required_settings' => [
        'username_label', 'user_login_fields', 'registration_fields', 'required_registration_fields',
        'verification_fields', 'can_user_logged_in_with_password'
    ],
];