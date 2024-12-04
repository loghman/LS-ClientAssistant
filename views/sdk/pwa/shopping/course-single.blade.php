<?php
$defaultThumb = 'https://up.7learn.com/1/course.jpg';
$thumb = $course['banner']['url'] ?? '';
if (!preg_match('/' . implode('|', ['.jpg','.png','.webp']) . '/', $thumb)) 
    $thumb = $defaultThumb;

?>
<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        button:hover,
        .btn:hover {
            opacity: 0.8;
            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .fasl {
            color: var(--primary);
        }

        .truncate {
            width: 320px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .completed .picon {
            color: var(--primary);
        }


        .bghead {
            position: relative;
            height: 0;
            width: 100%;
            padding: 56.25% 0 0 0 !important;
            background-size: cover !important;
            background: linear-gradient(0deg, #000, rgba(0, 0, 0, 0.4) 70%, rgba(0, 0, 0, 0.1) 100%), url(<?= $thumb ?>);
        }

        .bgcaption {
            position: absolute;
            bottom: 15%;
            right: 10%;
        }

        .bgcaption .title {
            color: #ffffff;
            font-size: 24px;
        }

        .bghead .pbar {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .accordions .accordion .header:after {
            margin-right: 0px;
        }

        .accordions {
            margin-top: 5px;
        }

        .content .accordions .accordion .title {
            font-size: 14px !important;
        }

        .accordions .accordion .header {
            padding: 10px 15px !important
        }

        .accordions .accordion .stat {
            font-size: 11px;
            font-weight: 300;
            opacity: 0.7;
            min-width: 40px;
            text-align: left;
        }

        .accordions .accordion ul li {
            margin-right: 5px;
        }

        .content .info {
            margin-bottom: 0;
        }

        h2 {
            font-size: 17px !important;
            font-weight: 600 !important;
            color: #333 !important;
        }

        h3 {
            font-size: 14px !important;
            font-weight: 600 !important;
            color: #333 !important;
        }

        .content ul li {
            margin-right: 20px;
            margin-top: 5px;
            list-style: disc;
        }

        .info {
            margin: 0;
        }

        .info .teacher .text {
            margin-left: 20px;
        }

        .info .teacher {
            gap: 7px !important;
            background: #fff;
            border-radius: 10px;
            height: 48px;
        }

        .info .teacher img {
            margin: 4px;
            border-radius: 10px;
        }

        .stick {
            position: fixed;
            display: flex;
            align-items: center;
            background: var(--primary) !important;
            width: 94%;
            height: 70px;
            flex-direction: row;
            justify-content: space-between;
            bottom: 90px;
            padding: 10px;
            margin: 0 3%;
            border-radius: 5px;
            z-index: 999;
            color: #eee !important;
            ;
            /* box-shadow: 0px -10px 20px rgba(0, 0, 0, 0.1); */
        }
        @media screen and (min-width:900px) {
            @media screen and (min-width: 900px) {
                .stick {
                    width: 48%;
                    left: 20%;
                    padding-right: 20px;
                }
            }
        }

        .stick button,
        .stick button:active,
        .stick button:visited {
            background: #ffffff !important;
            color: var(--primary) !important;
        }

        .stick .stat {
            line-height: 25px;
        }

        #payOptions{
            margin:100px 0 200px 0;
            background: #ffffff;
            padding: 20px 10px 40px 10px;
            border-radius: 10px;
            border: 5px solid var(--primary-50);
            display: flex;
            flex-direction: column;
            align-items: stretch;
            width: 100%;
        }
        #payOptions>span.title{
            font-size: 16px;
            font-weight: 600;
        }
        #payOptions .toggle-icon {
            display: none;
        }

        #payOptions  a {
            padding: 0 !important;
            border-radius: var(--base-radius);
            padding: var(--base-gutter);
            padding-left: calc(var(--base-gutter)* 1.5);
            border: solid 1px var(--primary-20);
            background: var(--primary-10);
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        #payOptions  a:hover {
            background: var(--primary-20);
        }

        #payOptions a .text{
            display: block;
        }
        #payOptions a .gateway{
            text-align: center;
        }

    @media screen and (min-width:800px) {
        #payOptions a {
            width:70%;
            margin: 10px auto;
        }
        #stickybar{
            display:none !important;
        }
    }
    .cta-btn{
        padding: 5px 30px !important; 
        margin-top: -3px;
    }
    .gateway-item{
        flex-direction: column;
    }
    .gateway-item .gw-logo{
        width: 100%;
        background: var(--primary-20);
        border-radius: 10px 10px 0 0;
        padding: 5px 20px;
    }
    .gateway-item .gw-logo *{
        display: inline-block;
    }
    .gateway-item .gw-logo img{
        vertical-align: middle;
        width:32px !important;
        height:32px !important;
        margin-left: 5px;
    }
    .gateway-item .gw-desc{
        width: 100%;
        text-align: right !important;
        padding: 10px 20px;
    }
    </style>
</head>

