<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    @include('sdk.pwa.simple.video._partials.styles')
    <style>
        .overlay .erow span {
            font-size: 15px;
            font-weight: 600;
            text-align: justify;
        }

        .overlay .icheck {
            color: #999;
            vertical-align: middle;
            margin-left: 3px;
        }

        .overlay .qbtn {
            margin-top: 15px;
            padding: 5px 36px;
        }

        .ajResponse {
            color: #333;
            font-weight: 500;
            font-size: 18px;
            text-align: center;
            line-height: 30px;
        }

        .ajResponse.success {
            color: var(--success) !important;
        }

        .ajResponse.danger {
            color: var(--danger) !important;
        }

        @media (min-width: 200px) {
            .bottom-nav {
                display: flex !important;
            }
        }

        /* video::-webkit-media-controls-fullscreen-button {
            display: none !important;
        } */


        @media (max-width: 576px) {
            .bottom-video {
                flex-direction: column-reverse;
                gap: calc(var(--base-padding) / 2);
                padding-top: var(--base-padding)
            }
            .bottom-video > * {
                width: 100%;
            }
        }

        .embedbox{
            background-color: var(--primary-20); !important;
            padding: 10px;
            min-height: 230px;
        }
        .embedbox iframe,.embedbox video{
            border: 0;
            border-radius: 7px;
            margin-bottom: 10px;
            max-width: 100%;
            width: 100%; 
        }
        .h_iframe-aparat_embed_frame{
            margin-bottom: 10px;
        }

    </style>
</head>

