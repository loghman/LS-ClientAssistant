<form
        action="{{ route('auth.index') }}"
        class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100 ajax-form"
>
    <div class="{{ $subClass }}card">
        <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
            لاگین کنید <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md"></span>
            {!! $iconArrowLeft !!}
        </button>
    </div>
</form>