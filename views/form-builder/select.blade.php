@if(isset($label))
    <label>{{ $label }}</label>
@endif
<select name="{{ $name }}" class="{{ $classes ?? 'select2' }}" placeholder="{{ $placeholder ?? ''  }}">
    @foreach($choices as $key => $value)
        <option value="{{ $key }}" {{ isset($selected) && $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
    @endforeach
</select>
