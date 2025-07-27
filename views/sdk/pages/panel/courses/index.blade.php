@section('title', 'دوره‌های من')
        <!doctype html>
<html lang="fa">
<head>
    @include('sdk.pages.landing-partials.head')
</head>
<body>
<div class="base-content">
    <div class="navbar">
        <a href="{{ site_url('') }}" class="brand">
            <img src="{{ $brandLogoUrl }}" alt="{{ $brandNameEn }}">
        </a>
    </div>
    <div class="card-status">
        <span class="title">دوره‌های من</span>
        <small class="subtitle">۱۲ دوره خریداری شده</small>
    </div>
    <div class="card-product-parent">
        @php
            $enrollments = [
                [
                "جاواسکریپت",
                "1.svg",
                "#F0DB4F"
            ],[
                "فلاتر",
                "2.svg",
                "#47C5FB"
            ],[
                "اندروید",
                "3.svg",
                "#3DDC84"
            ],[
                "پی اچ پی",
                "4.svg",
                "#474A8A"
            ],[
                "پایتون",
                "5.svg",
                "#4B8BBE"
            ],
];
        @endphp
        @foreach($enrollments as $enrollment)
            <a href="{{ route('panel.course') }}" class="card-product">
                        <span class="content">
                            <span class="icon" style="--icon: url({{ core_asset('resources/assets/img/demo/language/'.$enrollment[1]) }});--bg: {{ $enrollment[2] }}"></span>
                            <span class="text">
                                <span class="title">{{ $enrollment[0] }}</span>
                                <span class="content">
                                    <small class="subtitle">{{ to_persian_num(rand(12,100)) }} جلسه، {{ to_persian_num(rand(1,30)) }} ساعت</small>
                                    <span class="progress me-auto" style="width: 60px;--w: {{ rand(1,100).'%' }}"></span>
                                </span>
                            </span>
                        </span>
            </a>
        @endforeach
    </div>

</div>
<script type="module"  src="{{ getViteAssetUrl('resources/js/utilities/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
</body>
</html>