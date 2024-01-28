@php
    include sdk_path('views/sdk/hook/landing/_partials/_partials/svg.php');
@endphp
<div class="{{ $subClass }}section-form auto-download">
    {!! $shapeArrow !!}
    <div class="{{ $subClass }}shape-image">
        {!! $shapeImage !!}
        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}" alt="{{ $brandName }}" class="icon">
    </div>
    <h2 class="{{ $subClass }}form-title {{ $subClass }}t-h2 {{ $subClass }}text-center">
        دریافت <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span>
    </h2>
    <div class="{{ $subClass }}card">
        <span class="{{ $subClass }}t-title">سلام {{ !empty($user) ? $user['full_name'] : 'دوست'}} عزیز</span>
        <p class="{{ $subClass }}t-text">{{ $message }}</p>
        <span class="{{ $subClass }}t-h2 {{ $subClass }}text-center {{ $subClass }}countdown"></span>
        <button data-redirect="{{ route('hook.download', $hook['slug']) }}" class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto"
                type="submit"
                data-jsc="ajax-form"
                data-method="POST"
        >
            دانلود مجدد
            {!! $iconArrowLeft !!}
        </button>
    </div>
    @include('sdk.hook.landing._partials._partials._footer-text')
    {!! $shapeFooterLine !!}
</div>