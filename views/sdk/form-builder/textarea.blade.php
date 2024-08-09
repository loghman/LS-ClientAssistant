<div class="step w-100">
    @if(isset($label))
        <p>{{ $label }}</p>
    @endif
    <textarea name="{{ $name }}" id="var<?=$var['id']?>" rows="2" style="height: auto" placeholder="{{ $placeholder ?? ''  }}"
            class="{{ $classes ?? '' }}">{{ $value ?? '' }}</textarea>
    <button type="button" class="d-none m-submit next-step sm float-start" data-required="var<?=$var['id']?>"> ثبت و بعدی </button>
</div>