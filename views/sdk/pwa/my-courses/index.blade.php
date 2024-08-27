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
            <span class="stat"><?=to_persian_num(count($enrollments))?> دوره</span>
        </div>
        @if(count($enrollments))
            @foreach($enrollments as $e)
                <?php 
                    $product = $e['entity'];
                    $title = str_replace('','',$product['title']);
                    $progress = $e['progress_percent'];
                ?>
                <a href="<?=site_url("pwa/course-{$product['id']}/screen")?>?e={{$e['id']}}" class="card-product"
                style="padding:20px 20px 20px 12px;border:0 !important;background: linear-gradient(240deg, var(--primary-50), rgba(0,0,0,0.5)), url(<?=$product['banner_url']['medium']['url']?>);">
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
    <div class="h200"></div>

</div>
@include('sdk.pwa._partials.bottom-nav')
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