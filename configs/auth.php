<?php

return [
    'available_user_login_fields' => [
        'mobile' => 'شماره تماس', 'email' => 'ایمیل',
        'username' => 'نام کاربری', 'national_code' => 'کد ملی',
    ],
    'default_user_login_fields' => ['mobile'],
    'available_registration_fields' => [
        'display_name' => 'نام و نام خانوادگی', 'email' => 'ایمیل', 'mobile' => 'شماره موبایل',
        'username' => 'نام کاربری', 'national_code' => 'کد ملی', 'sex' => 'جنسیت',
        'password' => 'رمز عبور',
    ],
    'default_registration_fields' => ['mobile', 'password'],
    'default_required_registration_fields' => ['mobile', 'password'],
    'available_verification_fields' => [
        'national_code' => 'کد ملی', 'username' => 'نام کاربری',
        'email' => 'ایمیل', 'mobile' => 'شماره موبایل',
    ],
];