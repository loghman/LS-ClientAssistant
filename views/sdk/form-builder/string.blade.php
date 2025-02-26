@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <input type="text" name="{{ $name }}" class="{{ $classes ?? '' }}"
           placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی </button>
    @endif
</div>