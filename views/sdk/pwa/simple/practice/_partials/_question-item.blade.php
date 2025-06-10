<!-- Question Item -->
<div class="question-section" id="question-{{ $question->id }}">
    <div class="question-header">
        <strong class="question-number">{{ $question->label }}:</strong>
        <span class="question-point">{{ $question->point }} نمره</span>
    </div>

    <div class="question-text">
        {!! $question->question !!}
    </div>

    @if(!empty($question->media))
        @foreach($question->media as $media)
            <div class="attachment-box" onclick="downloadAttachment('{{ $media->url }}')">
                <span class="attachment-icon">📎</span>
                <div class="attachment-info">
                    <div class="attachment-name">مشاهده پیوست</div>
                    <div class="attachment-size">{{ $media->size ?? '' }}</div>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Answer Section -->
    <div class="answer-section">
        @if($question->answer)
            @include('sdk.pwa.simple.practice._partials._current-user-answer', ['question' => $question])
            
            @if($question->answer->displayable && $question->answer_description && $question->answer->status !== 'pending')
                @include('sdk.pwa.simple.practice._partials._correct-answer', ['question' => $question, 'item' => $item])
            @endif
        @else
            @include('sdk.pwa.simple.practice._partials._answer-form', ['question' => $question])
        @endif
    </div>
</div> 