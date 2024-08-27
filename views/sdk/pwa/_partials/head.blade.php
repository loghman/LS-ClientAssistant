{!! setting('top_of_head_script') !!}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?=$pagetitle?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

<meta name="csrf-token" content="">
<link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
<link rel="preconnect" href="{{ base_storage_url() }}"/>
<link rel="apple-touch-icon" sizes="180x180" href="{{ $data['logo_url'] }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ $data['logo_url'] }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ $data['logo_url'] }}">
<link rel="mask-icon" href="{{ $data['logo_url'] }}" color="#148ef3">
<meta name="apple-mobile-web-app-title" content="{{ $data['brand_name'] }}">
<meta name="application-name" content="{{ $data['brand_name'] }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
@stack('head')

{!! setting('bottom_of_head_script') !!}
<link rel="stylesheet" href="{{ core_asset('resources/assets/minimal-landing/css/style.scss') }}">
@php $theme = get_current_theme(); @endphp
@if($theme != null)
    {!! $theme['rendered_css'] !!}
@endif

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>