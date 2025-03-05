@extends('sdk._common.layouts.foundation')

@section('heads')
    @include('sdk._common.layouts.head')
    <link rel="stylesheet" href="<?=site_url('assets/ckstyle.css')?>">
    <link rel="icon" href="{{ setting('favicon') }}">
@endsection

@section('body')
    @includeWhen(! request()->is(array_map(fn ($item) => trim($item, '/'), setting('promotion_banner_bypass_routes', []))), 'sdk._common.components.promotion-banner')
    @include('_common.layouts.client-body')
    @yield('modals')
    @include('_common.layouts.footer')
@endsection