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
        <div class="text w-100 text-center" style="padding-top:20px">
            <img src="<?=$data['logo_url']?>" style="max-height: 30px;">
            <h1 class="title" style="font-size: 20px;margin:20px 0 0 0">{{ $item->title }}</h1>
            <small class="subtitle">{{ str_replace(["دوره ","وبینار "],"",strtok($item->product->title,"(")) }} <i style="font-size: 9px; padding: 0 3px;" class="fa-solid fa-angles-left"></i> {{ $item->chapter->title }}</small>
        </div>
    </div>
    <div class="content" style="margin-top: -100px;">
        <div class="chapters">
            <div class="accordions">
                <div class="accordion expanded" data-iid="{{ $item->id }}" data-pid="{{ $item->product_id }}">
                    <div class="content">
                        <div class="playerbox">
                            @if($item->video && $item->video->stream_url)
                                <script src="{{ $item->video->stream_url }}"></script>
                            @elseif($item->video && $item->video->video_url)
                                <video id="itemPlayer" controls="" autoplay="" class="w-100 base-radius overflow-hidden" data-is-completed="{{ $item->is_completed }}">
                                    <source src="{{ $item->video->video_url }}" type="video/mp4"/>
                                </video>
                            @endif
                        </div>
                        @if(! $item->is_completed)
                            <div class="signal-box">
                                <button class="signal-btn me-auto" data-iid="{{ $item->id }}" onclick="showFeedbackOverlay()">
                                    <i class="fa-solid fa-circle-check"></i>تکمیل این جلسه
                                </button>
                            </div>
                        @endif
                        @if($item->next)
                            <a class="simple-box nextitem" href="{{ $item->next->url }}">
                                <small><i style="vertical-align: -1px;" class="fa-solid fa-angles-right"></i> جلسه بعدی</small>
                                <span>{{ $item->next->title }}</span>
                            </a>
                        @endif
                        {{-- @if($item->attachments) --}}
                        <div class="attachments">
                            @foreach($item->attachments as $attachment)
                                <?php $ext = pathinfo($attachment->url, PATHINFO_EXTENSION) ?>
                                <a href="{{ $attachment->url }}" target="_blank" class="atlink">
                                    <span class="title"><b><i class="fa-solid fa-download"></i></b>{{ $attachment->title }}</span>
                                    <span class="size me-auto ltr "><small class="ext <?=$ext?>">{{$ext}}</small></span>
                                    {{-- <span class="size me-auto ltr">{{ $attachment->size }}</span> --}}
                                </a>
                            @endforeach
                        </div>
                        {{-- @endif --}}
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
            $('#question-overlay-'+id).fadeOut(300)
        }
    }
    function pauseAndShowQuestion(id) {
        isProgrammaticControl = true;
        video.pause();
        if ($('#question-overlay-'+id).attr('data-answerd') === 'false') {
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
        $('#feedback-overlay').fadeIn(300);
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
