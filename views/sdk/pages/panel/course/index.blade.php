@section('title', 'دوره‌های طراحی رابط کاربری')
<!doctype html>
<html lang="fa">
<head>
    @include('sdk.pages.landing-partials.head')
</head>
<body>
<div class="base-content">
    <div class="navbar shadow">
        <a href="{{ site_url('') }}" class="brand">
            <img src="{{ $brandLogoUrl }}" alt="{{ $brandNameEn }}">
        </a>
        <a class="btn white sm" href="{{ route('panel.courses') }}">
            دوره‌های من
            <i class="i-arrow-left"></i>
        </a>
    </div>
    <div class="card-status m-0 shadow-inset pt pb bg-secondary-3">
        <div class="card-product p-0">
                        <span class="content">
                            <span class="icon" style="--icon: url({{ core_asset('resources/assets/img/demo/language/3.svg') }});--bg: #3DDC84"></span>
                            <span class="text">
                                <span class="title">دوره متخصص اندروید</span>
                                <span class="content">
                                    <small class="subtitle">{{ to_persian_num(rand(12,10)) }} سرفصل، {{ to_persian_num(rand(12,100)) }} جلسه، {{ to_persian_num(rand(1,30)) }} ساعت</small>
                                    <span class="progress me-auto" style="width: 60px;--w: {{ rand(1,100).'%' }}"></span>
                                </span>
                            </span>
                        </span>
        </div>
    </div>
    <div class="content">
        @for($i=0;$i<=rand(1,4);$i++)
        <div class="accordions">
            <span class="fw-700">{{ FAKER('competency_name_fa') }}</span>
            @for($ii=0;$ii<=rand(1,10);$ii++)
                <div class="accordion">
                    <div class="header py-sm">
                        <span class="i-play-fill number mb-auto"></span>
                        <span class="title sm">
                        جلسه {{ to_persian_num($ii+1) }}: {{ FAKER('lesson') }}
                    </span>
                    </div>
                    <div class="content">
                        <video controls="" class="w-100 base-radius overflow-hidden">
                            <source src="https://up.7learn.com/z/s/2024/03/vid-20240320-222117-298-7TVQ.mp4" type="video/mp4">
                        </video>
                        <div class="card-status m-0 shadow-0 p-0">
                            <span class="fw-700">این جلسه رو کامل دیدی ؟</span>
                            <a href="#" class="btn xs success me-auto">بله</a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        @endfor
    </div>

</div>
<script type="module" src="{{ core_asset('resources/assets/js/plugins/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
</body>
</html>
