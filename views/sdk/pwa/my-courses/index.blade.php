<?php $count = count($enrollments ?? []); ?>
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
                            placeholder="جستجو در دوره های من">
                        <small id="findStat"></small>
                    </div>
                @endif
                <div class="card-product-parent tpad">
                    <div class="title-row bpad-half">
                        <span class="title">دوره های ثبت نام شده</span>
                        <span class="stat"><?=to_persian_num($count)?> دوره</span>
                    </div>
                    <div class="clist">
                        @if(count($enrollments ?? []))
                                            @foreach($enrollments as $e)
                                                                <?php 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    $product = $e['entity'];
        $title = str_replace('', '', $product['title']);
        $progress = $e['progress_percent'];
        $link = enrollmentNextItemUrl($e);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?>


                                                                <a href="<?=$link?>" class="card-type-a">
                                                                    <div class="overlay">
                                                                        <span class="title"><?=$title?></span>

                                                                        <small class="subtitle">آخرین مشاهده در
                                                                            <?=to_persian_date($e['last_log_date'], '%d %B %Y')?></small>
                                                                    </div>
                                                                    <!-- <span class="progress me-auto" style="width: 100px;height:13px;--w: <?=$progress?>%"><span><?=to_persian_num($progress)?>٪</span></span> -->
                                                                    <?=circleProgressbar($progress, 'sm', 'absolute absolute-l', '', '#ccc')?>
                                                                    <img class="img" src="<?=$product['banner']['url'] ?? ''?>" alt="">
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
                document.querySelectorAll('.card-type-a').forEach(function (el) {
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