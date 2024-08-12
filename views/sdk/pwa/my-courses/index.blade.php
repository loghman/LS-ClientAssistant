@section('title', 'دوره‌های من')
        <!doctype html>
<html lang="fa">
<head>
    @include('sdk.pages.landing-partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        button:hover, .btn:hover {
            opacity: 0.8;
            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }
        .card-product {
            border: 1px solid var(--primary) !important;
            border-radius: 10px;
            margin: 7px 2%;
            width: 96%;
        }
        .progress{
            text-align: center;
            font-size: 9px;
            padding-left: 11px;
            line-height: 13px;
        }
        .progress span{
            z-index: 99999;
            position: absolute;
            text-align: center;
            color:var(--primary-50);
        }
        .cpbadge{
            background-color: var(--primary-15);
            color: var(--primary);
            padding: 3px 7px;
            font-size: 10px;
            margin-right: 5px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
<div class="base-content">
    <div class="navbar">
        <a href="{{ site_url('') }}" class="brand">
            <img src="{{ $data['logo_url'] }}" alt="{{ $data['brand_name'] }}">
        </a>
    </div>
    <div class="card-status">
        <span class="title">دوره‌های من</span>
        <small class="subtitle"><?=to_persian_num(count($courses))?> دوره خرید شده</small>
    </div>
    
    <div class="card-product-parent">
        @if(count($courses))
            @foreach($courses as $e)
                <?php 
                    $title = str_replace('','',$e['product']['title']);
                    $progress = $e['progress_percent'];
                ?>
                <a href="<?=site_url("pwa/course-{$e['product']['id']}/player")?>?e={{$e['id']}}" class="card-product">
                    <span class="content">
                        <span class="icon " style="--bg: var(--primary)">
                            @if($progress >=100)
                            <span class="i-check-circle number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 32px;"></span>
                            @else
                            <span class="i-play-fill number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 20px;"></span>
                            @endif
                        </span>
                        <span class="text">
                            <span class="title"><?=$title?></span>
                            <span class="content">
                                <small class="subtitle"><?=to_persian_num($e['product']['items_count'])?> جلسه<?= ($progress>=100) ? ' <span class="cpbadge">کامل دیده اید</span>' :''; ?></small>
                                <span class="progress me-auto" style="width: 100px;height:13px;--w: <?=$progress?>%"><span><?=to_persian_num($progress)?>٪</span></span>
                            </span>
                        </span>
                    </span>
                </a>
            @endforeach
        @else
            <div class="text-center" style="margin-top:50px">
                شما هنوز در هیچ دوره ای ثبت نام نکرده اید
            </div>
            <div class="text-center" style="margin-top:20px">
                <button class="button primary sm" style="padding:5px 40px" onclick="location.href='{{site_url('courses')}}#start-courses'">مشاهده لیست دوره ها</button>
            </div>
        @endif


    </div>

</div>
@include('sdk.pwa._partials.bottom-nav')
<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')

</body>
</html>