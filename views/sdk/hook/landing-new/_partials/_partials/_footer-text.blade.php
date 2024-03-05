@if($hook['fields']['conditions']['hook_download_type'] == 'sendable')
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از تکمیل اطلاعات لینک دانلود فایل برای شما ارسال خواهد شد</span>
@else
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از تکمیل اطلاعات میتوانید فایل را دانلود کنید</span>
@endif