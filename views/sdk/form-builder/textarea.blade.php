@if(isset($label))
    <p>{{ $label }}</p>
@endif
<textarea name="{{ $name }}" rows="2" style="height: auto" placeholder="{{ $placeholder ?? ''  }}"
          class="{{ $classes ?? '' }}">{{ $value ?? '' }}</textarea>
