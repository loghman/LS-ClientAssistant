<form
        action="{{ route('hook.download', $hook['slug']) }}"
        class="ajax-form"
        data-jsc="ajax-form"
        method="POST"
>
    @foreach($hook['fields']['inputs'] as $input)
        @if($input['active'])
            <div>
                <label for="">{{ $input['label'] }}</label>
                <input type="{{ $input['type'] }}" name="{{ $input['name'] }}" value="{{ $user[$input['name']] ?? '' }}">
            </div>
        @endif
    @endforeach
    <button>دریافت فایل</button>
</form>