<body>
    <div class="base-container">
        <div class="base-content mx-auto">
            <div class="bghead without-bg sm flex-center padding-reverse">
                <span></span>
                <img class="icon" src="<?=$data['logo_url']?>">
                <h1 class="title">{{ $item->title }}</h1>
                <small class="subtitle">{{ str_replace(["دوره ", "وبینار "], "", strtok($item->product->title, "(")) }}
                    <i style="font-size: 9px; padding: 0 3px;" class="fa-solid fa-angles-left"></i>
                    {{ $item->chapter->title }}</small>
            </div>
            <div class="wpad tpad bpad" style="margin-top: -100px;z-index: 3;">
                {{-- controlsList="nofullscreen" --}}
                @if($item->video)
                <div data-drm-text="{{ current_user()['mobile'] ?? current_user()['email'] }}" class="playerbox base-radius">
                    @if($item->video->stream_url)
                        {{-- TODO: TOFIX --}}
                        <script src="{{ $item->video->stream_url }}"></script>
                    @elseif($item->video->video_url) 
                        <video id="itemPlayer" controls  autoplay=""
                            class="w-100 base-radius overflow-hidden" data-is-completed="{{ $item->is_completed }}">
                            <source src="{{ $item->video->video_url }}" type="video/mp4" />
                        </video>
                    @endif
                </div>
                @endif
                @if ($item->type->name == 'Text')
                <div class="embedbox base-radius" style="margin-top: 10px">
                    @if($item->description)
                        {!! str_replace(['<video '],['<video id="itemPlayer" '],$item->description) !!}
                    @else
                    <p>این جلسه هنوز محتوایی ندارد</p>
                    @endif
                </div>
                @endif

                <div class="flex items-center gap-base bottom-video tpad-half">
                    @if($item->next)
                        <a class="btn light justify-start truncate flex-1" href="{{ $item->next->url }}">
                            <i class="fa-solid fa-angles-right text-primary"></i>
                            <span class="text-primary"> جلسه
                                بعدی:</span>
                            <span class="truncate flex-1">{{ $item->next->title }}</span>
                        </a>
                    @endif
                    @if(!$item->is_completed)
                        <div class="signal-box">
                            <button class="signal-btn me-auto" data-iid="{{ $item->id }}" onclick="showFeedbackOverlay()">
                                <i class="fa-solid fa-circle-check"></i>تکمیل این جلسه
                            </button>
                        </div>
                    @endif
                </div>
                {{-- @if($item->attachments) --}}
                <div class="attachments">
                    @foreach($item->attachments as $attachment)
                        <?php $ext = pathinfo($attachment->url, PATHINFO_EXTENSION) ?>
                        <a href="{{ $attachment->url }}" target="_blank" class="atlink btn light">
                            <span class="title"><b><i class="fa-solid fa-download"></i></b>{{ $attachment->title }}</span>
                            <span class="size me-auto ltr "><small class="ext <?=$ext?>">{{$ext}}</small></span>
                            {{-- <span class="size me-auto ltr">{{ $attachment->size }}</span> --}}
                        </a>
                    @endforeach
                </div>
                {{-- @endif --}}
                @if($item->description && $item->type->name != 'Text')
                    <div class="longtextwrap" style="margin-top:-20px;padding:0">
                        @if(strlen($item->description) > 400)
                            <div class="longtext">{!! $item->description !!}</div>
                            <span class="moretext" onclick="toggleMoreText(event)">ادامه توضیحات ...</span>
                        @else
                            <div class="alltext">{!! $item->description !!}</div>
                        @endif
                    </div>
                @endif
                <div class="h200"></div>
            </div>
        </div>

    </div>

    @include('sdk.pwa.simple.video._partials.bottom-nav')
    @if(!$item->is_completed)
        @include('sdk.pwa.simple.video._partials.feedback-overlay')
    @endif
    @foreach($item->questions as $question)
        @include('sdk.pwa.simple.video._partials.questions-overlay', compact('question'))
    @endforeach

    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages')
    @include('sdk.pwa._partials.scripts')
     <script type="module"  src="{{ getViteAssetUrl('resources/js/utilities/video-drm-text.js') }}"></script>
    <script>
        const video = document.getElementById('itemPlayer');
        let isSeeking = false;
        let isProgrammaticControl = false;

        // کنترل زمانی که کاربر زمان ویدیو را تغییر می‌دهد
        video.addEventListener('seeking', () => {
            isSeeking = true;
        });

        function playAndHideQuestion(id) {
            isProgrammaticControl = true;
            video.play();
            if ($('#question-overlay-' + id).attr('data-answerd') === 'true') {
                $('#question-overlay-' + id).fadeOut(300)
            }
        }
        function pauseAndShowQuestion(id) {
            isProgrammaticControl = true;
            video.pause();
            if ($('#question-overlay-' + id).attr('data-answerd') === 'false') {
                $('#question-overlay-' + id).fadeIn(300)
            }
        }

        var lastSecond = null;
        const questionSeconds = {!! $item->question_seconds !!};
        function checkTime() {
            const currentTime = video.currentTime;
            var seconds = Math.floor(currentTime);
            if (lastSecond !== seconds) {
                lastSecond = seconds;
                if (Object.keys(questionSeconds).includes(String(seconds))) {
                    let id = questionSeconds[seconds]
                    pauseAndShowQuestion(id);
                }
            }
        }
        if (video.dataset.isCompleted != 1) {
            function completeSignal() {
                if (video.duration - video.currentTime <= 10) {
                    showFeedbackOverlay()
                    video.removeEventListener('timeupdate', completeSignal);
                    $('.signal-box').css('display', 'none');
                }
            }
            video.addEventListener('timeupdate', completeSignal);
        }
        video.addEventListener('timeupdate', checkTime);
        video.addEventListener('play', function () {
            if (!isSeeking && !isProgrammaticControl) {
                signalRequest("{{ $item->id }}", 'played')
            }
        });

        function exitFullscreenForAllVideos() {
            // Check if any element is in fullscreen mode
            if (document.fullscreenElement || 
                document.webkitFullscreenElement || 
                document.mozFullScreenElement || 
                document.msFullscreenElement) {
                
                // Exit fullscreen mode using the appropriate method for the current browser
                if (document.exitFullscreen) {
                document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
                }
                
                console.log("Exited fullscreen mode");
                return true;
            } else {
                console.log("No element is in fullscreen mode");
                return false;
            }
            }

        function showFeedbackOverlay() {
            exitFullscreenForAllVideos();
            $('#feedback-overlay').fadeIn(300);
        }

        function signalRequest(iid, type) {
            var url = '<?=site_url('ajax/item/signal')?>';
            var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);
            xhr.send();
        }

        document.addEventListener('DOMContentLoaded', function () {
            signalRequest("{{ $item->id }}", 'visited');

            const closeButtons = document.querySelectorAll('.close');
            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const overlay = button.closest('.overlay');
                    if (overlay) {
                        $('#feedback-overlay').fadeOut(300);
                    }
                });
            });
        })
    </script>


</body>

</html>
