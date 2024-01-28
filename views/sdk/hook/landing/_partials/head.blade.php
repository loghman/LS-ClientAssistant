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
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/clients/hook/landing/style.scss') }}">
    <script src="{{ core_asset('resources/assets/js/clients/hook/landing.js') }}" type="module"></script>
    <script src="{{ core_asset('resources/assets/js/jss.js') }}" type="module"></script>
    @stack('head')
</head>
<body class="{{ $subClass }}body hook-signal" data-hook-signal="{{ site_url('hook/'.$hook['slug'].'/signal?type=view') }}">
{!! $shapeSvgHeaderBg !!}
<div class="{{ $subClass }}shape-svg-pattern header">
    {!! $shapePatternA !!}
</div>
