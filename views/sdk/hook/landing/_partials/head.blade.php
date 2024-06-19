<!doctype html>
<html dir="rtl" lang="fa">
<head>
    {!! setting('top_of_head_script') !!}
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title')</title>
    @endif
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/hook-landing-style.scss') }}">
    <script src="{{ core_asset('resources/assets/js/clients/hook/landing.js') }}" type="module"></script>
    @stack('head')

    @php $theme = get_current_theme(); @endphp
    @if($theme != null)
        {!! $theme['rendered_css'] !!}
    @endif
    {!! setting('bottom_of_head_script') !!}
</head>
<body class="{{ $subClass }}body hook-signal"
      data-hook-signal="{{ site_url('hook/'.$hook['slug'].'/signal?type=view') }}">
{!! setting('top_of_body_script') !!}
{!! $shapeSvgHeaderBg !!}
<div class="{{ $subClass }}shape-svg-pattern header">
    {!! $shapeFooterLine !!}
</div>