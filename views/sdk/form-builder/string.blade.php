@if(isset($label))
    <label>{{ $label }}</label>
@endif
<input type="text" name="{{ $name }}" class="{{ $classes ?? '' }}"
       placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
