<!doctype html>
<html dir="rtl" lang="fa">
<head>
    @include('sdk._common.layouts.head')
</head>
<body @include('_common.layouts.body-class')>
{!! setting('top_of_body_script') !!}
@includeWhen(! request()->is(array_map(fn ($item) => trim($item, '/'), setting('promotion_banner_bypass_routes', []))), 'sdk._common.components.promotion-banner')
@include('_common.layouts.client-body')
@yield('modals')
@include('_common.layouts.footer')
@include('_common.components.error-messages')
{!! setting('bottom_of_body_script') !!}
</body>
</html>