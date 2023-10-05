@if(isset($label))
    <label>{{ $label }}</label>
@endif
<input type="text" class="datepicker {{ $classes ?? '' }}" name="{{ $name }}"
       placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
