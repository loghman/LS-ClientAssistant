@if($hook['fields']['conditions']['hook_download_type'] == 'sendable')
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> برای شما {{ ($hook['fields']['inputs']['email']['active'] && !$hook['fields']['inputs']['mobile']['active']) ? 'ایمیل' : 'پیامک' }}
                        <br>
                         خواهد شد</span>
@else
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> را می‌توانید دانلود کنید</span>
@endif