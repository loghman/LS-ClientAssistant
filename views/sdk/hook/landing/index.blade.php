@php
    include sdk_path('views/sdk/hook/landing/_partials/_partials/svg.php');
@endphp
@extends('sdk.hook.landing._partials.base')
@if (isset($seoMeta) && $seoMeta != '')
    @push('head')
        {!! $seoMeta !!}
    @endpush
@else
    @section('title', $hook['title_fa'])
@endif
@section('content')
    @include('sdk.hook.landing._partials.header')
    @include('sdk.hook.landing._partials.description')
    @include('sdk.hook.landing._partials.form')
    @include('sdk.hook.landing._partials.sticky-tabs')
@endsection