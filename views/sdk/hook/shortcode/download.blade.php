<span class="{{ $subClass }}t-title-sm {{ $subClass }}hr-line">
        <span>دریافت <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span></span>
</span>
<div class="{{ $subClass }}card-body auto-download" data-redirect="{{ $shortLink }}" data-time="{{ $redirectTime }}" data-countdown=".{{ $subClass }}countdown">
    <span class="{{ $subClass }}t-title">سلام {{ !empty($user) ? $user['full_name'] : 'دوست'}} عزیز</span>
    <p class="{{ $subClass }}t-text">
        دانلود به صورت خودکار انجام میشه <br> اگر دانلود انجام نشد، برای دریافت <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> روی دکمه زیر کلیک کنید
    </p>
    <span class="{{ $subClass }}t-h2 {{ $subClass }}text-center {{ $subClass }}countdown"></span>
    <a href="" class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
        دانلود مجدد <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md">{{ $hook['title_fa'] }}</span>
        {!! $iconArrowLeft !!}
    </a>
</div>