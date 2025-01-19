<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        .statboxes {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .statboxes .statbox {
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

        .statboxes .statbox span {
            font-weight: 600;
        }

        .statboxes .statbox small {
            font-weight: 400;
        }

        .statboxes .statbox i {
            font-size: 50px;
            position: absolute;
            left: 20px;
            top: 15px;
        }

        .swiper {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')
        <div class="base-content">
            @include('sdk.pwa._partials.top-nav')
            @if($posts['featured'] ?? false)
                <div dir="rtl" class="swiper featured tpad bpad lpad rpad lmargin-neg">
                    <div class="swiper-wrapper">
                        @foreach($posts['featured'] as $p)
                            <div class="swiper-slide">
                                <a href="<?=site_url("pwa/blog/{$p['id']}")?>" class="card-type-a">
                                    <div class="overlay">
                                        <span class="title"><?=$p['title']?></span>
                                    </div>
                                    <img class="img" src="<?=$p['thumbnail']['url']?>" alt="">
                                </a>
                            </div>

                        @endforeach
                    </div>
                </div>
            @endif

            <div class="wpad">
                <form class="fnavi findwrap" id="sf">
                    <input id="find" name="keyword" type="text" onfocus="goScrollTo(this,75);"
                        placeholder="جستجو در مقالات">
                    <small class="bnavi inbtn" onclick="document.getElementById('sf').submit()"><i
                            class="fa-solid fa-magnifying-glass"></i></small>
                </form>
                @if(isset($_GET['keyword']))
                    <div class="title-row">
                        <span class="title">نتایج جستجو:</span>
                        <a class="stat" href="<?=site_url('pwa/my-courses')?>"><?=to_persian_num(count($posts['latest']))?>
                            مورد</a>
                    </div>
                @endif
                @if(count($posts['latest']) == 0)
                    <div style="text-align: center;color:#999">
                        هیچ نتیجه ای یافت نشد
                    </div>
                    <div class="content-footer">
                        <a href="<?=site_url('pwa/blog')?>" style="margin: 0 10%;"><i class="fa-solid fa-newspaper"></i>
                            بازگشت به
                            وبلاگ</a>
                    </div>
                @endif
                <div class="latest-posts tpad-half">
                    @foreach($posts['latest'] as $p)
                                                            <?php
                        $title = $p['title'];
                        if (mb_strlen($p['title']) > 35)
                            $title = mb_substr($title, 0, 33) . "...";
                        $thumb1 = $p['thumbnail']['url'] ?? '';
                        if (strlen($thumb1) < 7)
                            $thumb1 = "https://up.7Learn.com/1/default.png";
                        $isSearch = isset($_GET['keyword']);
                        if ($isSearch) {
                            $title = str_replace($_GET['keyword'], "<strong class='smatch'>{$_GET['keyword']}</strong>", $title);
                        }
                                                                                                                                                    ?>
                                                            <a href="<?=site_url("pwa/blog/{$p['id']}")?>" class="bnavi card-micro shadow-sm">
                                                                <div class="img">
                                                                    <div class="thumb-sm bgcover" style="background: url(<?=$thumb1?>);"></div>
                                                                </div>
                                                                <div class="content">
                                                                    <div class="title"><?=to_persian_num($title)?></div>
                                                                    <div class="microtitle">انتشار در: <?=to_persian_date($p['published_at']['main'], "%d %B %Y")?>
                                                                    </div>
                                                                </div>
                                                            </a>
                    @endforeach
                </div>
            </div>

            <div class="h200"></div>
        </div>
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        var swiperLastSeen = new Swiper(".featured", {
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