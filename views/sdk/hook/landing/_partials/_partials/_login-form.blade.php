<form
        action="{{ route('auth.index') }}"
        class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100 ajax-form"
>
    <div class="{{ $subClass }}card">
        <span class="{{ $subClass }}t-title {{ $subClass }}text-center">ابتدا وارد سایت شوید</span>
        <p class="{{ $subClass }}t-text {{ $subClass }}text-center">
            برای  ورود به سایت از دکمه پایین استفاده کنید
        </p>
        <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
            ورود به سایت <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md"></span>
            {!! $iconArrowLeft !!}
        </button>
    </div>
</form>