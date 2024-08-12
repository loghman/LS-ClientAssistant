<!doctype html>
<html lang="fa">
<head>
    <title><?=$course['title']?></title>
    @include('sdk.pages.landing-partials.head')
    @include('sdk.pwa._partials.styles')
<style>
    button:hover, .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .card-product .title{
        font-size: 22px;
        padding-bottom: 8px;
    }
    .progress {
        text-align: center;
        font-size: 11px;
        padding-left: 11px;
        line-height: 20px;
        height: 20px;
        margin-left: 15px;
        width: 100%;
    }

    .progress span {
        z-index: 99999;
        position: absolute;
        text-align: center;
        color: var(--primary-50);
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

    .accordions .accordion .header .picon {
        font-size: 20px;
    }
    .picon.completed {
        color:var(--primary);
    }

    .accordions .accordion .header .time{
        font-size: 11px;
        font-weight: 300;
        opacity: 0.7;
    }
    .accordions .accordion .header {
        background: none !important;
        gap: 7px;
    }
    .accordions .accordion .header:after {
        margin-right: 10px;
        font-size: 12px;
    }

    .accordions .accordion .content{
        padding: 0 !important;
    }

    .accordions{
        margin-top: 10px;
    }

    .accordions .accordion {
        border: 1px solid var(--primary-10) !important;
        border-radius: 5px;
        border-top-right-radius: 5px !important;
        border-top-left-radius: 5px !important;
        padding: 0 12px;
        background-color: var(--primary-1);
        margin-bottom: 5px;
    }

    .accordions .accordion.expanded {
        z-index: 1;
        border-color: var(--primary) !important;
        background: var(--primary-5);
    }

    .loader {

        width: 48px;
        height: 48px;
        border: 3px dotted #777;
        border-style: solid solid dotted dotted;
        border-radius: 50%;
        display: block;
        margin: 20px auto;
        position: relative;
        box-sizing: border-box;
        animation: rotation 2s linear infinite;
    }

    .loader::after {
        content: '';
        box-sizing: border-box;
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        border: 3px dotted var(--primary);
        border-style: solid solid dotted;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        animation: rotationBack 1s linear infinite;
        transform-origin: center center;
    }

    @keyframes rotation {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes rotationBack {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(-360deg);
        }
    }
    .accordions .accordion .content {
        background: none !important;
    }

    .playerbox{
        max-width: 100%;
        position: relative;
        width: 100%;
        padding-top: 56.25%; 
        height: 0;
        overflow: hidden;
        z-index: 5;
    }
    
    .playerbox::after {
        content: 'کمی صبر کنید ...'; 
        position: absolute;
        top: 50%;
        left: 50%;
        color:var(--primary-70);
        font-size: 18px;
        transform: translate(-50%, -50%);
    }

    .playerbox iframe,.playerbox video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: 50;
        border-radius: 10px;
    } 


    .signal-box {
        display: flex;
        background: var(--primary-20);
        padding: 30px 15px 12px 15px;
        margin: -20px 0 0 0;
        font-size: 14px;
        border-radius: 15px;
    }
    @media (max-width:640px){
        .signal-box {
            display: block;
            text-align: center;
        }
        .signal-box>* {
            width: 100%;
        }
    }

    .signal-box button {
        padding: 0px 20px;
        border-radius: 30px;
        font-size: 14px;
    }    
    
    a.atlink i{
        font-style: normal;
    }
    a.atlink {
        display: flex;
        background: #fff;
        border: 1px solid var(--primary-10);
        border-radius: 5px;
        margin-bottom: 2px;
        padding: 5px 15px;
        font-size: 14px;
    }

    .desc {
        font-size: 14px;
        line-height: 28px;
        text-align: justify;
        margin: 20px 0;
        background-size: 
    }
    .bghead{
        min-height: 100%;
        background-size: cover !important;
        background: linear-gradient(45deg, var(--primary-50), rgb(255 255 255 / 70%)), url(<?= $course['banner_url'] ?>);
    }
    </style>
</head>

