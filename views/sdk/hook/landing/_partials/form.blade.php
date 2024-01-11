<div class="container-fluid {{ $subClass }}section-footer" id="{{ $subClass }}download">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-7 col-10">
                <div class="{{ $subClass }}section-form" id="section-form">
                    {!! $shapeArrow !!}
                    <div class="{{ $subClass }}shape-image" >
                        {!! $shapeImage !!}
                        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}" alt="سون‌لرن" class="icon">
                    </div>
                    <h2 class="{{ $subClass }}form-title {{ $subClass }}t-h2 {{ $subClass }}text-center">
                        برای دریافت <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span>
                        <br>
                        فرم زیر رو پر کن
                    </h2>
                    @if($hook['fields']['conditions']['required_login'] && !$user)
                        @include('sdk.hook.landing._partials._partials._login-form')
                    @else
                        @include('sdk.hook.landing._partials._partials._form')
                    @endif
                    <span class="{{ $subClass }}t-title-sm {{ $subClass }}text-center">پس از اسال فرم، <span class="{{ $subClass }}text-primary">{{ $hook['title_fa'] }}</span> به ایمیل شما
                        <br>
                        ارسال خواهد شد</span>
                    {!! $shapeFooterLine !!}
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $subClass }}shape-bg">
        {!! $shapeFooter !!}
    </div>
    {!! $shapeFooterPattern !!}
</div>