<body>
    @include('sdk.pwa._partials.sidebar-desktop')
    <div class="base-content">
        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div class="bgcaption">
                <span class="content">
                    <span class="text">
                        {{-- <span class="badge-light">پرداخت و ثبت نام سریع</span><br> --}}
                        <span class="title"><?= $course['title'] ?></span><br>
                        @include('sdk.pwa.shopping._partials.priceline',['course'=>$course])
                    </span>
                </span>
            </div>
        </div>
        <div class="content">
            <div class="info">
                @if(!$enrollment)
                <a href="#pay" class="btn cta-btn ms-auto" style="margin-left: 20px">ثبت نام سریع</a>
                @endif
                <div>
                    <span class="title"><?= to_persian_num(count($course['chapters'])) ?></span>
                    <small class="subtitle">سرفصل</small>
                </div>
                <div style="margin-left: 10px">
                    <span class="title"><?= to_persian_num($course['items_count'] - count($course['chapters'])) ?></span>
                    <small class="subtitle">جلسه</small>
                </div>
            </div>
            @if(!$enrollment)

            <div id="description">
                @if (filter_var($course['intro_video']['url'], FILTER_VALIDATE_URL))
                    <video controls autoplay class="w-100 base-radius overflow-hidden">
                        <source src="{{ $course['intro_video']['url'] }}" type="video/mp4" />
                    </video>
                @endif

                <?php
                $desc = planetContentFilter($course['description']['full']);
                $len = strlen($desc);
                ?>
                <?php if($len > 3): ?>
                {{-- <div class="title-row">
                    <span class="title">توضیحات دوره</span>
                </div>             --}}
                <div class="longtextwrap" style="padding:0">
                    <?php if($len > 600): ?>
                    <div class="longtext"><?= $desc ?></div>
                    <span class="moretext" onclick="toggleMoreText(event)">ادامه توضیحات ...</span>
                    <?php else: ?>
                    <div class="alltext"><?= $desc ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="title-row" style="margin-top:40px">
                    <span class="title">سرفصل های دوره</span>
                    <span class="stat"><?= to_persian_num(count($course['chapters'])) ?> فصل</span>
                </div>
                <?php $i = 0;
                $chapterCount = count($course['chapters']); ?>
                @foreach ($course['chapters'] as $ii => $ch)
                    <?php if ($ch['type_en'] != 'chapter' || !$ch['is_published']) {
                        continue;
                    } ?>
                    <div class="accordions">
                        <div class="accordion <?= 0 == $i++ ? '' : '' ?>">
                            <div class="header">
                                <span class="title singline">
                                    @if ($chapterCount == 1)
                                        <span class='fw-700 fasl'><?= $ch['title'] ?></span>
                                    @else
                                        <span class='fw-700 fasl'>فصل <?= to_persian_num($i) ?> : </span>
                                        <?= $ch['title'] ?>
                                    @endif
                                </span>
                                <span class="stat me-auto"><?= to_persian_num(count($ch['items'] ?? '0')) ?> جلسه</span>
                            </div>
                            <div class="content">
                                <ul class="list">
                                    <?php $si = 1; ?>
                                    @foreach ($ch['items'] as $item)
                                        <li>
                                            <span class="title"><?= $item['title'] ?></span>
                                            <span
                                                class="subtitle time"><?= $item['attachment_duration_sum'] ? to_persian_num(round($item['attachment_duration_sum'] / 60)) . ' دقیقه' : '&nbsp;' ?></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="pay"></div> 
            <div id="payOptions"><span class="loader"></span></div>
            @else
            <div style="text-align: center; background: #fff; padding: 40px; border-radius: 10px;">
                <p style="margin-bottom: 10px;">شما قبلا در این دوره ثبت نام کرده اید.</p>
                <p><a class="btn" href="<?=site_url("pwa/course/{$enrollment['entity_id']}/chapters?e={$enrollment['id']}")?>">مشاهده دوره <?=$course['title']?></a></p>
            </div>
            @endif
        </div>
    </div>
    @if(!$enrollment)
    <div class="stick rMaxW" id="stickybar">
        <div class="stat">
            @if ($course['price']['main'] == 0)
                <span>رایگان</span>
            @elseif($course['price']['main'] == $course['final_price']['main'])
                <span><?= to_persian_num($course['price']['readable']) ?> تومان</span>
            @else
                <del style="margin-left: 20px"><?= to_persian_num($course['price']['readable']) ?>
                    تومان</del><br><span><?= to_persian_num($course['final_price']['readable']) ?> تومان</span>
            @endif
        </div>
        <button id="paybtn" class="toggle-btn">
            <?= $course['final_price']['main'] > 0 ? 'پرداخت و ثبت نام' : 'ثبت نام رایگان' ?>
        </button>
    </div>
    @endif

    @include('sdk.pwa._partials.bottom-nav')
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        paybtn = document.getElementById('paybtn');
        payOptions = document.getElementById('payOptions');
        paybtn.addEventListener('click', function() {
            goScrollTo(payOptions);
        });
        document.addEventListener('DOMContentLoaded', function() {
            const payBtn = document.getElementById('paybtn');

            // payBtn.addEventListener('click', function() {
            const slug = "<?=$course['slug']?>";
            const url = "<?=route('landing.mini.payment.details', ['slug' => $course['slug']])?>"; 

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const payOptions = document.getElementById('payOptions');
                    if (payOptions) {
                        payOptions.innerHTML = data.data.html;
                    }
                })
                .catch(error => console.error('Error:', error));
            // });

            const finalPrice = <?=$course['final_price']['main']?>; // این مقدار را با قیمت واقعی کورس جایگزین کنید
            payBtn.textContent = finalPrice > 0 ? 'پرداخت و ثبت نام' : 'ثبت نام رایگان';
        });

    document.addEventListener('DOMContentLoaded', function() {
    var stickyBar = document.getElementById('stickybar');
    var lastScrollPosition = 0;
    var ticking = false;

    function updateStickyBar(scrollPos) {
        var pageHeight = document.documentElement.scrollHeight;
        var viewportHeight = window.innerHeight;
        var bottomThreshold = pageHeight - viewportHeight - 600;

        if (scrollPos > bottomThreshold) {
            stickyBar.style.display = 'none';
        } else {
            stickyBar.style.display = 'flex';
        }
    }

    window.addEventListener('scroll', function(e) {
        lastScrollPosition = window.scrollY;
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateStickyBar(lastScrollPosition);
                ticking = false;
            });
            ticking = true;
        }
    });
});
    </script>

</body>

</html>
