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
        .ajResponse{
            color:#333;
            font-weight: 500;
            font-size: 18px;
            text-align: center;
            line-height: 30px;
        }
        .ajResponse.success{
            color:var(--success) !important;
        }
        .ajResponse.danger{
            color:var(--danger) !important;
        }
    </style>
</head>

<body>
<div class="base-content">
    <div class="card-status bghead m-0 shadow-inset pt pb" style="padding-top: 0 !important;">
        <div class="text w-100 text-center">
            <img src="<?=$data['logo_url']?>" style="max-height: 40px;"><br>
            <span class="title" style="font-size: 24px;">{{ $item->product->title }}</span><br>
            <small class="subtitle">{{ $item->chapter->title }}</small>
        </div>
    </div>
    <div class="content" style="margin-top: -100px;">
        <div class="chapters">
            <div class="accordions">
                <div class="accordion expanded" data-iid="{{ $item->id }}" data-pid="{{ $item->product_id }}">
                    <div class="header py-sm expanded" id="{{ $item->id }}">
                        <span class="picon fa-solid fa-circle-play"></span>
                        <span class="title sm" style="font-weight: 500;">
                                <span>{{ $item->title }}</span>
                            </span>
                        <span class="time me-auto">{{ to_persian_num($item->duration) }}</span>
                    </div>
                    <div class="content">
                        <div class="playerbox">
                            @if($item->video->stream_url)
                                <script src="{{ $item->video->stream_url }}"></script>
                            @elseif($item->video->video_url)
                                <video id="itemPlayer" controls="" autoplay="" class="w-100 base-radius overflow-hidden" data-is-completed="{{ $item->is_completed }}">
                                    <source src="{{ $item->video->video_url }}" type="video/mp4"/>
                                </video>
                            @endif
                        </div>
                        @if(! $item->is_completed)
                            <div class="signal-box">
                                <button class="signal-btn me-auto" data-iid="{{ $item->id }}" onclick="showFeedbackOverlay()">
                                    <i class="fa-solid fa-circle-check"></i>تماشا کردم
                                </button>
                            </div>
                        @endif
                        @if($item->next)
                            <a class="simple-box nextitem" href="{{ $item->next->url }}">
                                <small><i style="vertical-align: -1px;" class="fa-solid fa-angles-right"></i> جلسه بعدی</small>
                                <span>{{ $item->next->title }}</span>
                            </a>
                        @endif
                        <div class="attachments">
                            @foreach($item->attachments as $attachment)
                                <a href="{{ $attachment->url }}" target="_blank" class="atlink">
                                    <span class="title"><b><i class="fa-solid fa-download"></i></b>{{ $attachment->title }}</span>
                                    <span class="size me-auto ltr">{{ $attachment->size }}</span>
                                </a>
                            @endforeach
                        </div>
                        @if($item->description)
                            <div class="longtextwrap" style="margin-top:-20px;padding:0">
                                @if(strlen($item->description) > 400)
                                    <div class="longtext">{!! $item->description !!}</div>
                                    <span class="moretext" onclick="toggleMoreText(event)">ادامه توضیحات ...</span>
                                @else
                                    <div class="alltext">{!! $item->description !!}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('sdk.pwa.simple.video._partials.bottom-nav')
@include('sdk.pwa.simple.video._partials.feedback-overlay')

@foreach($item->questions as $question)
    @include('sdk.pwa.simple.video._partials.questions-overlay', compact('question'))
@endforeach

<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
@include('sdk.pwa._partials.scripts')
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
        if ($('#question-overlay-'+id).attr('data-answerd') === 'true') {
            $('#question-overlay-'+id).css('display', 'none')
        }
    }
    function pauseAndShowQuestion(id) {
        isProgrammaticControl = true;
        video.pause();
        if ($('#question-overlay-'+id).attr('data-answerd') === 'false') {
            $('#question-overlay-' + id).css('display', 'block')
        }
    }

    var lastSecond = null;
    const questionSeconds = {!! $item->question_seconds !!};
    function checkTime() {
        const currentTime = video.currentTime;
        var seconds = Math.floor(currentTime);
        if (lastSecond !== seconds) {
            lastSecond = seconds;
            if(Object.keys(questionSeconds).includes(String(seconds))) {
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

    function showFeedbackOverlay() {
        $('#feedback-overlay').css('display', 'block')
    }

    function signalRequest(iid, type) {
        var url = '<?=site_url('ajax/item/signal')?>';
        var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + params, true);
        xhr.send();
    }

    document.addEventListener('DOMContentLoaded', function() {
        signalRequest("{{ $item->id }}",'visited');
    })
</script>

</body>

</html>
