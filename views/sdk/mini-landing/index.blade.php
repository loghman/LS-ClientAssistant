<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/clients/mini-landing/style.css') }}">
    <title>{{ $product['title'] }}</title>
</head>

<body class="container v2">
<header>
    <a href="{{ site_url('') }}">
        <img src="{{ $product['landing_logo'] }}" width="148" height="36" alt="{{ $brandNameEn }} logo">
    </a>
</header>
<div class="main">
    <section >
        @if(strlen($introVideo) > 0)
        <div class="video-wrapper">
            <div class="video-overlay">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/play-btn.svg') }}"
                     class="playVideo" width="50" height="50" alt="play">
            </div>
            <video src="{{ $introVideo }}" poster="{{$product['banner_url']['main']['url']}}" ></video>
        </div>
        @else
            <img style="max-width: 490px;" src={{$product['banner_url']['main']['url']}} alt={{$product['title']}} />
        @endif
        <h5>{{ $product['title'] }}</h5>
        @if($currentUser)
            <p>{{ $product['meta']['slogan'] ?? '' }}</p>
            <p>طول دوره: {{ $productDuration }}</p>
        @else
            <p>لازم است ابتدا وارد سایت شوید.</p>
        @endif
    </section>
</div>
<div class="buttons">

    @if($currentUser)
        <a class="btn primary-btn" href="{{ route('payment.qPay', ['et' => base64_encode('lms_products'), 'ei' => $product['id'], 'slug' => $product['slug']]) }}">
            <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}"
                 class="arrow-right" width="20" height="20" alt="arrow">
            پرداخت سریع
        </a>
    @else
        <a href="{{ route('auth.index') }}" class="btn primary-btn">
            <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}"
                 class="arrow-right" width="20" height="20" alt="arrow">
            ورود برای پرداخت
        </a>
    @endif
    <div>
        @if($product['price'] === 0)
            <span>رایگان</span>
        @elseif(isset($product['final_price']) && $product['price']['main'] != $product['final_price']['main'])
            <span class="strike danger text-secondary-60 fa-number">{{ round($product['price'] / 1000000, 3) }}</span>
            <span>{{ to_persian_price($product['final_price']['main']) }}</span>
        @else
            <span>{{ to_persian_price($product['price']['main']) }} </span>
        @endif
{{--        {{ to_persian_price($product['price']['main']) }}--}}
    </div>
</div>

<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/js/jss.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/js/clients/mini-landing/scripts.js') }}"></script>
@include('sdk._common.components.error-messages')

</body>

</html>