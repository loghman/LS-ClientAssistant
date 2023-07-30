<?php

return [
//    'base' => $GLOBALS['coreUrl'],
//    'app_url' => $GLOBALS['appUrl'],
    'base' => $GLOBALS['coreUrl'] ?? 'http://127.0.0.1:8080/api/',
    'app_url' => $GLOBALS['appUrl'] ?? 'http://localhost:2000',
    'required_settings' => [
        'username_label', 'user_login_fields', 'registration_fields', 'required_registration_fields',
        'verification_fields', 'can_user_logged_in_with_password',
        'brand_name_fa', 'brand_name_en', 'site_title', 'site_description', 'social_links',
        'client_cache_driver', 'client_cache_request_setting',
        'client_cache_request_cms', 'client_cache_request_lms', 'client_cache_request_hlms', 'client_cache_request_shop',
        'client_cache_revalidation_time', 'client_cache_active_for_logged_in_user',
    ],
];