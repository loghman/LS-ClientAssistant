<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        .statboxes {
            display: flex;
            gap: var(--base-gap);
        }

        .swiper {
            width: 100%;
        }


        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--card-radius);
            position: relative;
        }

        /* .lastseens .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--card-radius);
            font-size: 20px;
            color: #ffffff;
            font-weight: bold;
            background-size: cover !important;
            object-fit: cover;
            align-items: flex-end;
            text-align: center;
            padding: 0 30px 30px 30px;
        } */

        .swiper-pagination {
            text-align: center;
            margin-top: -15px;
        }
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')
        <div class="base-content">
            @include('sdk.pwa._partials.top-nav')

            <div class="statboxes wpad tpad bpad">
                <a class="card-info w-50" href="<?=site_url('pwa/my-courses')?>">
                    <span class="title"><?=to_persian_num(count($enrollments))?> دوره</span>
                    <small class="subtitle">خرید شده</small>
                    <i class="icon fa-solid fa-cart-shopping"></i>
                </a>
                <a class="card-info w-50" href="<?=site_url('pwa/profile')?>">
                    <span
                        class="title"><?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?>
                        روز</span>
                    <small class="subtitle">با <?=$data['brand_name']?></small>
                    <i class="icon fa-solid fa-heart"></i>
                </a>
            </div>

            <?php if (isset($slider)): ?>
            <?php    if (count($slider['banners'])): ?>
            <div class="swiper app-slider wpad">
                <div class="swiper-wrapper">
                    <?php        foreach (array_reverse($slider['banners']) as $banner): ?>
                    <a class="swiper-slide bnavi" href="<?=$banner['link']?>">
                        <img src="<?=$banner['image']['url']?>"
                            alt="<?=isset($banner['image']['original_name']) ? strtok($banner['image']['original_name'], '.') : ''?>">
                    </a>
                    <?php        endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <?php    endif; ?>
            <?php endif; ?>

            <div>
                <div class="title-row wpad tpad bpad-half m-0">
                    <span class="title">آخرین مشاهدات من</span>
                    <a class="stat" href="<?=site_url('pwa/my-courses')?>">دوره های من</a>
                </div>
                <div dir="rtl" class="swiper lastseens rpad lpad lmargin-neg">
                    <div class="swiper-wrapper">
                        @foreach($enrollments as $e)
                            <?php    $product = $e['entity']; ?>
                            <div class="swiper-slide">
                                <a href="<?=enrollmentNextItemUrl($e)?>" class="bnavi card-type-a">
                                    <div class="overlay">
                                        <span class="title"><?=$product['title']?></span>
                                    </div>
                                    <img class="img" src="<?=$product['banner']['url'] ?? ''?>" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="h200"></div>

        </div>
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        var swiperAppSlider = new Swiper(".app-slider", {
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            spaceBetween: 30,
            centeredSlides: true,
            cssMode: true,
            loop: true,
        });

        var swiperLastSeen = new Swiper(".lastseens", {
            spaceBetween: 15,
            slidesPerView: 1,
            breakpoints: {
                0: {
                    slidesPerView: 1.2,
                },
                768: {
                    slidesPerView: 2.25,
                },
            },
        });

    </script>

</body>

</html>