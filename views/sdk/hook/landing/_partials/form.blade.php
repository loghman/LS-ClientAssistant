<div class="container-fluid {{ $subClass }}section-footer" id="{{ $subClass }}download">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxxl-5 col-xl-6 col-lg-7 col-md-10 col-11">
                <div class="{{ $subClass }}section-form" id="section-form">
                    {!! $shapeArrow !!}
                    <div class="{{ $subClass }}shape-image" >
                        {!! $shapeImage !!}
                        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}" alt="{{ $brandName }}" class="icon">
                    </div>
                    <h2 class="{{ $subClass }}form-title {{ $subClass }}t-h4 {{ $subClass }}text-center">
                        برای دانلود فرم زیر را تکمیل کنید
                    </h2>
                    @if($showLoginForm)
                        @include('sdk.hook.landing._partials._partials._login-form')
                    @else
                        @include('sdk.hook.landing._partials._partials._form')
                    @endif
                    @include('sdk.hook.landing._partials._partials._footer-text')
                    {!! $shapeFooterLine !!}
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $subClass }}shape-svg-pattern description">
        {!! $shapePatternB !!}
    </div>
    {!! $shapeFooterPattern !!}
</div>