<!-- Submitted Answer -->
<div class="submitted-answer">
    <div class="answer-header">
        <span class="answer-date">ارسال شده در: {{ $question['answer']['created_at'] }}</span>
        <span class="answer-status status-{{ $question['answer']['status'] ?? 'pending' }}">
            {{ $question['answer']['status_label'] ?? 'در انتظار بررسی' }}
        </span>
    </div>
    
    <div class="answer-content">
        @switch($question['type'])
            @case('file')
            @case('repository')
                <a href="{{ $question['answer']['answer'] }}" target="_blank" class="file-link">
                    <span class="file-icon">📁</span>
                    <span>مشاهده فایل/مخزن</span>
                </a>
                @break
            @default
                {!! $question['answer']['answer'] !!}
        @endswitch
    </div>

    @if($question['answer']['displayable'] && isset($question['answer']['point']) && $question['answer']['point'] > 0)
        <div class="feedback-box">
            <div class="feedback-title">نمره دریافتی:</div>
            <div class="feedback-content">
                <span class="score">{{ $question['answer']['point'] }}/{{ $question['point'] }}</span>
            </div>
        </div>
    @endif

    @if($question['answer']['is_pending'])
        <button class="edit-btn" onclick="editAnswer({{ $question['id'] }})">
            ویرایش پاسخ
        </button>
    @endif

    <!-- Show other answers section if available -->
    @if($question['answer']['displayable'] && $question['answer_count'] > 0)
        <div class="other-answers-section">
            <button class="show-others-btn" onclick="loadOtherAnswers({{ $question['id'] }})">
                <span>مشاهده پاسخ‌های دیگران</span>
                <span class="answer-count-badge">{{ $question['answer_count'] }}</span>
            </button>
            <div id="other-answers-{{ $question['id'] }}" class="other-answers-container hidden"></div>
        </div>
    @endif
</div> 