<form
    @if($hook['fields']['conditions']['hook_download_type'] == 'sendable')
        @include('sdk.hook.landing._partials._partials._form-sendable-attribute')
            @else
        @include('sdk.hook.landing._partials._partials._form-showable-attribute')
            @endif
>
    <div class="{{ $subClass }}card">
        @foreach($hook['fields']['inputs'] as $input)
            @if($input['active'])
                <div class="{{ $subClass }}input-group sm-convert-to-input">
                    <label>{{ $input['label'] }}</label>
                    <input type="{{ $input['type'] }}" class="{{ $input['class'] }}" placeholder="{{ $input['label'] }} خود را وارد کنید ..." name="{{ $input['name'] }}" value="{{ $user[$input['name']] ?? '' }}">
                </div>
            @endif
        @endforeach
        <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
            ارسال و دریافت <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md">{{ $hook['title_fa'] }}</span>
            {!! $iconArrowLeft !!}
        </button>
    </div>
</form>