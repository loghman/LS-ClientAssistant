@include('_common.layouts.head')
<body class="@yield('body-class')" @yield('body-props')>

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
@include('sdk._common.scripts.base')
@include('sdk._common.components.error-messages')
@yield('footer')
@stack('footer')
</body>
</html>
