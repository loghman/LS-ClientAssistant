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
        <div class="video-wrapper">
            <div class="video-overlay">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/play-btn.svg') }}" class="playVideo" width="50" height="50" alt="play">
            </div>
            <video src="{{ $product['meta']['intro_video']['url']  ?? ''}}" ></video>
        </div>
        <h5>{{ $product['meta']['intro_video']['title']  ?? '' }}</h5>
        <p>{{ $product['meta']['slogan'] ?? '' }}</p>
    </section>
</div>
<div class="buttons">
    <a  class="btn primary-btn">
        <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}" class="arrow-right" width="20" height="20" alt="arrow">
        پرداخت
    </a>
    <div class="steps">
        {{ to_persian_price($product['price']['main']) }}
    </div>
</div>
<footer>
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/js/clients/mini-landing/scripts.js') }}"></script>
</footer>

</body>

</html>