<form
        action="{{ route('auth.index') }}"
        class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100 ajax-form"
>
    <div class="{{ $subClass }}card">
        <span class="{{ $subClass }}t-title">سلام میلاد عزیز</span>
        <p class="{{ $subClass }}t-text">
            دانلود به صورت خودکار انجام میشه <br> اگر دانلود انجام نشد، برای دریافت <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-primary">چیت شیت پایتون</span> روی دکمه زیر کلیک کنید
        </p>
        <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
            لاگین کنید <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md"></span>
            {!! $iconArrowLeft !!}
        </button>
    </div>
</form>