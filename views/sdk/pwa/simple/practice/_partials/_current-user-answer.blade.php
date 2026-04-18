<!-- Submitted Answer -->
<div class="submitted-answer">
    <div class="answer-header">
        <span class="answer-date">ارسال شده در: {{ $question->answer->created_at }}</span>
        <span class="answer-status status-{{ $question->answer->status ?? 'pending' }}">
            {{ $question->answer->status_label ?? 'در انتظار بررسی' }}
        </span>
    </div>

    <!-- Show submitted answer in disabled form -->
    <div class="submitted-form">
        <textarea class="editor-content" disabled readonly>{{ $question->answer->answer }}</textarea>
    </div>

    @if($question->answer->displayable && isset($question->answer->point) && $question->answer->point > 0)
        <div class="feedback-box">
            <div class="feedback-title">نمره دریافتی:</div>
            <div class="feedback-content">
                <span class="score">{{ $question->answer->point }}/{{ $question->point }}</span>
            </div>
        </div>
    @endif
</div> 