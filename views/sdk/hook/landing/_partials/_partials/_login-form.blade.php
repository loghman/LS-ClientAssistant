<form
        action="{{ setting('client_auth_index', route('auth.index')) . "?refer=" . request()->url() }}"
        class="{{ $subClass }}card ajax-form {{ $subClass }}w-100"
        data-stable="true"
>
    <span class="{{ $subClass }}t-title {{ $subClass }}text-center">ابتدا وارد سایت شوید</span>
    <p class="{{ $subClass }}t-text {{ $subClass }}text-center">
        برای ورود به سایت از دکمه پایین استفاده کنید
    </p>
    <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
        ورود به سایت
        {!! $iconArrowLeft !!}
    </button>
</form>