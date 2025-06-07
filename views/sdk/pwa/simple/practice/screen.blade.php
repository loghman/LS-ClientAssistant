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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
            width: 100%;
            min-height: 150px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #fafafa;
            font-family: inherit;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            resize: vertical;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .editor-content:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
        }

        .editor-content::placeholder {
            color: #999;
        }

        .editor-content:disabled {
            background-color: #f5f5f5;
            color: #666;
            cursor: not-allowed;
            border-color: #ddd;
        }

        .submitted-form {
            margin-bottom: 12px;
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
            position: relative;
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

        /* File Link Styles */
        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background-color: #e3f2fd;
            border: 1px solid #4A90E2;
            border-radius: 6px;
            color: #4A90E2;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s;
        }

        .file-link:hover {
            background-color: #bbdefb;
        }

        .file-icon {
            font-size: 16px;
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
            <button class="back-btn" onclick="history.back()">←</button>
            <h1 class="header-title">{{ $item->entity->title }}</h1>
            <div style="width: 32px;"></div>
        </div>
    </header>

    <!-- Assignment Details -->
    <section class="assignment-section">
        <h2 class="assignment-title">{{ $item->entity->title }}</h2>

        <div class="assignment-meta">
            <div class="meta-item">
                <span>📝</span>
                <span>{{ $item->questions_count }} سوال</span>
            </div>
            <div class="meta-item">
                <span>⭐</span>
                <span>{{ $item->questions_point }} نمره</span>
            </div>
            @if($item->creator)
                <div class="meta-item">
                    <img src="{{ $item->creator->avatar_url }}" alt="{{ $item->creator->name }}"
                         style="width: 24px; height: 24px; border-radius: 50%;">
                    <span>{{ $item->creator->name }}</span>
                </div>
            @endif
        </div>
    </section>

    <!-- Questions -->
    @foreach($item->questions as $index => $question)
        @include('sdk.pwa.simple.practice._partials._question-item', ['question' => $question, 'item' => $item])
    @endforeach

    <!-- Navigation -->
    @if($item->prev || $item->next)
        <section class="navigation-section">
            @if($item->prev)
                <a href="{{ $item->prev->url }}" class="nav-btn {{ $item->prev->is_locked ? 'disabled' : '' }}">
                    ← {{ $item->prev->title }}
                </a>
            @endif
            @if($item->next)
                <a href="{{ $item->next->url }}" class="nav-btn {{ $item->next->is_locked ? 'disabled' : '' }}">
                    {{ $item->next->title }} →
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
    // File selection handler
    function handleFileSelect(input) {
        const selectedFileDiv = input.parentElement.parentElement.querySelector('.selected-file');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const maxSize = parseInt(input.dataset.maxSize) || 10485760; // 10MB default
            
            if (file.size > maxSize) {
                toast('حجم فایل بیش از حد مجاز است.', 'danger');
                input.value = '';
                selectedFileDiv.textContent = '';
                return;
            }
            
            selectedFileDiv.textContent = `فایل انتخاب شده: ${file.name} (${formatFileSize(file.size)})`;
        } else {
            selectedFileDiv.textContent = '';
        }
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Signal request function
    function signalRequest(iid, type) {
        var url = '{{ $item->signal_url }}';
        var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url + '?' + params, true);
        xhr.send();
    }

    // Signal page visit on load
    window.addEventListener('load', function() {
        signalRequest('{{ $item->entity->id }}', 'visited');
    });
</script>
</body>

</html>