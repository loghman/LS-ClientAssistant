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
        text-align: center;
        padding: 0 30px 30px 30px; 
    }

    .swiper-pagination{
        text-align: center;
        margin-top: -15px;
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

    <div class="statboxes wpad">
        <a class="statbox" href="<?=site_url('pwa/my-courses')?>">
            <span><?=to_persian_num(count($enrollments))?> دوره</span>
            <small>خرید شده</small>
            <i class="fa-solid fa-cart-shopping" style="color:#ebebeb"></i>
        </a>
        <a class="statbox" href="<?=site_url('pwa/profile')?>">
            <span><?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?> روز</span>
            <small>با <?=$data['brand_name']?></small>
            <i class="fa-solid fa-heart" style="color:#ffe0e0"></i>
        </a>
    </div>

<?php if(isset($slider)): ?>
<?php if(count($slider['banners'])): ?>
<div class="swiper app-slider wpad">
    <div class="swiper-wrapper">
        <?php foreach($slider['banners'] as $banner): ?>
            <a class="swiper-slide bnavi" href="<?=$banner['link']?>"> 
                <img src="<?=$banner['image']['url']?>" alt="<?=isset($banner['image']['original_name']) ? strtok($banner['image']['original_name'],'.') : ''?>">
            </a>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>
<?php endif; ?>
<?php endif; ?>

<div>
    <div class="title-row wpad">
        <span class="title">آخرین مشاهدات من</span>
        <a class="stat" href="<?=site_url('pwa/my-courses')?>">دوره های من</a>
    </div>
    <div dir="rtl" class="swiper lastseens wpad">
        <div class="swiper-wrapper">
        @foreach($enrollments as $e)
            <?php $product = $e['entity']; ?>
            <a href="<?=enrollmentNextItemUrl($e)?>" class="bnavi swiper-slide enroll-slide" style="background: linear-gradient(0deg, #000,rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%), url(<?=$product['banner']['url']??''?>);"> 
                <span><?=$product['title']?></span>
            </a>
        @endforeach
        </div>
    </div>

</div>
<div class="h200"></div>

</div>
@include('sdk.pwa._partials.bottom-nav')
@include('sdk._common.components.error-messages')
@include('sdk.pwa._partials.scripts')

<script>
new Swiper(".app-slider", {
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {el: ".swiper-pagination"},
    spaceBetween: 30,
    centeredSlides: true,
    cssMode:true,
    loop:true,

});
new Swiper(".lastseens", {
    slidesPerView: "auto",
    spaceBetween: 15,
    cssMode:true
});

</script>

</body>
</html>
