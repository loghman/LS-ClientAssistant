<span class="t-title-lg">{{ $placeholder }}</span>
@foreach($choices as $key => $value)
    <label class="checked-fill">
        <input name="{{ $name }}" value="{{ $key }}" type="checkbox" {{ isset($checked) && $checked == $key ? 'checked' : '' }}>
        <span class="title">{{ $value }}</span>
    </label>
@endforeach