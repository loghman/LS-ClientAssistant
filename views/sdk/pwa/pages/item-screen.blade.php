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

        .accordions .accordion .header .picon {
            font-size: 18px;
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

        @media (max-width:640px) {
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
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')
        <div class="base-content">
            <div class="bghead without-bg sm">
                <span class="title"><?=$item['title']?></span>
                <div class="stats-row white opacity-50">
                    <span><i class="fa-regular fa-clock"></i>
                        <?=$course['title']?></span>
                </div>
            </div>
            <div class="wpad tpad bpad">
                <div class="chapters">
                    <div class="accordions">
                        <div class="accordion empty" data-iid="<?=$item['id']?>" data-pid="<?=$item['product_id']?>"
                            data-chid="<?=$item['parent_id']?>">
                            <div class="header py-sm" id='<?=$item['id']?>'>
                                <span
                                    class="picon fa-solid <?=($item['log_type'] == 'completed') ? 'fa-circle-check' : 'fa-circle-play'?>"></span>
                                <span class="title sm">
                                    <span><?=$item['title']?></span>
                                </span>
                                <span
                                    class="time me-auto"><?=($item['attachment_duration_sum']) ? to_persian_num(round($item['attachment_duration_sum'] / 60)) . ' دقیقه' : '&nbsp;' ?></span>
                            </div>
                            <div class="content">
                                <span class="loader"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function sendAjaxRequest(event) {
                event.preventDefault();
                var element = event.target.closest('.accordion.empty');
                var iid = element.getAttribute('data-iid');
                var pid = element.getAttribute('data-pid');
                var chid = element.getAttribute('data-chid');
                var log_type = element.getAttribute('data-t');

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
                        }
                    }
                };
                xhr.send();
            }


            var accordionElements = document.querySelectorAll('.accordion .header');
            accordionElements.forEach(function (element) {
                element.addEventListener('click', sendAjaxRequest);
            });

            // expand if single video
            if (accordionElements.length == 1)
                goScrollTo(accordionElements[0], 5, 1, 0);

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

    </script>

</body>

</html>