{!! setting('top_of_head_script') !!}

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
@hasSection('title')
    <title>@yield('title')</title>
@endif
<meta name="csrf-token" content="">
<link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
<link rel="preconnect" href="{{ base_storage_url() }}"/>
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
<meta name="apple-mobile-web-app-title" content="{{setting('brand_name_en')}}">
<meta name="application-name" content="{{setting('brand_name_en')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
@stack('head')

{!! setting('bottom_of_head_script') !!}
<meta name='description' content='{{ $product['seo']['description'] ?? '' }}' />
<link rel="stylesheet" href="{{ core_asset('resources/assets/minimal-landing/css/style.scss') }}">
@php $theme = get_current_theme(); @endphp
@if($theme != null)
    {!! $theme['rendered_css'] !!}
@endif