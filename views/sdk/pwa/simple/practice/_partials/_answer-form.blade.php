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

    <input type="hidden" name="answer[unique_id]" value="{{$uniqueId}}">
    <div class="editor-container">
        <textarea
                name="answer[text]"
                class="editor-content"
                placeholder="پاسخ خود را اینجا وارد کنید..."
                required></textarea>
    </div>

    <button type="submit" class="submit-btn">
        ارسال پاسخ
    </button>
</form> 