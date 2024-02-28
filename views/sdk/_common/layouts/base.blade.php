<!doctype html>
<html dir="rtl" lang="fa">
<head>
@include('sdk._common.layouts.head')
@include('_common.layouts.head')
</head>
<body class="@yield('body-class')" @yield('body-props')>
{{ setting('top_of_body_script') }}
@include('sdk._common.noscript')
@sectionMissing('without-tag-manager')
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FBTZBV"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
@include('_common.components.promotion-banner')
@if(!isset($custom_base))
    @include('_common.layouts.header')
    <div class="base-content @yield('base-content-class')">
        @yield('content')
    </div>
@else
    @yield('content')
@endif
@yield('modals')
@include('_common.layouts.footer')
@include('_common.components.error-messages')
{{ setting('bottom_of_body_script') }}
</body>
</html>