<body>
    <div class="base-content">
        <div class="navbar shadow">
            <a href="{{ site_url('') }}" class="brand">
                <img src="{{ $data['logo_url'] }}" alt="{{ $data['brand_name'] }}">
            </a>
            <a class="btn primary sm" href="{{site_url('pwa/my-courses')}}">
               همه دوره های من
                <i class="i-left" style="font-size: 10px;"></i>
            </a>
        </div>

        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div class="card-product">
                <span class="content">
                    {{-- <img loading="lazy" style="height: 80px;" src="" alt="تصویر دوره"> --}}
                    <span class="text">
                        <span class="title"><?=$course['title']?></span>
                        <span class="content">
                            <small class="subtitle">{{ to_persian_num(count($chapters)) }} سرفصل، {{ to_persian_num($course['items_count']) }} جلسه</small>
                            
                        </span>
                    </span>
                </span>
            </div>
        </div>
        <div class="content">
            <div class="progress me-auto" style="--w: <?=$enrollment['progress_percent']?>%"><span><?=to_persian_num($enrollment['progress_percent'])?>٪</span></div>

            @foreach($chapters as $ii => $ch)
            <div class="accordions" >
                @if(count($chapters) > 1)
                <div class="fw-700 truncate"><?= "<span class='fasl'>فصل " . to_persian_num($ii+1) . ":</span> " . $ch['title']?></div>
                @endif
                <?php $si=1;?>
                @foreach($ch['items'] as $item)
                <div class="accordion empty <?=($item['id'] == $_GET['i']??'*') ? 'default' : ''?>" data-iid="<?=$item['id']?>" data-pid="<?=$item['product_id']?>"
                data-chid="<?=$item['parent_id']?>" data-t="<?=$item['log_type']?>">
                    <div class="header py-sm" id='<?=$item['id']?>'>
                        <span class="picon i-play-circle-fill <?=$item['log_type']?>"></span>
                        <span class="title sm">
                            @if($course['items_count'] > 2)
                            <b>جلسه <?=to_persian_num($si++)?> :</b> 
                            @endif
                        <?=$item['title']?></span>
                        <span class="time me-auto"><?=($item['attachment_duration_sum']) ? to_persian_num(round($item['attachment_duration_sum']/60)) . ' دقیقه' : '' ?></span>
                    </div>
                    <div class="content">
                        <span class="loader"></span>
                    </div>
                    <!-- <div class="card-status m-0 shadow-0 p-0">
                        <span class="fw-700">این جلسه رو کامل دیدی ؟</span>
                        <a href="#" class="btn xs success me-auto">بله</a>
                    </div> -->
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

    </div>
    @include('sdk.pwa._partials.bottom-nav')

    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages');

<script>
    function getQueryParam(key) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        return urlParams.get(key);
    }

    function goScrollTo(element, offset = 5,expand = 0){
        var headerOffset = 5;
        var elementPosition = element.getBoundingClientRect().top;
        var offsetPosition = elementPosition + window.pageYOffset - headerOffset;
        window.scrollTo({top: offsetPosition, behavior: "smooth"});
        setTimeout(function() {
            element.click();
            if(expand == 1)
                element.classList.add("expanded")
        }, 200);
    }

    document.addEventListener('DOMContentLoaded', function() {

        function sendAjaxRequest(event) {
            event.preventDefault();
            var element = event.target.closest('.accordion.empty');            
            var iid = element.getAttribute('data-iid');
            var pid = element.getAttribute('data-pid');
            var chid = element.getAttribute('data-chid');
            var log_type = element.getAttribute('data-t');

            var url = '<?=site_url('ajax/item')?>';
            var params = 'iid=' + encodeURIComponent(iid) + '&pid=' + encodeURIComponent(pid) +  '&chid=' + encodeURIComponent(chid) + '&log_type=' + encodeURIComponent(log_type);

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var contentElement = element.querySelector('.content');
                    if (contentElement) {
                        contentElement.innerHTML = xhr.responseText;
                        visitSignalRequest(iid,'visited');
                        element.classList.remove('empty');
                    }
                }
            };
            xhr.send();
        }

        // just single video in playing 
        document.addEventListener('play', function(e){
            var videos = document.getElementsByTagName('video');
            for(var i = 0; i < videos.length; i++) {
                if(videos[i] != e.target) {
                    videos[i].pause();
                }
            }
        }, true);
        document.addEventListener('DOMContentLoaded', function() {
            var videos = document.getElementsByTagName('video');
            for(var i = 0; i < videos.length; i++) {
                videos[i].addEventListener('click', function() {
                    if (this.paused) {
                        this.play();
                    } else {
                        this.pause();
                    }
                });
            }
        });


        var accordionElements = document.querySelectorAll('.accordion .header');
        accordionElements.forEach(function(element) {
            element.addEventListener('click', sendAjaxRequest);
        });
        
        if(accordionElements.length == 1){
            let element = accordionElements[0];
            element.scrollIntoView({ behavior: 'smooth' });
            goScrollTo(element,5,1);
        }

        qp = getQueryParam('i');
        if(qp){
            let element = document.getElementById(qp);
            element.scrollIntoView({ behavior: 'smooth' });
            goScrollTo(element,5,1);
        }

    });

    function signalRequest(element,type) {
        var itemId = element.getAttribute('data-iid');
        var url = '<?=site_url('ajax/item/signal')?>';
        var params = 'itemId=' + encodeURIComponent(itemId) + '&type=' + encodeURIComponent(type);
        element.innerHTML = 'در حال ثبت ...';

        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + params, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                element.innerHTML = xhr.responseText;
                if(!xhr.responseText.includes('خطا'))
                    setTimeout(function() {element.closest('.signal-box').style.display = 'none';},700)
            }
        };
        xhr.send();
    }

    function visitSignalRequest(iid,type) {
        var url = '<?=site_url('ajax/item/signal')?>';
        var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + params, true);
        xhr.onreadystatechange = function() {
            console.log(xhr.responseText);
        };
        xhr.send();
    }


</script>

</body>

</html>
