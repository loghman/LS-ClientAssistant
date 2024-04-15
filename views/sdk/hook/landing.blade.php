@extends('sdk._common.layouts.base')
@section('title', $hook['name_fa'])

@section('content')

    @if($hook['fields']['conditions']['required_login'] || $user)
        @include('sdk.hook._partials._form', ['hook' => $hook, 'user' => $user])
    @endif

    @if(!$user && $hook['fields']['conditions']['required_login'])
        <form action="{{ setting('client_auth_index', route('auth.index')) . "?refer=" . request()->url() }}">
            <button>ورود جهت دریافت فایل</button>
        </form>
    @endif

@endsection