<div class="step w-100">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <input type="text" name="{{ $name }}" class="{{ $classes ?? '' }}" placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
    <button class="d-none m-submit next-step sm float-start"> ثبت و بعدی </button>
</div>