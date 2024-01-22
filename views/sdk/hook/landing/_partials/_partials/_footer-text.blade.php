@if($hook['fields']['conditions']['hook_download_type'] == 'sendable')
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> به {{ $hook['fields']['inputs']['email']['active'] ? 'ایمیل' : 'موبایل' }} شما
                        <br>
                        ارسال خواهد شد</span>
@else
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> را می‌توانید دانلود کنید</span>
@endif