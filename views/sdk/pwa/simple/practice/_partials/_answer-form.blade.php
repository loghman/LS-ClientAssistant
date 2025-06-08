@php
    $uniqueId=create_unique_id();
@endphp
<!-- Answer form -->
<h3 class="section-title">پاسخ شما</h3>

<form action="{{ $question->answer_url }}"
      method="POST"
      enctype="multipart/form-data"
      data-jsc="ajax-form"
      data-after-success="refresh">

    @switch($question->type)
        @case('descriptive')
            <input type="hidden" name="answer[unique_id]" value="{{$uniqueId}}">
            <div class="editor-container">
                <textarea
                    name="answer[text]"
                    class="editor-content"
                    placeholder="پاسخ خود را اینجا وارد کنید..."
                    required></textarea>
            </div>
            @break
            
        @case('file')
            <input type="hidden" name="answer" value="{{ $uniqueId }}">
            @if($question->allowed_file_formats)
                <div class="file-upload">
                    <label class="upload-btn">
                        <span>📎</span>
                        <span>افزودن پیوست</span>
                        <input type="file"
                               name="attachment"
                               style="display: none;"
                               accept="{{ implode(',', $question->allowed_file_formats) }}"
                               data-max-size="{{ $question->max_file_size }}"
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
        ارسال پاسخ
    </button>
</form> 