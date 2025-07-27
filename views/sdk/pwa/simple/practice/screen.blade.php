<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    @include('sdk.pwa.simple.practice._partials.styles')
</head>

<body>
    <div class="base-container">
        <div class="base-content mx-auto">
            <div class="bghead without-bg sm flex-center padding-reverse">
                <span></span>
                <img class="icon" src="<?=$data['logo_url']?>">
                <h1 class="title">{{ $item->entity->title }}</h1>
                <small class="subtitle">
                    <span>📝</span>
                    <span>{{ $item->questions_count }} سوال</span>
                    <span>⭐</span>
                    <span>{{ $item->questions_point }} نمره</span>
                </small>
            </div>
            <div class="wpad tpad bpad" style="margin-top: -100px;z-index: 3;">
                
                <!-- Questions Container -->
                <div class="questions-container base-radius">
                    @foreach($item->questions as $index => $question)
                        @include('sdk.pwa.simple.practice._partials._question-item', ['question' => $question, 'item' => $item])
                    @endforeach
                </div>

                <!-- Navigation -->
                @if($item->next)
                    <div class="flex items-center gap-base bottom-video tpad-half">
                        <a class="btn light justify-start truncate flex-1" href="{{ $item->next->url }}">
                            <i class="fa-solid fa-angles-right text-primary"></i>
                            <span class="text-primary">تمرین بعدی:</span>
                            <span class="truncate flex-1">{{ $item->next->title }}</span>
                        </a>
                    </div>
                @endif

                <div class="h200"></div>
            </div>
        </div>
    </div>

    @include('sdk.pwa.simple.practice._partials.bottom-nav')
    <script type="module"  src="{{ getViteAssetUrl('resources/js/utilities/jquery.js') }}"></script>
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

        // Download attachment handler
        function downloadAttachment(url) {
            window.open(url, '_blank');
        }

        // Signal request function
        function signalRequest(iid, type) {
            var url = '<?=site_url('ajax/item/signal')?>';
            var params = 'itemId=' + encodeURIComponent(iid) + '&type=' + encodeURIComponent(type);
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url + '?' + params, true);
            xhr.send();
        }

        // Signal page visit on load
        document.addEventListener('DOMContentLoaded', function() {
            signalRequest("{{ $item->entity->id }}", 'visited');
        });
    </script>
</body>

</html>