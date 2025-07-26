@section('title', $product['seo']['title'] ?? $product['title'])

@extends('sdk._common.layouts.foundation')

@section('heads')
 @include('sdk.pages.landing-partials.head')
@endsection

@section('body')
    <div class="base-content">
        {!! setting('top_of_body_script') !!}
        @include('sdk.pages.landing-partials.navbar')
        @include('sdk.pages.landing-partials.video')

        <div class="content">
            @include('sdk.pages.landing-partials.tabs')
            @include('sdk.pages.landing-partials.tab-headers')
            @if($product['description'])
                @include('sdk.pages.landing-partials.tab-description')
            @endif
            @if(count($product['productGifts']) > 0)
                @include('sdk.pages.landing-partials.tab-gifts')
            @endif
        </div>
        @include('sdk.pages.landing-partials.footer-sticky')

    </div>
    <script type="module" src="{{ core_asset('resources/assets/js/plugins/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
@endsection