@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <select name="{{ $name }}" class="{{ $classes ?? '' }}">
        <option value="1" {{ isset($selected) && $selected == '1' ? 'selected' : '' }}>بله</option>
        <option value="0" {{ isset($selected) && $selected == '0' ? 'selected' : '' }}>خیر</option>
    </select>
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی</button>
    @endif
</div>