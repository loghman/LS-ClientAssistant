@section('title', $product['seo']['title'] ?? $product['title'])
@extends('sdk._common.layouts.foundation')

@section('heads')
    @include('sdk.pages.landing-partials.head')
@endsection

@section('body')
    <div class="base-content">
        @include('sdk.pages.landing-partials.navbar')
        @include('sdk.pages.landing-partials.video')

        <div class="content">
            @include('sdk.pages.quick-pay.form', ['class'=>'mb-2'])
            @include('sdk.pages.quick-pay.teacher')
            @include('sdk.pages.quick-pay.chapters')
            @include('sdk.pages.quick-pay.form', ['class'=>'mt-2'])
        </div>

    </div>
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
@endsection