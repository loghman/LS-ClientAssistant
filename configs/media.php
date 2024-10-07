<?php

return [
    'default_replacements' => [
        'image' => env('MEDIA_DEFAULT_REPLACEMENT_IMAGE', 'https://via.placeholder.com/450'),
        'video' => env('MEDIA_DEFAULT_REPLACEMENT_VIDEO', ''),
        'community_icon' => env('MEDIA_DEFAULT_REPLACEMENT_COMMUNITY_ICON', 'img/icons/logo-icon.svg'),
        'icon' => env('MEDIA_DEFAULT_REPLACEMENT_ICON', 'logo-icon-white.svg'),
        'icon_single_color' => env('MEDIA_DEFAULT_REPLACEMENT_ICON_SINGLE_COLOR', 'logo-icon-white.svg'),
        'icon_multiple_color' => env('MEDIA_DEFAULT_REPLACEMENT_ICON_MULTIPLE_COLOR', 'img/icons/logo-icon.svg'),
        'course_banner' => env('MEDIA_DEFAULT_REPLACEMENT_COURSE_BANNER', 'img/banners/video-cover.png'),
        'banner' => env('MEDIA_DEFAULT_REPLACEMENT_BANNER', 'img/banners/video-cover.png'),
        'logo' => env('MEDIA_DEFAULT_REPLACEMENT_LOGO', 'https://via.placeholder.com/450'),
        'avatar' => env('MEDIA_DEFAULT_REPLACEMENT_AVATAR', 'img/icons/logo-icon.svg'),
        'teacher_avatar' => env('MEDIA_DEFAULT_REPLACEMENT_TEACHER_AVATAR', 'img/icons/logo-icon.svg'),
        'gallery' => env('MEDIA_DEFAULT_REPLACEMENT_GALLERY', 'https://via.placeholder.com/450'),
        'attachment' => env('MEDIA_DEFAULT_REPLACEMENT_ATTACHMENT', 'https://via.placeholder.com/450'),
        'post_thumbnail' => env('MEDIA_DEFAULT_REPLACEMENT_POST_THUMBNAIL', 'img/banners/video-cover.png'),
    ],
];