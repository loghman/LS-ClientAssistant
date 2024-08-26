<!doctype html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاوره {{ $workflowData['name_fa'] }}</title>
    <link rel="stylesheet" href="{{ asset_url('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ core_url('css/client-common-components.min.css') }}">
    <meta name="csrf-token" content="">
    <link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
    <link rel="preconnect" href="{{ base_storage_url() }}"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
    <meta name="apple-mobile-web-app-title" content="{{setting('brand_name_en')}}">
    <meta name="application-name" content="{{setting('brand_name_en')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body class="bg-secondary page-form">
<div class="container mb-xxl">
    <div class="row justify-content-center">
        <div class="col-12 d-flex flex-column text-white justify-content-center text-center py-sm gap-xs">
            @if($title && strlen($title) > 10)
                <h1 class="t-heading-sm">{{ $title }}</h1>
            @endif
        </div>
        <div class="col-lg-6 d-flex flex-column align-items-center gap-sm">
            <div class="card p-xxs--sm">
                @include('sdk.workflow.form', ['wrapper_classes' => 'd-flex flex-column gap-xs'])
            </div>

            <img style="opacity: .15" height="35" src="{{ asset_url('img/icons/logo-white.svg') }}" alt="">
        </div>
    </div>
</div>

<script src="{{ asset_url('js/jquery.min.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/js/jss.js') }}"></script>
@stack('footer')
</body>
</html>