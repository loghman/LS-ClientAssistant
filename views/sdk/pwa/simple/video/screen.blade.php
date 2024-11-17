<!doctype html>
<html lang="fa">
<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    @include('sdk.pwa.simple.video._partials.styles')
    <style>
        .overlay .erow span{
            font-size: 15px;
            font-weight: 400;
            text-align: justify;
        }
        .overlay .icheck{
            color:#999;
            vertical-align: middle;
            margin-left: 3px;
        }
        .overlay .qbtn{
            margin-top: 15px;
            padding: 5px 36px;
        }
    </style>
</head>

<body>
    <div class="base-content">
        <div class="card-status bghead m-0 shadow-inset pt pb" style="padding-top: 0 !important;">
            <div class="text w-100 text-center">
                <img src="<?=$data['logo_url']?>" style="max-height: 40px;"><br>
                <span class="title" style="font-size: 24px;">عنوان دوره اینجا</span><br>
                <small class="subtitle">عنوان سرفصل اینجا</small>
            </div>
        </div>
        <div class="content" style="margin-top: -100px;">
            <div class="chapters">
                <div class="accordions">
                    <div class="accordion expanded" data-iid="{item-id}" data-pid="{puct-id}">
                        <div class="header py-sm expanded" id="{item-id}">
                            <span class="picon fa-solid fa-circle-play"></span>
                            <span class="title sm" style="font-weight: 500;">
                                <span>عنوان جلسه اینجا</span>
                            </span>
                            <span class="time me-auto">۱۲ دقیقه</span>
                        </div>
                        <div class="content">
                            <div class="playerbox">
                                <video id="itemPlayer" controls="" autoplay="" class="w-100 base-radius overflow-hidden">
                                    <source src="https://s3.7learn.com/c677195/7learn_rVYO9j7K/jHwGbmgw3VNuyMdT.mp4"
                                        type="video/mp4">
                                </video>
                            </div>
                            <div class="signal-box">
                                <button class="signal-btn me-auto" data-iid="12268" onclick="signalRequest(this,'completed')"><i class="fa-solid fa-circle-check"></i>تماشا کردم</button>
                            </div>
                            <a class="simple-box nextitem" href="<?=site_url('pwa/simple/video/12269/screen')?>">
                                <small><i style="vertical-align: -1px;" class="fa-solid fa-angles-right"></i> جلسه بعدی</small>
                                <span>عنوان جلسه بعدی اینجا</span>
                            </a>
                            <div class="attachments">
                                <a href="{attachment-url-here}" target="_blank" class="atlink">
                                    <span class="title"><b><i class="fa-solid fa-download"></i></b> عنوان فایل اینجا</span>
                                    <span class="size me-auto">۱.۳۵ مگابایت</span>
                                </a>
                            </div>
                            <div class="longtextwrap">
                            <?php
                                $desc = "لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد";
                                $len = strlen($desc);
                            ?>
                                <?php if($len > 3): ?>
                                <div class="longtextwrap" style="margin-top:-20px;padding:0">
                                    <?php if($len > 400): ?>
                                        <div class="longtext"><?= $desc ?></div>
                                        <span class="moretext" onclick="toggleMoreText(event)">ادامه توضیحات ...</span>
                                    <?php else: ?>
                                        <div class="alltext"><?= $desc ?></div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    
                </div>
            </div>
        </div>
    </div>

    @include('sdk.pwa.simple.video._partials.bottom-nav')
    @include('sdk.pwa.simple.video._partials.feedback-overlay')
    <?php
        $questions = [["id"=>1,"second"=>3],["id"=>2,"second"=>7],["id"=>55,"second"=>17]];
    ?>
    @foreach($questions as $question)
        @include('sdk.pwa.simple.video._partials.questions-overlay',compact('question'));
    @endforeach


    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')
    <script>
        // آقای قربانی این کدی که ما نصف و نیمه زدی منظورشو خودت متوجه میشی بدون باگ کار کنه وقتی به ثانیه اوله سوال رسیدیم اول ویدیو را متوقف کنه بعد آورله سوال رو بیاره بالا وقتی هم کاربر سوال رو پاسخ داد و ریسپانس گرفت آورلی رو ببنده و بعد ویدیو رو پخش کنم          
        const video = document.getElementById('itemPlayer');
        function checkTime() {
            const currentTime = Math.floor(video.currentTime);
            console.log(currentTime);
            const questionSeconds = {"1":5,"2":7,"55":17}; // آیدی و ثانیه ویدیو ها رو اینجا ذخیره می کنیم
            for (let key in questionSeconds) {
                if (questionSeconds[key] == currentTime) {
                    video.pause();
                    alert(key);
                    // display overlay
                }
            }
        }
        video.addEventListener('timeupdate', checkTime);
    </script>


    <script>
        // send video visit, play, and completion signals 
        function signalRequest(element, type) {
            var itemId = element.getAttribute('data-iid');
            var url = '<?=site_url('ajax/item/signal')?>'; // change routes here
            var params = 'itemId=' + encodeURIComponent(itemId) + '&type=' + encodeURIComponent(type);
            element.innerHTML = 'در حال ثبت ...';

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    element.innerHTML = xhr.responseText;
                    if (!xhr.responseText.includes('خطا'))
                        setTimeout(function () { element.closest('.signal-box').style.display = 'none'; }, 700)
                }
            };
            xhr.send();
        }

        function visitSignalRequest(iid, type) {
            var url = '<?=site_url('ajax/item/signal')?>';
            var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);
            xhr.onreadystatechange = function () {
                console.log(xhr.responseText);
            };
            xhr.send();
        }
    </script>

</body>

</html>