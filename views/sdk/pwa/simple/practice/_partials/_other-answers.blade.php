@if(isset($answers) && count($answers) > 0)
    @foreach($answers as $answer)
        <div class="other-answer-item">
            <div class="answer-user-info">
                <img src="{{ $answer->user->avatar_url }}" alt="{{ $answer->user->name }}" class="user-avatar">
                <div class="user-details">
                    <span class="user-name">{{ $answer->user->name }}</span>
                    <span class="answer-date">{{ $answer->created_at }}</span>
                </div>
                @if($answer->point > 0)
                    <span class="answer-score">{{ $answer->point }} نمره</span>
                @endif
            </div>
            
            <div class="answer-content-section">
                <div class="answer-text">
                    {!! $answer->answer !!}
                </div>
                
                <div class="answer-actions">
                    <button class="reaction-btn like-btn {{ $answer->like_reacted ? 'active' : '' }}" 
                            onclick="reactToAnswer({{ $answer->id }}, 'like', this)">
                        <span class="reaction-icon">👍</span>
                        <span class="reaction-count">{{ $answer->reaction_like_count }}</span>
                    </button>
                    
                    <button class="reaction-btn dislike-btn {{ $answer->dislike_reacted ? 'active' : '' }}" 
                            onclick="reactToAnswer({{ $answer->id }}, 'dislike', this)">
                        <span class="reaction-icon">👎</span>
                        <span class="reaction-count">{{ $answer->reaction_dislike_count }}</span>
                    </button>
                </div>
                
                @if($answer->corrected_answer)
                    <div class="corrector-feedback">
                        <div class="feedback-header">
                            <img src="{{ $answer->corrector->avatar_url }}" alt="{{ $answer->corrector->name }}" class="corrector-avatar">
                            <div class="feedback-info">
                                <span class="feedback-title">فیدبک مصحح</span>
                                <span class="feedback-date">{{ $answer->updated_at }}</span>
                            </div>
                        </div>
                        <div class="feedback-content">
                            {!! $answer->corrected_answer !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
    
    @if($answers->hasMorePaginate())
        <button class="load-more-btn" onclick="loadMoreAnswers(this)" 
                data-url="{{ $answers->nextPageUrl() }}">
            نمایش پاسخ‌های بیشتر...
        </button>
    @endif
@else
    <div class="no-answers">
        <p>هنوز پاسخی ثبت نشده است.</p>
    </div>
@endif

<style>
.other-answer-item {
    background-color: #f8f9fa;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 16px;
    margin-bottom: 12px;
}

.answer-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.user-details {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.user-name {
    font-weight: 500;
    color: #333;
    font-size: 14px;
}

.answer-date {
    font-size: 12px;
    color: #666;
}

.answer-score {
    background-color: #4A90E2;
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}

.answer-content-section {
    margin-top: 12px;
}

.answer-text {
    margin-bottom: 12px;
    line-height: 1.6;
    color: #333;
}

.answer-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.reaction-btn {
    display: flex;
    align-items: center;
    gap: 4px;
    background: none;
    border: 1px solid #ddd;
    border-radius: 16px;
    padding: 4px 8px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.2s;
}

.reaction-btn:hover {
    background-color: #f0f0f0;
}

.reaction-btn.active {
    background-color: #4A90E2;
    color: white;
    border-color: #4A90E2;
}

.reaction-icon {
    font-size: 14px;
}

.reaction-count {
    font-weight: 500;
}

.corrector-feedback {
    margin-top: 16px;
    background-color: #e8f5e8;
    border: 1px solid #4CAF50;
    border-radius: 8px;
    overflow: hidden;
}

.feedback-header {
    background-color: #4CAF50;
    color: white;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.corrector-avatar {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    object-fit: cover;
}

.feedback-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.feedback-title {
    font-weight: 500;
    font-size: 14px;
}

.feedback-date {
    font-size: 11px;
    opacity: 0.9;
}

.feedback-content {
    padding: 12px;
    line-height: 1.6;
    color: #333;
}

.load-more-btn {
    width: 100%;
    padding: 12px;
    background-color: #f8f9fa;
    border: 1px solid #4A90E2;
    border-radius: 8px;
    color: #4A90E2;
    cursor: pointer;
    font-size: 14px;
    margin-top: 8px;
    transition: background-color 0.2s;
}

.load-more-btn:hover {
    background-color: #e3f2fd;
}

.no-answers {
    text-align: center;
    padding: 24px;
    color: #666;
    font-style: italic;
}
</style> 