{!! setting('top_of_head_script') !!}
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?=$pagetitle ?? ''?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

<meta name="csrf-token" content="">
<link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}" />
<link rel="preconnect" href="{{ base_storage_url() }}" />
<link rel="icon" href="{{ setting('favicon') }}">
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
<link rel="manifest" href="<?=site_url('manifest.json')?>">
<link rel="stylesheet" href="https://cdn.planet.bz/font-icon/font-awesome/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.planet.bz/font-icon/font-awesome/css/regular.min.css" />
<link rel="stylesheet" href="https://cdn.planet.bz/font-icon/font-awesome/css/solid.min.css" />
<link rel="stylesheet" href="https://cdn.planet.bz/js/library/swiper/11.2.10/swiper-bundle.min.css" />
<script src="https://cdn.planet.bz/js/library/swiper/11.2.10/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionLinks = document.querySelectorAll('a.accordion');
    accordionLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            window.location.href = this.getAttribute('href');
        });
    });
});
</script>