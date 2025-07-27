<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        .card-product .title {
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

        .completed .picon {
            color: var(--primary);
        }


        .playerbox {
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
            color: var(--primary-70);
            font-size: 18px;
            transform: translate(-50%, -50%);
        }

        .playerbox iframe,
        .playerbox video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
            z-index: 50;
            border-radius: var(--card-radius);
        }


        .signal-box {
            display: flex;
            background: var(--primary-20);
            padding: 30px 15px 12px 15px;
            margin: -20px 0 0 0;
            font-size: 14px;
            border-radius: var(--card-radius);
        }

        @media (max-width:640px) {
            .signal-box {
                display: block;
                text-align: center;
            }

            .signal-box>* {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')

        <div class="base-content">
            <div class="bghead" style="--bg: url(<?= $course['banner']['url'] ?? '' ?>)">
                <span class="title"><?=$course['title']?></span>
                <span class="stats-row white opacity-50">
                    <span>
                        <i class="fa-regular fa-bars"></i>
                        {{ to_persian_num(count($course['chapters'])) }} سرفصل
                    </span>
                    <span>
                        <i class="fa-regular fa-circle"></i>
                        {{ to_persian_num($course['items_count']) }} جلسه
                    </span>
                </span>
                <span class="pbar" id="pbar"></span>
            </div>
            <div class="wpad tpad bpad">
                @if($course['items_count'] > 15)
                    <div class="findwrap">
                        <input id="find" data-group=".accordions" data-parent=".accordion"
                            data-content=".accordion .title span" type="text" onfocus="goScrollTo(this,15);"
                            placeholder="جستجو در جلسات">
                        <small id="findStat"></small>
                    </div>
                @endif
                <div class="chapters">
                    @foreach($course['chapters'] as $ii => $ch)
                        <div class="accordions">
                            @if(count($course['chapters']) > 1)
                                <div class="fw-700 truncate tpad20">
                                    <?= "<span class='fasl font-base'>فصل " . to_persian_num($ii + 1) . ":</span> " . $ch['title']?>
                                </div>
                            @endif
                            <?php    $si = 1;?>
                            @foreach($ch['items'] as $item)
                                <div class="accordion empty <?=$item['log_type'] ?? ''?> <?=($item['id'] == ($_GET['i'] ?? '*')) ? 'default' : ''?>"
                                    data-iid="<?=$item['id']?>" data-pid="<?=$item['product_id']?>"
                                    data-chid="<?=$item['parent_id']?>" data-t="<?=$item['log_type'] ?? ''?>">
                                    <div class="header py-sm" id='<?=$item['id']?>'>

                                        <span
                                            class="picon fa-solid <?=(($item['log_type'] ?? '') == 'completed') ? 'fa-circle-check' : 'fa-circle-play'?>"></span>
                                        <span class="title">
                                            @if($course['items_count'] > 2)
                                                <span class="bold">جلسه <?=to_persian_num($si++)?> :</span>
                                            @endif
                                            <span><?=$item['title']?></span>
                                        </span>
                                        <span
                                            class="time me-auto"><?=($item['attachment_duration_sum']) ? to_persian_num(round($item['attachment_duration_sum'] / 60)) . ' دقیقه' : '&nbsp;' ?></span>
                                        @if(isset($_GET['links']) and $user['isLmsManager'])
                                            <?php            $itemLink = site_url("pwa/item/p{$item['product_id']}i{$item['id']}/screen") ?>
                                            <span class="copy" data-copy="<?=$itemLink?>">
                                                <i class="fa-solid fa-copy"></i>
                                            </span>
                                            <a class="copy" href="<?=$itemLink?>" target="_blank" data-copy="<?=$itemLink?>">
                                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
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
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module"  src="{{ getViteAssetUrl('resources/js/utilities/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

        function sendAjaxRequest(event) {
            event.preventDefault();
            var element = event.target.closest('.accordion.empty');
            var iid = element?.getAttribute('data-iid');
            var pid = element?.getAttribute('data-pid');
            var chid = element?.getAttribute('data-chid');
            var log_type = element?.getAttribute('data-t');
            var url = '<?=site_url('ajax/item')?>';
            var params = 'iid=' + encodeURIComponent(iid) + '&pid=' + encodeURIComponent(pid) + '&chid=' + encodeURIComponent(chid) + '&log_type=' + encodeURIComponent(log_type);

            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var contentElement = element.querySelector('.content');
                    if (contentElement) {
                        contentElement.innerHTML = xhr.responseText;
                        visitSignalRequest(iid, 'visited');
                        element.classList.remove('empty');
                        // Wait a bit for DOM to settle, then init DRM
                        setTimeout(function() {
                            initDRM();
                        }, 100);
                    }
                }
            };
            xhr.send();
        }

        // just single video in playing 
        document.addEventListener('play', function (e) {
            var videos = document.getElementsByTagName('video');
            for (var i = 0; i < videos.length; i++) {
                if (videos[i] != e.target) {
                    videos[i].pause();
                }
            }
        }, true);
        document.addEventListener('DOMContentLoaded', function () {
            var videos = document.getElementsByTagName('video');
            for (var i = 0; i < videos.length; i++) {
                videos[i].addEventListener('click', function () {
                    if (this.paused) {
                        this.play();
                    } else {
                        this.pause();
                    }
                });
            }
        });
        function initDRM() {
            // Remove all existing DRM elements first
            $(".drm-text").remove();
            
            // Add DRM only to expanded accordions
            $(".accordion.expanded [data-drm-text]").each(function (index, elm) {
                let _elm = $(elm),
                    drmText = _elm.data("drm-text"),
                    options = {
                    time: 5000,
                    styles: {
                        color: "red",
                        fontSize: "14px",
                        fontStyle: "bold",
                        opacity: 0.2,
                        zIndex: 100,
                        position: "absolute",
                        cursor: "default",
                        "-webkit-user-select": "none",
                        "-ms-user-select": "none",
                        "user-select": "none",
                    },
                    };

                _elm.append("<span class='drm-text'>" + drmText + "</span>");
                let drmElm = _elm.find(".drm-text");
                drmElm.css(options.styles);

                setInterval(function () {
                    // Get parent dimensions
                    let parentWidth = _elm.width();
                    let parentHeight = _elm.height();

                    if (parentHeight === 0) {
                    let paddingTop = parseFloat(_elm.css("padding-top")) || 0;
                    let paddingBottom = parseFloat(_elm.css("padding-bottom")) || 0;
                    parentHeight = paddingTop + paddingBottom;
                    }

                    let elemWidth = drmElm.outerWidth();
                    let elemHeight = drmElm.outerHeight();

                    let maxLeft = parentWidth - elemWidth;
                    let maxBottom = parentHeight - elemHeight;

                    let leftPos = Math.random() * Math.max(0, maxLeft);
                    let bottomPos = Math.random() * Math.max(0, maxBottom);

                    drmElm.css({
                    left: leftPos + "px",
                    bottom: bottomPos + "px",
                    });
                }, options.time);
            });
        }
        
        var accordionElements = document.querySelectorAll('.accordion .header');
        accordionElements.forEach(function (element) {
            element.addEventListener('click', function(e) {
                sendAjaxRequest(e);
            document.querySelectorAll('video').forEach(function(elm) {
                    elm.pause();
                })
                setTimeout(function() {
                    initDRM();
                }, 150);
            });
        });

        // expand if single video
        if (accordionElements.length == 1)
            goScrollTo(accordionElements[0], 5, 1, 0);


        qp = getQueryParam('i');
        if (qp) {
            let element = document.getElementById(qp);
            element.scrollIntoView({ behavior: 'smooth' });
            goScrollTo(element, 5, 1);
        }
        
    });

        function signalRequest(element, type) {
            var itemId = element.getAttribute('data-iid');
            var url = '<?=site_url('ajax/item/signal')?>';
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

        function updateEnrollmentLogs() {
            fetch('<?=site_url("ajax/enrollment/" . ($_GET['e'] ?? 'null') . "/logs")?>')
                .then(response => response.json())
                .then(data => {
                    if (data.message === "success") {
                        const map = data.data.statuses;
                        Object.keys(map).forEach(key => {
                            const element = document.querySelector(`[data-iid="${key}"]`);
                            if (element && map[key])
                                element.classList.add(map[key]);
                            document.getElementById('pbar').innerHTML = circleProgressbar(data.data.progress_percent, 'sm', '', '', '#ccc');
                        });
                    }
                });
        }
        updateEnrollmentLogs();    
    </script>

</body>

</html>