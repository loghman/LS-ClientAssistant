<div class="{{ isset($type) && $type === 'minimal' ? 'step' : '' }} w-100 {{ isset($expanded) && $expanded ? 'expanded' : '' }}"
     data-qid="{{ $variable['id'] }}">
    <label class="qLabel">{{ to_persian_num($placeholder) ?? ''  }}</label>

    @foreach($choices as $key => $value)
        <label class="qOption" for="o{{$variable['id']}}{{$key}}">
            <input type="radio" id="o{{$key}}" name="{{ $name }}"
                   value="{{ $key }}" {{ isset($selected) && $selected == $key ? 'selected' : '' }}>
            {{ $value }}
        </label>
    @endforeach
</div>
