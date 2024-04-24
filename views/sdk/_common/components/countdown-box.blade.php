<div class="countdown {{ $class ?? '' }}" data-date="{{ $date ?? '' }}"
     style="{{ $bg ? "--bg:{$bg}" : '' }}">
    <div>
        <span class="countdown-title seconds">۰</span>
        <small class="countdown-subtitle">ثانیه</small>
    </div>
    <div>
        <span class="countdown-title minutes">۰</span>
        <small class="countdown-subtitle">دقیقه</small>
    </div>
    <div>
        <span class="countdown-title hours">۰</span>
        <small class="countdown-subtitle">ساعت</small>
    </div>
    {{--    Sorry Milad DR Forced Me To Comment Day Section--}}
    {{--    <div class="{{ $daysClass ?? '' }}">--}}
    {{--        <span class="countdown-title days">۰</span>--}}
    {{--        <small class="countdown-subtitle">روز</small>--}}
    {{--    </div>--}}
</div>