@if($question->answer_description)
    <div class="correct-answer-section">
        <div class="correct-answer-header">
            <span class="correct-icon">✅</span>
            <span class="correct-title">پاسخ صحیح</span>
        </div>
        
        <div class="correct-answer-content">
            {!! $question->answer_description !!}
        </div>
        
        @if($item->creator)
            <div class="answer-author">
                <div class="author-info">
                    <span class="author-name">{{ $item->creator->name }}</span>
                    <span class="answer-date">{{ $question->created_at }}</span>
                </div>
            </div>
        @endif
    </div>
@endif 