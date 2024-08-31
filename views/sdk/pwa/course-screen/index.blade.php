<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
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
        font-size: 18px;
    }

    .completed .picon {
        color:var(--primary);
    }

    .accordions .accordion .header .time{
        font-size: 11px;
        font-weight: 300;
        opacity: 0.7;
    }
    .accordions .accordion .header .copy{
        font-size: 11px;
        opacity: 0.5;
        padding: 7px 7px 7px 3px;
    }
    .accordions .accordion .header .copy:hover{
        opacity: 1;
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
        border: 1px solid #e7e7e7 !important;
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
        padding: 0 12px 15px 12px;
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
        border-radius: 10px; 
        font-size: 14px;
    }    
    .attachments{
        padding: 10px 0;
    }

    a.atlink i{
        font-style: normal;
    }
    a.atlink {
        display: flex;
        background: #fff;
        border: 1px solid var(--primary-10);
        border-radius: 5px;
        margin: 5px auto;
        padding: 5px 15px;
        font-size: 14px;
    }
    a.atlink .size {
        font-size: 9px; 
    }

    .bghead{
        position: relative;
        min-height: 100%;
        padding-top: 90px !important;
        padding-bottom: 20px !important;
        background-size: cover !important;
        background: linear-gradient(0deg, var(--primary-50), rgba(0,0,0,0.4)), url(<?= $course['banner_url'] ?>);
    }
    .bghead .pbar{
        position: absolute;
        top:20px;
        left:20px;
    }
    </style>
</head>

<body>
    <div class="base-content">
        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div>
                <span class="content">
                    <span class="text">
                        <span class="title" style="font-size: 24px;"><?=$course['title']?></span><br>
                        <span class="content">
                            <small class="subtitle">{{ to_persian_num(count($course['chapters'])) }} سرفصل، {{ to_persian_num($course['items_count']) }} جلسه</small>
                        </span>
                        <span class="pbar" id="pbar"></span>
                    </span>
                </span>
            </div>
        </div>
        <div class="content">
            @if($course['items_count'] > 15)
            <div class="findwrap">
                <input id="find" data-group=".accordions" data-parent=".accordion" data-content=".accordion .title span" type="text" onfocus="goScrollTo(this,15);" placeholder="جستجو در جلسات" >
                <small id="findStat"></small>
            </div>
            @endif
            <div class="chapters">
            @foreach($course['chapters'] as $ii => $ch)
            <div class="accordions" >
                @if(count($course['chapters']) > 1)
                <div class="fw-700 truncate"><?= "<span class='fasl'>فصل " . to_persian_num($ii+1) . ":</span> " . $ch['title']?></div>
                @endif
                <?php $si=1;?>
                @foreach($ch['items'] as $item)
                <div class="accordion empty <?=$item['log_type']?> <?=($item['id'] == $_GET['i']??'*') ? 'default' : ''?>" data-iid="<?=$item['id']?>" data-pid="<?=$item['product_id']?>"
                data-chid="<?=$item['parent_id']?>" data-t="<?=$item['log_type']?>">
                    <div class="header py-sm" id='<?=$item['id']?>'>
                    
                        <span class="picon fa-solid <?=($item['log_type'] == 'completed') ? 'fa-circle-check' : 'fa-circle-play'?>"></span>
                        <span class="title sm">
                            @if($course['items_count'] > 2)
                            <b>جلسه <?=to_persian_num($si++)?> :</b> 
                            @endif
                            <span><?=$item['title']?></span>
                        </span>
                        <span class="time me-auto"><?=($item['attachment_duration_sum']) ? to_persian_num(round($item['attachment_duration_sum']/60)) . ' دقیقه' : '&nbsp;' ?></span>
                        @if($_GET['links'])
                        <?php $itemLink = site_url("pwa/item/p{$item['product_id']}i{$item['id']}/screen") ?>
                        <i class="copy fa-solid fa-copy" data-copy="<?=$itemLink?>"></i>
                        <a href="<?=$itemLink?>" target="_blank" data-copy="<?=$itemLink?>">
                            <i class="copy fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        @endif
                    </div>
                    <div class="content">
                        <span class="loader"></span>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
            </div>
        </div>

    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages');
    @include('sdk.pwa._partials.scripts')

<script>
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
        
        // expand if single video
        if(accordionElements.length == 1)
            goScrollTo(accordionElements[0],5,1,0);
        

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

    function updateEnrollmentLogs() {
        fetch('https://dev.madamcakes.com/ajax/enrollment/<?=$_GET['e']??'null'?>/logs')
            .then(response => response.json())
            .then(data => {
                if (data.message === "success") {
                    const map = data.data.statuses;
                    Object.keys(map).forEach(key => {
                        const element = document.querySelector(`[data-iid="${key}"]`);
                        if (element && map[key]) 
                            element.classList.add(map[key]);
                        document.getElementById('pbar').innerHTML = circleProgressbar(data.data.progress_percent,'sm','', '','#ccc');
                    });
                }
            });
    }
    updateEnrollmentLogs();


</script>

</body>

</html>
