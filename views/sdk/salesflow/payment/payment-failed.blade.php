
@extends('_common.layouts.base')
@section('title', 'پرداخت ناموفق')
@section('body-class', 'bg-danger-5')
@push('head')@endpush
@section('header-class', 'square md center danger')
@section('header')

@endsection
@section('base-content-class', 'lg')
@section('content')
    <div class="container">
        <div class="row gy gx justify-content-center">
            <div class="col-xxl-5 col-lg-6">
                <div class="sticky-sidebar gap-md gap-sm--lg transparent over-header md">
                    <h1 class="page-title text-center">پرداخت ناموفق</h1>
                    <div class="card padding-md align-items-center text-center">
                        <div class="content">
                            <i class="card-icon si-cross-circle-r text-danger"></i>
                            <h3 class="card-heading">فرآیند‍ پرداخت ناموفق بود</h3>
                            <p class="card-subtitle">در صورتی که مبلغی از حساب شما کسر شده, می توانید با پشتیبانی سون لرن تماس بگیرید</p>
                        </div>
                        <div class="footer justify-content-center">
                            <a href="tel:02191094787" class="btn icon lg transparent">
                                <i class="si-phone"></i>
                            </a>
                            <a href="https://t.me/sup_7Learn" class="btn icon lg transparent">
                                <i class="si-telegram"></i>
                            </a>
                            <a href="https://wa.me/989032149377" class="btn icon lg transparent">
                                <i class="si-whatsapp"></i>
                            </a>
                        </div>
                        <div class="footer justify-content-center">
                            <a href="{{ route('payment.requestLink', ['cart' => $cartId]) }}" class="btn success">پرداخت مجدد</a>
                            <a href="{{ route('cart.checkout') }}" class="btn success">بازگشت به سبد</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')@endsection
@section('footer')@endsection
