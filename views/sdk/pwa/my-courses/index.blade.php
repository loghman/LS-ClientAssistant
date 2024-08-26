<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
</head>
<body>
<div class="base-content">
    @include('sdk.pwa._partials.top-nav')

    <div class="card-product-parent wpad">
        <div class="title-row">
            <span class="title">دوره های ثبت نام شده</span>
            <span class="stat"><?=to_persian_num(count($courses))?> دوره</span>
        </div>
        @if(count($courses))
            @foreach($courses as $e)
                <?php 
                    $title = str_replace('','',$e['product']['title']);
                    $progress = $e['progress_percent'];
                ?>
                <a href="<?=site_url("pwa/course-{$e['product']['id']}/screen")?>?e={{$e['id']}}" class="card-product">
                    <span class="content">
                        <span class="icon " style="--bg: var(--primary)">
                            @if($progress >=100)
                            <span class="fa-solid fa-circle-check number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 24px;"></span>
                            @else
                            <span class="fa-solid fa-play number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 20px;"></span>
                            @endif
                        </span>
                        <span class="text">
                            <span class="title"><?=$title?></span>
                            <span class="content">
                                <small class="subtitle"><?=to_persian_num($e['product']['items_count'])?> جلسه<?php // ($progress>=100) ? ' <span class="cpbadge">کامل دیده اید</span>' :''; ?></small>
                                <!-- <span class="progress me-auto" style="width: 100px;height:13px;--w: <?=$progress?>%"><span><?=to_persian_num($progress)?>٪</span></span> -->
                                <?=circleProgressbar($progress,'sm','me-auto')?>
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
    <div class="h200"></div>

</div>
@include('sdk.pwa._partials.bottom-nav')
<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')

<script>
document.querySelectorAll('.card-product').forEach(function(element) {
    element.addEventListener('click', function(e) {
        document.querySelectorAll('.card-product').forEach(function(el) {
            el.classList.remove('waiting');
            const loader = el.querySelector('.loader');
            if (loader) {
                loader.remove();
            }
        });
        this.classList.add('waiting');
        const loaderSpan = document.createElement('span');
        loaderSpan.className = 'loader';
        this.appendChild(loaderSpan);
    });
});
</script>


</body>
</html>