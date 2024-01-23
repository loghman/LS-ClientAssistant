<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="{{ $subClass }}section-header">
                    <a href="" class="{{ $subClass }}brand-icon">
                        <img src="{{ $logoUrl }}" alt="{{ $brandName }}">
                    </a>
                    <h1 class="{{ $subClass }}t-h1 {{ $subClass }}text-center">{{ $hook['title_fa'] }}</h1>
                    <div class="row justify-content-center {{ $subClass }}w-100">
                        <div class="col-xl-5 col-lg-7 col-md-9 col-11">
                            <div class="{{ $subClass }}shape-side top-vertical">
                                <img class="banner" src="{{ storage_url($hook['banner']) }}" alt="">
{{--                                <div class="{{ $subClass }}shape-image magnet-top shadow">--}}
{{--                                    {!! $shapeImage !!}--}}
{{--                                    <img src="{{ $logoUrl }}" alt="{{ $brandName }}" class="icon">--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
{{--                    <div class="{{ $subClass }}tabs" id="{{ $subClass }}description">--}}
{{--                        <a href="#{{ $subClass }}description" class="active">توضیحات</a>--}}
{{--                        <a href="#{{ $subClass }}download">دریافت {{ $hook['title_fa'] }}</a>--}}
{{--                    </div>--}}
                </header>
            </div>
        </div>
    </div>
</div>