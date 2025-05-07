@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
     <label class="qLabel">{{ to_persian_num($placeholder) ?? ''  }}</label>
    <input type="text" name="{{ $name }}" class="{{ $classes ?? '' }}"
           placeholder="شروع به نوشتن کنید ..." value="{{ $value ?? '' }}">
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی </button>
    @endif
</div>