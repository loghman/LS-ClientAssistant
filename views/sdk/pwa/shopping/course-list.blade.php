<?php 
$count = count($courses ?? []);
$defaultThumb = "https://up.7learn.com/1/course.jpg";
?>
<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        .clist {
            display: flex;
            flex-direction: column;
            gap: calc(var(--base-gap) / 2);
        }

        @media screen and (min-width:900px) {
            .clist {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: calc(var(--base-gap) / 2);
            }
        }
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')
        <div class="base-content">
            @include('sdk.pwa._partials.top-nav')
            <div class="wpad tpad">
                @if($count > 10)
                    <div class="findwrap">
                        <input id="find" data-parent=".card-type-a" data-content=".card-type-a .title" type="text"
                            placeholder="جستجو در دوره ها">
                        <small id="findStat"></small>
                    </div>
                @endif
                <div class="card-product-parent tpad">
                    <div class="title-row bpad-half">
                        <span class="title">یکی از دوره‌های زیر را انتخاب کنید</span>
                        <span class="stat"><?=to_persian_num($count)?> دوره</span>
                    </div>
                    <div class="clist">
                        @if($count)
                                            @foreach($courses as $crs)
                                                                <?php 
                                                                                                                                                                                                                                                                                                                                                                                                        if ($crs['dont_list'])
                                                    continue;
                                                $title = str_replace('', '', $crs['title']);
                                                $thumb = $crs['banner']['url'] ?? '';
                                                if (!preg_match('/' . implode('|', ['.jpg', '.png', '.webp']) . '/', $thumb))
                                                    $thumb = $defaultThumb;
                                                                                                                                                                                                                                                                                                                                                ?>



                                                                <a href="<?=site_url("pwa/course/{$crs['slug']}")?>" class="card-type-a">
                                                                    <div class="overlay">
                                                                        <span class="title"><?=str_replace('دوره ', '', strtok($title, '('))?></span>

                                                                        @include('sdk.pwa.shopping._partials.priceline', ['course' => $crs])
                                                                    </div>
                                                                    <img class="img" src="<?=$thumb?>" alt="<?=str_replace('دوره ', '', strtok($title, '('))?>">
                                                                    <div class="btn hover-show-btn">
                                                                        <i class="far fa-cart-shopping"></i>
                                                                        خرید دوره
                                                                    </div>
                                                                </a>
                                            @endforeach
                        @else
                            <div class="text-center" style="margin-top:50px">
                                شما هنوز در هیچ دوره ای ثبت نام نکرده اید
                            </div>
                            <div class="text-center" style="margin-top:20px">
                                <button class="button primary sm" style="padding:5px 40px"
                                    onclick="location.href='<?=site_url('pwa/dashboard')?>#start-courses'">بازگشت به
                                    داشبورد</button>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="h200"></div>
            </div>
        </div>
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        document.querySelectorAll('.card-type-a').forEach(function (element) {
            element.addEventListener('click', function (e) {
                document.querySelectorAll('.card-card-type-a').forEach(function (el) {
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