<?php $count = count($enrollments??[]); ?>
<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
<style>
    @media screen and (min-width:900px) {
        .clist{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .clist .card-product{
            width: 48%;
            height: 0;
            padding: 0;
            padding-bottom: 27%;
            display: block;
            position: relative;
        }
        .clist .card-product .text{
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }
    }
</style>
</head>
<body>
@include('sdk.pwa._partials.sidebar-desktop')
<div class="base-content wpad">
    @include('sdk.pwa._partials.top-nav')
    @if($count>10)
    <div class="findwrap">
        <input id="find" data-parent=".card-product" data-content=".card-product .title" type="text" placeholder="جستجو در دوره های من" >
        <small id="findStat"></small>
    </div>
    @endif
    <div class="card-product-parent">
        <div class="title-row">
            <span class="title">دوره های ثبت نام شده</span>
            <span class="stat"><?=to_persian_num($count)?> دوره</span>
        </div>
        <div class="clist">
        @if(count($enrollments??[]))
            @foreach($enrollments as $e)
                <?php 
                    $product = $e['entity'];
                    $title = str_replace('','',$product['title']);
                    $progress = $e['progress_percent'];

                    $link = site_url("pwa/course-{$product['id']}/screen?e={$e['id']}");
                    $newPanelDomains = ['7learn','shahrbabak'];
                    foreach($newPanelDomains as $domain){
                        if(str_contains(site_url(), $domain)){
                            $link = site_url("pwa/simple/video/{$e['last_seen_item']['item_id']}/screen");
                            continue;
                        }
                    }
                ?>
                <a href="<?=$link?>" class="card-product my-course" style="background: linear-gradient(240deg, #fff, rgba(0,0,0,0.5)), url(<?=$product['banner']['url'] ?? ''?>);">
                    <span class="content">
                        <!-- <span class="icon " style="--bg: var(--primary)">
                            @if($progress >=100)
                            <span class="fa-solid fa-circle-check number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 24px;"></span>
                            @else
                            <span class="fa-solid fa-play number mb-auto" style="z-index: 99;color: var(--primary-15);font-size: 20px;"></span>
                            @endif
                        </span> -->
                        <span class="text">
                            <span class="title" style="font-size: 18px;"><?=$title?></span>
                            <span class="content">
                                <small class="subtitle" style="font-size: 11px;color:#555">آخرین مشاهده در <?=to_persian_date($e['last_log_date'], '%d %B %Y')?></small>
                                <!-- <span class="progress me-auto" style="width: 100px;height:13px;--w: <?=$progress?>%"><span><?=to_persian_num($progress)?>٪</span></span> -->
                                <?=circleProgressbar($progress,'sm','me-auto', '','#ccc')?>
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
                <button class="button primary sm" style="padding:5px 40px" onclick="location.href='<?=site_url('pwa/dashboard')?>#start-courses'">بازگشت به داشبورد</button>
            </div>
        @endif
        </div>

    </div>
    <div class="h200"></div>

</div>
@include('sdk.pwa._partials.bottom-nav')
@include('sdk._common.components.error-messages')
@include('sdk.pwa._partials.scripts')

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
