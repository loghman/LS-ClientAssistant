<?php $r = rand(0, 999999); ?>

@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    @if(isset($label))
        <p>{{ $label }}</p>
    @endif
    <textarea name="{{ $name }}" id="var<?=$r?>" rows="2"
              style="height: auto" placeholder="{{ $placeholder ?? ''  }}"
              class="{{ $classes ?? '' }}">{{ $value ?? '' }}</textarea>
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start" data-required="var<?=$r?>"> ثبت و بعدی</button>
    @endif
</div>
