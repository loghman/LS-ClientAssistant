@section('title', $product['seo']['title'] ?? $product['title'])
<!doctype html>
<html lang="fa">
<head>
    @include('sdk.pages.landing-partials.head')
</head>
<body>
<div class="base-content">
    @include('sdk.pages.landing-partials.navbar')
    @include('sdk.pages.landing-partials.video')

    <div class="content">
        @include('sdk.pages.landing-partials.tabs')
        @include('sdk.pages.landing-partials.tab-headers')
        @include('sdk.pages.landing-partials.tab-description')
        @if(count($product['productGifts']) > 0)
            @include('sdk.pages.landing-partials.tab-gifts')
        @endif
    </div>
    @include('sdk.pages.landing-partials.footer-sticky')

</div>
<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
</body>
</html>
