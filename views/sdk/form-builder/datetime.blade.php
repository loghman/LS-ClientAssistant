@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <input type="text" class="datepicker {{ $classes ?? '' }}" name="{{ $name }}"
           placeholder="{{ $placeholder ?? ''  }}" value="{{ $value ?? '' }}">
    @if($isMinimal)
        <button class="d-none m-submit next-step sm float-start"> ثبت و بعدی</button>
    @endif
</div>