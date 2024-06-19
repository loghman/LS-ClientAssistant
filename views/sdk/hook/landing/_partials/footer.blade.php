{{--<a href="#section-form" class="ls-client-hook-btn ls-client-hook-sticky-bottom ls-client-hook-icon-lg ls-client-hook-d-none">--}}
{{--    دانلود کنید--}}
{{--    {!! $iconDownload !!}--}}
{{--</a>--}}
@yield('footer')
@stack('footer')
{!! setting('bottom_of_body_script') !!}
</body>
</html>