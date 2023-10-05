@if(isset($label))
    <label>{{ $label }}</label>
@endif
<input type="number" name="{{ $name }}" class="{{ $classes ?? '' }}"
       placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
