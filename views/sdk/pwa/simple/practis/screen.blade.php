<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
        .practice-container {
            max-width: 100%;
            min-height: 100vh;
            background-color: white;
        }

        /* Header */
        .practice-header {
            background-color: #4A90E2;
            color: white;
            padding: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .back-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 4px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 500;
        }

        /* Assignment Section */
        .assignment-section {
            padding: 20px 16px;
            background-color: white;
            border-bottom: 8px solid #f5f5f5;
        }

        .assignment-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 12px;
            color: #2c3e50;
        }

        .assignment-meta {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
            font-size: 14px;
            color: #666;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .assignment-description {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 16px;
        }

        .attachment-box {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 8px;
        }

        .attachment-box:hover {
            background-color: #e9ecef;
        }

        .attachment-icon {
            font-size: 24px;
        }

        .attachment-info {
            flex: 1;
        }

        .attachment-name {
            font-weight: 500;
            color: #333;
        }

        .attachment-size {
            font-size: 12px;
            color: #666;
        }

        /* Question Section */
        .question-section {
            padding: 20px 16px;
            background-color: white;
            border-bottom: 8px solid #f5f5f5;
        }

        .question-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .question-number {
            background-color: #4A90E2;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }

        .question-point {
            color: #666;
            font-size: 14px;
        }

        .question-text {
            font-size: 16px;
            line-height: 1.8;
            color: #333;
            margin-bottom: 16px;
        }

        /* Answer Section */
        .answer-section {
            padding: 20px 16px;
            background-color: white;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 16px;
            color: #2c3e50;
        }

        .editor-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 16px;
        }

        .editor-toolbar {
            background-color: #f8f9fa;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .toolbar-btn {
            background: white;
            border: 1px solid #ddd;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .toolbar-btn:hover {
            background-color: #e9ecef;
        }

        .editor-content {
            min-height: 200px;
            padding: 16px;
            font-size: 16px;
            line-height: 1.6;
            outline: none;
        }

        .file-upload {
            margin-bottom: 16px;
        }

        .upload-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: #f8f9fa;
            border: 1px dashed #4A90E2;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #4A90E2;
            transition: background-color 0.2s;
        }

        .upload-btn:hover {
            background-color: #e3f2fd;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #4A90E2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background-color: #357ABD;
        }

        .submit-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Submitted Answer */
        .submitted-answer {
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .answer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .answer-date {
            font-size: 14px;
            color: #666;
        }

        .answer-status {
            padding: 4px 12px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-accepted {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .answer-content {
            margin-bottom: 12px;
            line-height: 1.8;
        }

        /* Feedback Section */
        .feedback-box {
            background-color: #e3f2fd;
            border: 1px solid #4A90E2;
            border-radius: 8px;
            padding: 16px;
            margin-top: 12px;
        }

        .feedback-title {
            font-weight: bold;
            color: #4A90E2;
            margin-bottom: 8px;
        }

        .feedback-content {
            color: #333;
            line-height: 1.6;
        }

        .score {
            font-weight: bold;
            color: #4A90E2;
            font-size: 18px;
        }

        .edit-btn {
            width: 100%;
            padding: 12px;
            background-color: #ff9800;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 12px;
        }

        .next-lesson-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 12px;
        }

        /* Navigation */
        .navigation-section {
            padding: 16px;
            background-color: #f8f9fa;
            display: flex;
            gap: 12px;
        }

        .nav-btn {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: white;
            color: #333;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s;
        }

        .nav-btn:hover {
            background-color: #e9ecef;
        }

        .nav-btn.disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Utilities */
        .hidden {
            display: none;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4A90E2;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 576px) {
            .assignment-meta {
                flex-direction: column;
                gap: 8px;
            }

            .question-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .navigation-section {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="practice-container">
    <!-- Header -->
    <header class="practice-header">
        <div class="header-content">
            <button class="back-btn" onclick="history.back()">→</button>
            <h1 class="header-title">{{ $item->title }}</h1>
            <div style="width: 32px;"></div>
        </div>
    </header>

    <!-- Assignment Details -->
    <section class="assignment-section">
        <h2 class="assignment-title">{{ $item->title }}</h2>

        <div class="assignment-meta">
            <div class="meta-item">
                <span>📝</span>
                <span>{{ $item->questions_count }} سوال</span>
            </div>
            <div class="meta-item">
                <span>⭐</span>
                <span>{{ $item->questions_point }} نمره</span>
            </div>
            @if($item->creator && !empty($item->creator['full_name']))
                <div class="meta-item">
                    <span>👨‍🏫</span>
                    <span>{{ $item->creator['full_name'] }}</span>
                </div>
            @endif
        </div>

        @if($item->description)
            <div class="assignment-description">
                {!! $item->description !!}
            </div>
        @endif

        @if(!empty($item->attachments))
            @foreach($item->attachments as $attachment)
                <div class="attachment-box" onclick="downloadAttachment('{{ $attachment['url'] }}')">
                    <span class="attachment-icon">📎</span>
                    <div class="attachment-info">
                        <div class="attachment-name">{{ $attachment['title'] }}</div>
                        <div class="attachment-size">{{ $attachment['size'] ?? '' }}</div>
                    </div>
                    <span>⬇️</span>
                </div>
            @endforeach
        @endif
    </section>

    <!-- Questions -->
    @foreach($item->questions as $index => $question)
        <section class="question-section" id="question-{{ $question['id'] }}">
            <div class="question-header">
                <span class="question-number">سوال {{ $index + 1 }}</span>
                <span class="question-point">{{ $question['max_point'] }} نمره</span>
            </div>

            <div class="question-text">
                {!! $question['question'] !!}
            </div>

            @if(!empty($question['media']))
                @foreach($question['media'] as $media)
                    <div class="attachment-box" onclick="downloadAttachment('{{ $media['url'] }}')">
                        <span class="attachment-icon">📎</span>
                        <div class="attachment-info">
                            <div class="attachment-name">{{ $media['title'] }}</div>
                            <div class="attachment-size">{{ $media['size'] ?? '' }}</div>
                        </div>
                        <span>⬇️</span>
                    </div>
                @endforeach
            @endif

            <!-- Answer Section -->
            <div class="answer-section">
                @if($question['has_answer'])
                    <!-- Show existing answer -->
                    <div class="submitted-answer">
                        <div class="answer-header">
                            <span class="answer-date">ارسال شده در: {{ $question['current_answer']['created_at'] }}</span>
                            <span class="answer-status status-{{ $question['current_answer']['status'] }}">
                                {{ $question['current_answer']['status_label'] }}
                            </span>
                        </div>
                        <div class="answer-content">
                            {!! $question['current_answer']['answer'] !!}
                        </div>

                        @if($question['current_answer']['displayable'] && $question['current_answer']['point'] > 0)
                            <div class="feedback-box">
                                <div class="feedback-title">نمره دریافتی:</div>
                                <div class="feedback-content">
                                    <span class="score">{{ $question['current_answer']['point'] }}/{{ $question['max_point'] }}</span>
                                </div>
                            </div>
                        @endif

                        @if($question['current_answer']['is_pending'])
                            <button class="edit-btn" onclick="editAnswer({{ $question['id'] }})">
                                ویرایش پاسخ
                            </button>
                        @endif
                    </div>
                @else
                    <!-- Answer form -->
                    <h3 class="section-title">پاسخ شما</h3>

                    <div id="answerForm-{{ $question['id'] }}">
                        <div class="editor-container">
                            <div class="editor-toolbar">
                                <button class="toolbar-btn" onclick="formatText('bold', {{ $question['id'] }})"><b>B</b></button>
                                <button class="toolbar-btn" onclick="formatText('italic', {{ $question['id'] }})"><i>I</i></button>
                                <button class="toolbar-btn" onclick="formatText('underline', {{ $question['id'] }})"><u>U</u></button>
                                <button class="toolbar-btn" onclick="formatText('insertUnorderedList', {{ $question['id'] }})">• لیست</button>
                                <button class="toolbar-btn" onclick="formatText('insertOrderedList', {{ $question['id'] }})">۱. لیست</button>
                            </div>
                            <div class="editor-content" contenteditable="true" id="answerEditor-{{ $question['id'] }}">
                                پاسخ خود را اینجا بنویسید...
                            </div>
                        </div>

                        <div class="file-upload">
                            <label class="upload-btn">
                                <span>📎</span>
                                <span>افزودن پیوست</span>
                                <input type="file" style="display: none;" onchange="handleFileUpload(event, {{ $question['id'] }})">
                            </label>
                            <div id="selectedFile-{{ $question['id'] }}" style="margin-top: 8px; font-size: 14px; color: #666;"></div>
                        </div>

                        <button class="submit-btn" onclick="submitAnswer({{ $question['id'] }})" id="submitBtn-{{ $question['id'] }}">
                            ارسال پاسخ
                        </button>
                    </div>
                @endif
            </div>
        </section>
    @endforeach

    <!-- Navigation -->
    @if($item->prev || $item->next)
        <section class="navigation-section">
            @if($item->prev)
                <a href="{{ $item->prev['url'] }}" class="nav-btn {{ $item->prev['is_locked'] ? 'disabled' : '' }}">
                    ← {{ $item->prev['title'] }}
                </a>
            @endif
            @if($item->next)
                <a href="{{ $item->next['url'] }}" class="nav-btn {{ $item->next['is_locked'] ? 'disabled' : '' }}">
                    {{ $item->next['title'] }} →
                </a>
            @endif
        </section>
    @endif
</div>

<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')
@include('sdk.pwa._partials.scripts')

<script>
    let selectedFiles = {};

    // Format text in editor
    function formatText(command, questionId) {
        document.execCommand(command, false, null);
        document.getElementById('answerEditor-' + questionId).focus();
    }

    // Handle file upload
    function handleFileUpload(event, questionId) {
        const file = event.target.files[0];
        if (file) {
            selectedFiles[questionId] = file;
            document.getElementById('selectedFile-' + questionId).textContent = `فایل انتخاب شده: ${file.name}`;
        }
    }

    // Submit answer
    function submitAnswer(questionId) {
        const editor = document.getElementById('answerEditor-' + questionId);
        const content = editor.innerHTML;

        if (content.trim() === '' || content === 'پاسخ خود را اینجا بنویسید...') {
            alert('لطفاً پاسخ خود را وارد کنید');
            return;
        }

        // Show loading
        const submitBtn = document.getElementById('submitBtn-' + questionId);
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="loading"></span> در حال ارسال...';

        // Prepare form data
        const formData = new FormData();
        formData.append('answer', content);
        if (selectedFiles[questionId]) {
            formData.append('attachment', selectedFiles[questionId]);
        }

        // Get question data
        const question = @json($item->questions).find(q => q.id === questionId);

        // Send AJAX request
        fetch(question.answer_url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Reload page to show submitted answer
                    location.reload();
                } else {
                    alert('خطا در ارسال پاسخ: ' + (data.message || 'خطای نامشخص'));
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'ارسال پاسخ';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('خطا در ارسال پاسخ');
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'ارسال پاسخ';
            });
    }

    // Edit answer
    function editAnswer(questionId) {
        // This would show the edit form - for now just reload
        location.reload();
    }

    // Download attachment
    function downloadAttachment(url) {
        window.open(url, '_blank');
    }

    // Clear placeholder text on focus
    document.addEventListener('DOMContentLoaded', function() {
        const editors = document.querySelectorAll('[id^="answerEditor-"]');
        editors.forEach(editor => {
            editor.addEventListener('focus', function() {
                if (this.innerHTML === 'پاسخ خود را اینجا بنویسید...') {
                    this.innerHTML = '';
                }
            });

            editor.addEventListener('blur', function() {
                if (this.innerHTML.trim() === '') {
                    this.innerHTML = 'پاسخ خود را اینجا بنویسید...';
                }
            });
        });

        // Send visit signal
        signalRequest("{{ $item->id }}", 'visited');
    });

    function signalRequest(iid, type) {
        var url = '{{ route("ajax.item.signal") }}';
        var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + params, true);
        xhr.send();
    }
</script>
</body>

</html>