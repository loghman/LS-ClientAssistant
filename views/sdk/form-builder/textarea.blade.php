<?php $r = rand(0, 999999); ?>

@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
     <label class="qLabel">{{ to_persian_num($placeholder) ?? ''  }}</label>

    <textarea name="{{ $name }}" id="var<?=$r?>" rows="2"
              style="height: auto" placeholder="شروع به نوشتن کنید ...."
              class="{{ $classes ?? '' }}">{{ $value ?? '' }}</textarea>
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm me-auto" data-required="var<?=$r?>"> ثبت و ادامه</button>
    @endif
</div>
