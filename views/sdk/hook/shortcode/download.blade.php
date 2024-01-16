<span class="{{ $subClass }}t-title-sm {{ $subClass }}hr-line">
        <span>دریافت <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span></span>
</span>
<div class="{{ $subClass }}card-body auto-download" data-redirect="{{ $shortLink }}" data-time="{{ $redirectTime }}" data-countdown=".{{ $subClass }}countdown">
    <span class="{{ $subClass }}t-title">سلام {{ !empty($user) ? $user['full_name'] : 'دوست'}} عزیز</span>
    <p class="{{ $subClass }}t-text">
        دانلود به صورت خودکار انجام میشه <br> اگر دانلود انجام نشد، برای دریافت <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> روی دکمه زیر کلیک کنید
    </p>
    <span class="{{ $subClass }}t-title {{ $subClass }}text-center {{ $subClass }}countdown {{ $subClass }}my-md"></span>
    <button data-redirect="{{ $shortLink }}" class="link-redirect {{ $subClass }}btn {{ $subClass }}mx-auto" type="submit">
        <span>دانلود مجدد <span class="{{ $subClass }}d-inline {{ $subClass }}d-none-md">{{ $hook['title_fa'] }}</span></span>
    </button>
</div>