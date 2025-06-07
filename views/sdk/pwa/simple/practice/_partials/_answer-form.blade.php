<!-- Answer form -->
<h3 class="section-title">پاسخ شما</h3>

<form action="{{ $question['answer_url'] }}" method="POST" enctype="multipart/form-data" onsubmit="submitAnswer(event, this)">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    @switch($question['type'])
        @case('descriptive')
            <div class="editor-container">
                <textarea
                    name="answer"
                    class="editor-content"
                    placeholder="متن خود را اینجا وارد کنید..."
                    required></textarea>
            </div>
            @break
            
        @case('file')
            @if($question['allowed_file_formats'])
                <div class="file-upload">
                    <label class="upload-btn">
                        <span>📎</span>
                        <span>افزودن پیوست</span>
                        <input type="file"
                               name="attachment"
                               style="display: none;"
                               accept="{{ implode(',', $question['allowed_file_formats']) }}"
                               data-max-size="{{ $question['max_file_size'] }}"
                               onchange="handleFileSelect(this)"
                               required>
                    </label>
                    <div class="selected-file" style="margin-top: 8px; font-size: 14px; color: #666;"></div>
                </div>
            @endif
            @break
            
        @case('repository')
            <div class="editor-container">
                <input type="url" 
                       name="answer" 
                       class="editor-content" 
                       placeholder="https://github.com/your-repository"
                       style="min-height: auto; padding: 12px;"
                       required>
            </div>
            @break
            
        @default
            <div class="editor-container">
                <textarea
                    name="answer"
                    class="editor-content"
                    placeholder="متن خود را اینجا وارد کنید..."
                    required></textarea>
            </div>
    @endswitch

    <button type="submit" class="submit-btn">
        <span class="submit-text">ارسال پاسخ</span>
        <span class="loading hidden">
            <span style="display: inline-block; width: 20px; height: 20px; border: 3px solid #f3f3f3; border-top: 3px solid #4A90E2; border-radius: 50%; animation: spin 1s linear infinite;"></span>
        </span>
    </button>
</form> 