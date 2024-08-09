<!doctype html>
<html dir="rtl" lang="fa">
<head>
    {!! setting('top_of_head_script') !!}
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/app.scss') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>sdk-vue-onboarding</title>
    <script type="module"  src={{getViteAssetUrl('views/vue-apps/onboarding.js')}}></script>
    <link rel="stylesheet" href="{{ getViteAssetUrl('views/vue-apps/assets/css/auth.scss') }}">
    @stack('head')

    @php $theme = get_current_theme(); @endphp
    @if($theme != null)
        {!! $theme['rendered_css'] !!}
    @endif
    {!! setting('bottom_of_head_script') !!}
</head>
<body >
{!! setting('top_of_body_script') !!}
