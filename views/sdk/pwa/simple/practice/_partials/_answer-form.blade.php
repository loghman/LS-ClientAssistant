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
{{--            <input type="hidden" name="answer" value="{{ $uniqueId }}">--}}
{{--            @include('sdk._common.components.uploader', [--}}
{{--                'uniqueId' => $uniqueId,--}}
{{--                'id' => $question->id,--}}
{{--                'collectionName' => 'attachment',--}}
{{--                'maxSize' => $question->max_file_size,--}}
{{--                'allowedFileFormats' => $question->allowed_file_formats,--}}
{{--                'media_custom_rule' => 'quiz_questions,'.$question->id--}}
{{--            ])--}}
            @break
        @case('repository')
            <div class="editor-container">
                <input type="url" 
                       name="answer" 
                       class="editor-content repository-input" 
                       placeholder="https://github.com/username/repository-name"
                       required>
                <small class="repository-hint">
                    لینک مخزن کد خود را وارد کنید
                </small>
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