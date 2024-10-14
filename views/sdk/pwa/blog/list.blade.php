<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
<style>
    .statboxes{
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }
    .statboxes .statbox{
        display: flex;
        position: relative;
        flex-direction: column;
        width: 48%;
        background-color: #fff;
        padding: 10px 20px;
        height: 80px;
        border-radius: 10px;     
        line-height: 30px;   
    }
    .statboxes .statbox span{
        font-weight: 600;
    }
    .statboxes .statbox small{
        font-weight: 400;            
    }
    .statboxes .statbox i{
        font-size: 50px;    
        position: absolute;
        left: 20px;        
        top: 15px;        
    }

    .swiper {
      width: 100%;
      margin-top: 5px;
    }


    .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }
    .swiper-slide img {
        border-radius: 10px;
    }

    .lastseens.swiper {
      height: 200px;
    }
    .lastseens .swiper-slide {
        width: 90% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 20px;
        color:#ffffff;
        font-weight: bold;
        background-size: cover !important;
        align-items: flex-end;
        padding: 0 30px 30px 30px; 
    }

    @media (min-width: 1200px) {
        .lastseens .swiper-slide {
            width: 40% !important;
        }
    }

    
</style>
</head>
<body>
@include('sdk.pwa._partials.sidebar-desktop')
<div class="base-content">
    @include('sdk.pwa._partials.top-nav')
    
    <div>
    @if($posts['featured'] ?? false)
    <div dir="rtl" class="swiper lastseens wpad tpad10">
        <div class="swiper-wrapper">
        @foreach($posts['featured'] as $p)
            <a href="<?=site_url("pwa/blog/{$p['id']}")?>" class="bnavi swiper-slide enroll-slide" style="background: linear-gradient(0deg, #000,rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%), url(<?=$p['thumbnail']['url']?>);"> 
            <!-- <span class="badge-light"><?=$p['main_category']['name_fa']?></span><br> -->
            <span><?=to_persian_num($p['title'])?></span>
            </a>
        @endforeach
        </div>
    </div>
    @endif

    <form class="fnavi findwrap wpad tpad10" id="sf">
        <input id="find" name="keyword" type="text" onfocus="goScrollTo(this,75);" placeholder="جستجو در مقالات" >
        <small class="bnavi inbtn" onclick="document.getElementById('sf').submit()"><i class="fa-solid fa-magnifying-glass"></i></small>
    </form>

    @if($_GET['keyword'])
    <div class="title-row wpad">
        <span class="title">نتایج جستجو:</span>
        <a class="stat" href="<?=site_url('pwa/my-courses')?>"><?=to_persian_num(count($posts['latest']))?> مورد</a>
    </div>
    @endif
    @if(count($posts['latest']) == 0)
    <div style="text-align: center; padding:30px 5px;color:#999">
        هیچ نتیجه ای یافت نشد
    </div>
    <div class="content-footer">
        <a href="<?=site_url('pwa/blog')?>" style="margin: 0 10%;"><i class="fa-solid fa-newspaper"></i> بازگشت به وبلاگ</a>
    </div>
    @endif
    <div class="latest-posts wpad">
        @foreach($posts['latest'] as $p)
            <?php
                $title = $p['title'];
                if(mb_strlen($p['title']) > 35)
                    $title = mb_substr($title,0,33) . "...";
                $thumb1 = $p['thumbnail']['url']??'';
                if(strlen($thumb1) < 7)
                    $thumb1 = "https://up.7Learn.com/1/default.png";
                $isSearch = isset($_GET['keyword']);
                if($isSearch){
                    $title = str_replace($_GET['keyword'],"<strong class='smatch'>{$_GET['keyword']}</strong>",$title);
                }
            ?> 
            <a href="<?=site_url("pwa/blog/{$p['id']}")?>" class="bnavi card-post shadow-sm"> 
            <div class="thumb-sm bgcover right" style="background: url(<?=$thumb1?>);"></div>
            <div>
            <div class="ptitle"><?=to_persian_num($title)?></div>
            <div class="pdate">انتشار در: <?=to_persian_date($p['published_at']['main'],"%d %B %Y")?></div>
            </div>
            </a>
        @endforeach
    </div>

</div>
<div class="h200"></div>

</div>
@include('sdk.pwa._partials.bottom-nav')
@include('sdk._common.components.error-messages')
@include('sdk.pwa._partials.scripts')

<script>
new Swiper(".lastseens", {
    slidesPerView: "auto",
    spaceBetween: 15,
    cssMode:true
});
</script>

</body>
</html>