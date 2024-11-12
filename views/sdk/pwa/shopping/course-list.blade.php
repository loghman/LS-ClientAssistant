<?php 
$count = count($courses??[]); 
$defaultThumb = "https://up.7learn.com/1/course.jpg";
?>
<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
<style>
    .course-card{
        height: 0;
        padding: 0;
        padding-bottom: 56.5%;
        position: relative;
        margin-bottom: 15px;
    }
    .course-card .content{
        width: 100%;
        position: absolute;
        bottom: 10%;
        text-align: center;
        padding:0 15px 0 15px !important;
    }

    @media screen and (min-width:900px) {
        .clist{
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .course-card{
            width: 48%;
            height: 0;
            padding: 0;
            padding-bottom: 27%;
            display: block;
        }
    }
</style>
</head>
@include('sdk.pwa._partials.sidebar-desktop')
<body>
<div class="base-content wpad">
    @include('sdk.pwa._partials.top-nav')
    @if($count>10)
    <div class="findwrap">
        <input id="find" data-parent=".card-product" data-content=".card-product .title" type="text" placeholder="جستجو در دوره ها" >
        <small id="findStat"></small>
    </div>
    @endif
    <div class="card-product-parent">
        <div class="title-row">
            <span class="title">لیست دوره ها</span>
            <span class="stat"><?=to_persian_num($count)?> دوره</span>
        </div>
        <div class="clist">
        @if($count)
            @foreach($courses as $crs)
                <?php 
                    if($crs['dont_list']) continue;
                    $title = str_replace('','',$crs['title']);
                    $thumb = $crs['banner']['url'] ?? '';
                    if (!preg_match('/' . implode('|', ['.jpg','.png','.webp']) . '/', $thumb)) 
                        $thumb = $defaultThumb;
                ?>
                <a href="<?=site_url("pwa/course/{$crs['slug']}")?>" class="card-product course-card" 
                    style="background-image: linear-gradient(0deg, #000,rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%),url(<?=$thumb?>);">
                    <span class="content">
                        <span class="text">
                            <span class="title" style="font-size: 24px;color:#fff;"><?=str_replace('دوره ','',strtok($title,'('))?></span>
                            <small class="subtitle" style="font-size: 14px;color:#aaa;margin-top:5px">
                                @if($crs['price']['main'] == 0)
                                    <span>رایگان</span>
                                @elseif($crs['price']['main'] == $crs['final_price']['main'])
                                    <span><?=to_persian_num($crs['price']['readable'])?> تومان</span>
                                @else
                                    <del style="margin-left: 20px"><?=to_persian_num($crs['price']['readable'])?> تومان</del> <span><?=to_persian_num($crs['final_price']['readable'])?> تومان</span>
                                @endif
                            </small>
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