@if(isset($label))
    <label>{{ $label }}</label>
@endif
<select name="{{ $name }}" class="{{ $classes ?? '' }}">
    <option value="1" {{ isset($selected) && $selected == '1' ? 'selected' : '' }}>بله</option>
    <option value="0" {{ isset($selected) && $selected == '0' ? 'selected' : '' }}>خیر</option>
</select>
