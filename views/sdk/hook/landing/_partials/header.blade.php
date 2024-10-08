<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="{{ $subClass }}section-header">
                    <a href="{{ site_url('') }}" class="{{ $subClass }}brand-icon">
                        <img src="{{ $logoUrl }}" alt="{{ $brandName }}">
                    </a>
                    <h1 class="{{ $subClass }}t-h1 {{ $subClass }}text-center">{{ $hook['title_fa'] }}</h1>
                    @include('sdk.hook.landing._partials.form')
                    <div class="row justify-content-center {{ $subClass }}w-100">
                        <div class="col-xl-5 col-lg-7 col-md-9 col-11">
                            <div class="{{ $subClass }}shape-side top-vertical">
                                <img class="banner" src="{{ get_media_url($hook['banner'], get_default_media(\Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum::BANNER)) }}" alt="">
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div>
</div>