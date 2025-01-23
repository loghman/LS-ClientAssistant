<!doctype html>
<html dir="rtl" lang="fa">
<head>
    @yield('heads')
    <link rel="manifest" href="<?=site_url('manifest.json')?>">
</head>
<body @include('_common.layouts.body-class')>
{!! setting('top_of_body_script') !!}
@yield('body')
@include('_common.components.error-messages')
{!! setting('bottom_of_body_script') !!}
</body>
</html>