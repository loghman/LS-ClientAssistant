@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <input type="number" name="{{ $name }}" class="{{ $classes ?? '' }}"
           placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی</button>
    @endif
</div>