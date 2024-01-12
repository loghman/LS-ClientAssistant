<div class="{{ $subClass }}section-form auto-download" data-redirect="{{ $shortLink }}" data-time="{{ $redirectTime }}" data-countdown=".{{ $subClass }}countdown">
    {!! $shapeArrow !!}
    <div class="{{ $subClass }}shape-image">
        {!! $shapeImage !!}
        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}" alt="{{ $brandName }}" class="icon">
    </div>
    <h2 class="{{ $subClass }}form-title {{ $subClass }}t-h2 {{ $subClass }}text-center">
        دریافت <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span>
    </h2>
    <div class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100">
        <div class="{{ $subClass }}card">
            <span class="{{ $subClass }}t-title">سلام {{ !empty($user) ? $user['full_name'] : 'دوست'}} عزیز</span>
            <p class="{{ $subClass }}t-text">
                دانلود به صورت خودکار انجام میشه <br> اگر دانلود انجام نشد، برای دریافت <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> روی دکمه زیر کلیک کنید
            </p>
            <span class="{{ $subClass }}t-h2 {{ $subClass }}text-center {{ $subClass }}countdown"></span>
            <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
                دانلود مجدد <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md">{{ $hook['title_fa'] }}</span>
                {!! $iconArrowLeft !!}
            </button>
        </div>
    </div>
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">چیت شیت</span> به {{ $hook['inputs']['email']['active'] ? 'ایمیل' : 'موبایل' }} شما
                        <br>
                        ارسال خواهد شد</span>
    {!! $shapeFooterLine !!}
</div>