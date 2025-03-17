<ul class="list">
    @if(count($invoice['lmsProductItems']) > 0)
        @foreach($invoice['lmsProductItems'] as $item)
            <li class="item">
                <span class="t-text">{{ $item['entity']['title'] }}</span>
                <span class="t-text fw-normal">
                    @if($item['price']['main'] !== $item['final_price']['main'])
                        <del>{{ $item['price']['readable'] }}</del>
                    @endif
                  <span class="prc">{{ $item['final_price']['readable'] }} </span>
                  <span class="capacity-full">تومان</span>
                  <span class="capacity-short">ت</span>
                </span>
            </li>
        @endforeach
    @endif
    <li class="item sum">
        <span class="t-text bold">{{ $invoice['items_count'] }} محصول</span>
        <span class="t-text bold">
            @if($invoice['total_price']['main'] !== $invoice['final_price']['main'])
                <del>{{ $invoice['total_price']['readable'] }}</del>
            @endif
            <span class="prc">{{ $invoice['final_price']['readable'] }} </span>
            <span class="capacity-full">تومان</span>
            <span class="capacity-short">ت</span>
        </span>
    </li>
    <li class="item last">
        @if($invoice['is_installment'])
            <span class="t-title">پرداخت اقساطی</span>
            <span class="t-title">{{ count($invoice['payments']) }} قسط</span>
        @else
            <span class="t-title">پرداخت نقدی</span>
        @endif
    </li>
</ul>