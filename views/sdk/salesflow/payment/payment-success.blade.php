@extends('sdk._common.layouts.base')
@php($word = $payment['amount'] === 0 ? 'ثبت‌نام' : 'پرداخت')
@section('title', "$word موفق")
@section('body-class', 'bg-success-5')
@push('head')@endpush
@section('header-class', 'square md center success')
@section('header')

@endsection
@section('base-content-class', 'lg')
@section('content')
    <div class="container">
        <div class="row gy gx justify-content-center">
            <div class="col-xxl-5 col-lg-6">
                <div class="sticky-sidebar gap-md gap-sm--lg transparent over-header md">
                    <h1 class="page-title text-center">{{ $word }} موفق</h1>
                    <div class="card padding-md align-items-center text-center">
                        <div class="content">
                            <i class="card-icon si-check-circle-r text-success"></i>
                            <h3 class="card-heading">{{ $message ?? "$word با موفقیت انجام شد" }}</h3>
                        </div>
                        <div class="footer justify-content-center">
                            <a href="{{ route('panel.course.list') }}" class="btn success">مشاهده دوره ها</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')@endsection
@section('footer')@endsection
