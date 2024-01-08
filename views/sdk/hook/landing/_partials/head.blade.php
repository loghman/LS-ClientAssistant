<!doctype html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title')</title>
    @endif
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/clients/hook/landing.scss') }}">
    @stack('head')
</head>
<body class="ls-client-hook-body">

<svg class="ls-client-hook-shape-bg" viewBox="0 0 746 875" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g clip-path="url(#clip0_64_79)">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2394 314.506L233.886 719.331C252.607 753.679 289.323 774.294 328.395 772.397L573.137 760.509C599.661 759.221 625.642 768.327 645.557 785.894L746 874.488V2.76913C744.919 1.82291 743.818 0.899656 742.698 0H159.878L133.288 96.8739C126.066 123.188 108.601 145.51 84.7982 158.852L52.9283 176.715C4.19931 204.028 -13.4944 265.457 13.2394 314.506Z" fill="var(--primary-5)"/>
    </g>
    <defs>
        <clipPath id="clip0_64_79">
            <rect width="746" height="875" fill="white"/>
        </clipPath>
    </defs>
</svg>
