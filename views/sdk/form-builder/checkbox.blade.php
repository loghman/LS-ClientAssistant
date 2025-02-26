@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ isset($expanded) && $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    <span class="t-title-lg">{{ $placeholder }}</span>
    @foreach($choices as $key => $value)
        <label class="checked-fill">
            <input name="{{ $name }}" value="{{ $key }}"
                   type="checkbox" {{ isset($checked) && $checked == $key ? 'checked' : '' }}>
            <span class="title">{{ $value }}</span>
        </label>
    @endforeach
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی</button>
    @endif
</div>