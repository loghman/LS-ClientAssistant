@extends('_common.layouts.base')
@section('title', 'سبد خرید')
@section('header-class', 'square md center')
@section('base-content-class', 'lg over-header md')
@section('body-class', 'page-checkout')
@section('content')
    <div class="container">
        <div class="row gy-md gy-sm--lg gx justify-content-center">
            <div class="col-12">
                <h1 class="page-title text-center">سبد خرید</h1>
            </div>
            @include('sdk.salesflow.cart._partials._cart-items')
            @if($cart && count($cart['items']) != 0)
                <div class="col-lg-4">
                    <div class="sticky-sidebar gap-md gap-sm--lg transparent">
                        <div class="card p-md p-sm--xl align-items-center text-center">
                            @include('sdk.salesflow.cart._partials._cart-price')
                        </div>
                        @include('sdk.salesflow.cart._partials._cart-coupon')
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('modals')
    @include('sdk._common.components.action-modal')
@endsection
