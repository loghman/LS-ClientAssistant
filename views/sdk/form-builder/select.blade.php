@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ $expanded ? 'expanded' : '' }} w-100">
    @if(isset($label))
        <label>{{ $label }}</label>
    @endif
    <select name="{{ $name }}" class="{{ $classes ?? 'select2' }}" placeholder="{{ $placeholder ?? ''  }}">
        @foreach($choices as $key => $value)
            <option value="{{ $key }}" {{ isset($selected) && $selected == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
    @if($isMinimal)
        <button type="button" class="d-none m-submit next-step sm float-start"> ثبت و بعدی</button>
    @endif
</div>