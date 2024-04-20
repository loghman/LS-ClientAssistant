@extends('sdk._common.layouts.base')
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
            <div class="col-lg-8 col-md-10 col-12">
                <div class="sticky-sidebar gap-md gap-sm--lg transparent over-header md">
                    <h1 class="page-title text-center">تایید حساب کاربری</h1>
                    <div class="content">

                        <div class="card p-xs--sm">
                            <div class="card-body flex-column align-items-stretch">
                                <p class="alert bg-warning-15 lh-2" style="color: #b17a21 !important">برای فعالسازی اکانت و اطلاع رسانی های آینده لازم است شماره موبایل خود را تایید نمایید.</p>

                                @if(in_array('mobile', $verificationFields))
                                    @include('sdk.auth._partials._verify-mobile')
                                @endif

                                @if(in_array('email', $verificationFields))
                                    @include('sdk.auth._partials._verify-email')
                                @endif

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