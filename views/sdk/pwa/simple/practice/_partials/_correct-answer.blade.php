@if($question['answer_description'])
    <div class="correct-answer-section">
        <div class="correct-answer-header">
            <span class="correct-icon">✅</span>
            <span class="correct-title">پاسخ صحیح</span>
        </div>
        
        <div class="correct-answer-content">
            {!! $question['answer_description'] !!}
        </div>
        
        @if($item->creator)
            <div class="answer-author">
                <img src="{{ $item->creator->avatar_url }}" alt="{{ $item->creator->name }}" class="author-avatar">
                <div class="author-info">
                    <span class="author-name">{{ $item->creator->name }}</span>
                    <span class="answer-date">{{ $question['created_at'] }}</span>
                </div>
            </div>
        @endif
    </div>
@endif

<style>
.correct-answer-section {
    background-color: #e8f5e8;
    border: 1px solid #4CAF50;
    border-radius: 8px;
    padding: 16px;
    margin-top: 16px;
}

.correct-answer-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}

.correct-icon {
    font-size: 20px;
}

.correct-title {
    font-weight: bold;
    color: #2e7d32;
    font-size: 16px;
}

.correct-answer-content {
    line-height: 1.8;
    color: #333;
    margin-bottom: 12px;
}

.answer-author {
    display: flex;
    align-items: center;
    gap: 8px;
    padding-top: 12px;
    border-top: 1px solid #c8e6c9;
}

.author-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
}

.author-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.author-name {
    font-weight: 500;
    color: #2e7d32;
    font-size: 14px;
}

.answer-date {
    font-size: 12px;
    color: #666;
}
</style> 