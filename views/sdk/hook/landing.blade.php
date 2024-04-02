@extends('sdk._common.layouts.base')
@if (isset($seoMeta) && $seoMeta != '')
    @push('head')
        {!! $seoMeta !!}
    @endpush
@else
    @section('title', $hook['title_fa'])
@endif
@section('content')

    @if($hook['fields']['conditions']['required_login'] || $user)
        @include('sdk.hook._partials._form', ['hook' => $hook, 'user' => $user])
    @endif

    @if(!$user && $hook['fields']['conditions']['required_login'])
        <form action="{{ route('auth.index') }}">
            <button>ورود جهت دریافت فایل</button>
        </form>
    @endif
@endsection