<div class="container-fluid {{ $subClass }}section-footer" id="{{ $subClass }}download">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxxl-5 col-xl-6 col-lg-7 col-md-10 col-11">
                <div class="{{ $subClass }}section-form" id="section-form">
                    {!! $shapeArrow !!}
                    <button onclick="showModal('https://karboom.io/jobs/rlgmbj/wordpress-php-developer-')" class="{{ $subClass }}btn">
                        نمایش
                     <i class="si-chevron-left-r cta"></i>
                 </button>
                 <div class="modal full" id="recruitment-modal">
                    <div class="card p-0 position-relative">
                        <div class="close-btn-absolute close">
                        </div>
                        <iframe id="recruitment-iframe" width="100%" height="600px"></iframe>
                    </div>
                </div>
                    {{-- <div class="{{ $subClass }}shape-image">
                        {!! $shapeImage !!}
                        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}"
                            alt="{{ $brandName }}" class="icon">
                    </div>
                    <h2 class="{{ $subClass }}form-title {{ $subClass }}t-h4 {{ $subClass }}text-center">
                        برای دانلود، اطلاعات زیر را وارد کنید. </h2>
                    </h2>
                    @if ($showLoginForm)
                        @include('sdk.hook.landing._partials._partials._login-form')
                    @else
                        @include('sdk.hook.landing._partials._partials._form')
                    @endif
                    @include('sdk.hook.landing._partials._partials._footer-text') --}}
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
{{-- @section('modals')
    <div class="modal full" id="recruitment-modal">
        <div class="card p-0 position-relative">
            <div class="close-btn-absolute close"></div>
            <iframe id="recruitment-iframe" width="100%" height="600px"></iframe>
        </div>
    </div>
@endsection --}}