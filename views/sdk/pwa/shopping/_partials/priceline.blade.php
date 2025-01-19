<small class="priceline subtitle lg opacity-75">
    @if($course['price']['main'] == 0)
        <span>رایگان</span>
    @elseif($course['price']['main'] == $course['final_price']['main'])
        <span><?=to_persian_num($course['price']['readable'])?> تومان</span>
    @else
        <del style="margin-left: 10px"><?=to_persian_num($course['price']['readable'])?> تومان</del> <span><?=to_persian_num($course['final_price']['readable'])?> تومان</span>
    @endif
</small>