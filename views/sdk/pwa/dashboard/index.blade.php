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
      height: 100%;
      margin-top: 5px;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 200px;
    }
    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
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
        font-size: 40px;
        font-weight: bold;
        color:#eee;
        background-color: #fff !important;
    }
    
</style>
</head>
<body>
<div class="base-content">
    @include('sdk.pwa._partials.top-nav')

    <div class="statboxes wpad">
        <a class="statbox" href="<?=site_url('pwa/my-courses')?>">
            <span><?=to_persian_num(count($courses))?> دوره</span>
            <small>خرید شده</small>
            <i class="fa-solid fa-cart-shopping" style="color:#ebebeb"></i>
        </a>
        <a class="statbox" href="<?=site_url('pwa/profile')?>">
            <span><?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?> روز</span>
            <small>با <?=$data['brand_name']?></small>
            <i class="fa-solid fa-heart" style="color:#ffe0e0"></i>
        </a>
    </div>

<div class="swiper app-slider wpad">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="https://madamcakes.com/assets/img/banners/book1.jpg" alt="">
        </div>
        <div class="swiper-slide">
            <img src="https://madamcakes.com/assets/img/banners/book2.jpg" alt="">
        </div>
        <div class="swiper-slide">
            <img src="https://madamcakes.com/assets/img/banners/book1.jpg" alt="">
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div>
    <div class="title-row wpad tpad10">
        <span class="title">آخرین مشاهدات من</span>
        <a class="stat" href="<?=site_url('pwa/my-courses')?>">دوره های من</a>
    </div>
    <div class="swiper lastseens wpad">
        <div class="swiper-wrapper">
            <div class="swiper-slide">دوره اول</div>
            <div class="swiper-slide">دوره دوم</div>
            <div class="swiper-slide">دوره سوم</div>
        </div>
    </div>


</div>

<div class="h200"></div>
</div>
@include('sdk.pwa._partials.bottom-nav')
<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
<script>
var swiper = new Swiper(".app-slider", {
    // pagination: {
    //     el: ".swiper-pagination",
    //     dynamicBullets: true,
    // },
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      spaceBetween: 30,
      centeredSlides: true,
});
var swiper2 = new Swiper(".lastseens", {
    spaceBetween: 10,
    centeredSlides: true,
});
</script>

</body>
</html>