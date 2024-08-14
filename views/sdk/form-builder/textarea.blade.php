<?php $r=rand(0,999999); ?>

<div class="step w-100">
    @if(isset($label))
        <p>{{ $label }}</p>
    @endif
    <textarea name="{{ $name }}" id="var<?=$r?>" rows="2" style="height: auto" placeholder="{{ $placeholder ?? ''  }}"
            class="{{ $classes ?? '' }}">{{ $value ?? '' }}</textarea>
    <button type="button" class="d-none m-submit next-step sm float-start" data-required="var<?=$r?>"> ثبت و بعدی </button>
</div>
