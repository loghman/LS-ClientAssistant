@extends('_common.layouts.base')
@section('title', 'تایید حساب کاربری')
@section('body-class', '')
@push('head')@endpush
@section('header-class', 'square md center')
@section('header')@endsection
@section('base-content-class', 'lg')
{{--@section('without-tag-manager', true)--}}
@section('content')
    <div class="container">
        <div class="row gy gx justify-content-center">
            <div class="col-lg-6 col-md-10 col-12">
                <div class="sticky-sidebar gap-md gap-sm--lg transparent over-header md">
                    <h1 class="page-title text-center">تایید حساب کاربری</h1>
                    <div class="content">

                        <div class="card">
                            <div class="card-body flex-column align-items-stretch">
                                <p class="text-warning">کاربر گرامی جهت استفاده از خدمات باید اطلاعات حساب کاربری خود را
                                    تایید کنید.</p>

                                @if(in_array('mobile', $verificationFields))
                                    @include('sdk.auth._partials._verify-mobile')
                                @endif

                                @if(in_array('email', $verificationFields))
                                    @include('sdk.auth._partials._verify-email')
                                @endif

                            </div>
                            <div class="footer d-flex">
                                <div class="me-auto">
                                    <a href="{{ route('auth.logout') }}" class="sm btn danger">
                                        <i class="icon si-sign-out fs-20"></i><span>خروج از سایت</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('_common.scripts.auth')
@endsection