<body class="container v2">
<header>
    <a href="{{ site_url('') }}">
        <img src="{{ $product['landing_logo'] }}" width="148" height="36" alt="{{ $brandNameEn }} logo">
    </a>
</header>
<div class="main">
    <!--        <section class="middle">-->
    <!--            <p class="padding">-->
    <!--                لورم ایپسوم متن <span>ساختگی</span> با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است-->
    <!--            </p>-->
    <!--            <button id="start" class="btn primary-btn">-->
    <!--                شروع-->
    <!--            </button>-->
    <!--        </section>-->
    {{--    <section class="middle">--}}
    {{--        <img class="img" src="{{ core_asset('resources/assets/img/clients/mini-landing/cover-1.jpg') }}" alt="img cover">--}}
    {{--        <h5>لورم <span>عنوان</span></h5>--}}
    {{--        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم--}}
    {{--            متن--}}
    {{--            ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با--}}
    {{--            تولید--}}
    {{--            سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>--}}
    {{--        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم--}}
    {{--            متن--}}
    {{--            ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با--}}
    {{--            تولید--}}
    {{--            سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>--}}
    {{--    </section>--}}
    <section class="middle">
        <div class="video-wrapper">
            <div class="video-overlay">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/play-btn.svg') }}" class="playVideo" width="50" height="50" alt="play">
            </div>
            <video src="{{ $product['meta']['intro_video']['url'] }}"></video>
        </div>
        <h5>{{ $product['title'] }}</h5>
        <p></p>

    </section>
    <!--        <section style="display: none;">-->
    <!--            <img class="img" src="img/cover-3.jpg" alt="img cover">-->
    <!--            <h5>لورم <span>عنوان</span></h5>-->
    <!--            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم-->
    <!--                متن-->
    <!--                ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با-->
    <!--                تولید-->
    <!--                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>-->
    <!--        </section>-->
    <!--        <section style="display: none;">-->
    <!--            <div class="video-wrapper">-->
    <!--                <div class="video-overlay">-->
    <!--                    <img src="img/play-btn.svg" class="playVideo" width="50" height="50" alt="play">-->
    <!--                </div>-->
    <!--                <video src="video/video.mp4" poster="img/cover-4.jpg"></video>-->
    <!--            </div>-->
    <!--            <h5>لورم <span>عنوان</span></h5>-->
    <!--            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم-->
    <!--                متن-->
    <!--                ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با-->
    <!--                تولید-->
    <!--                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>-->
    <!--        </section>-->
    <!--        <section style="display: none;">-->
    <!--            <img class="img" src="img/cover-5.jpg" alt="img cover">-->
    <!--            <h5>لورم <span>عنوان</span></h5>-->
    <!--            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم-->
    <!--                متن-->
    <!--                ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با-->
    <!--                تولید-->
    <!--                سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>-->
    <!--                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم-->
    <!--                    متن-->
    <!--                    ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. لورم ایپسوم متن ساختگی با-->
    <!--                    تولید-->
    <!--                    سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</p>-->
    <!--        </section>-->
    <!--        <section style="display: none;" class="middle">-->
    <!--            <p class="padding">-->
    <!--                لورم ایپسوم متن <span>ساختگی</span> با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است-->
    <!--            </p>-->
    <!--        </section>-->
</div>
<div class="buttons">
    <button id="nextSlide" class="btn primary-btn">
        <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}" class="arrow-right"
             width="20" height="20" alt="arrow">
        بعد
    </button>
    <div class="steps">
        {{ to_persian_price($product['price']['main']) }}
    </div>
    <!--        <button id="previousSlide" class="btn secondary-btn">-->
    <!--            قبل-->
    <!--            <img src="img/arrow.svg" class="arrow-right" width="20" height="20" alt="arrow">-->
    <!--        </button>-->
</div>