<form
    @include('sdk.hook.landing._partials._partials._form-showable-attribute')
>
    @foreach(array_reverse($hook['fields']['inputs']) as $input)
        @if($input['active'])
            <div class="{{ $subClass }}input-group sm-convert-to-input">
                <label>{{ $input['label'] }}</label>
                <input type="{{ $input['type'] }}" required class="{{ $input['class'] }}" placeholder="{{ $input['label'] }} خود را وارد کنید ..." name="{{ $input['name'] }}" value="{{ $user[$input['name']] ?? '' }}">
            </div>
        @endif
    @endforeach
    <button class="{{ $subClass }}btn magnet-bottom {{ $subClass }}mx-auto" type="submit">
        ثبت اطلاعات و دانلود
        {!! $iconArrowLeft !!}
    </button>
</form>