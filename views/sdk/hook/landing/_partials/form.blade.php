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
                    <form
                            class="{{ $subClass }}shape-side top-horizontal {{ $subClass }}w-100 ajax-form"
                            method="POST"
                            data-jsc="ajax-form"
                            data-after-success="replace"
                            data-target="#section-form"
                            action="{{ route('hook.download', $hook['slug']) }}"
                            {{--                            data-ajax='{"route": "{{ route('hook.download', $hook['slug']) }}"}'--}}
                    >
                        <div class="{{ $subClass }}card">
                            @foreach($hook['fields']['inputs'] as $input)
                                @if($input['active'])
                                    <div class="{{ $subClass }}input-group sm-convert-to-input">
                                        <label>{{ $input['label'] }}</label>
                                        <input type="{{ $input['type'] }}" placeholder="{{ $input['label'] }} خود را وارد کنید ..." name="{{ $input['name'] }}" value="{{ $user[$input['name']] ?? '' }}">
                                    </div>
                                @endif
                            @endforeach
                            <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
                                ارسال و دریافت <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md">{{ $hook['title_fa'] }}</span>
                                {!! $iconArrowLeft !!}
                            </button>
                        </div>
                    </form>
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