<div class="content gap-md gap-xs--lg">

    <div class="card-row justify-content-between">
        <small class="card-subtitle">قیمت کل</small>
        <span class="card-title fa-number">{{ number_format($cart['total_price']) }} تومان</span>
    </div>

    @if(isset($cart['coupon']) && $cart['coupon'])
        <div class="card-row justify-content-between">
            <small class="card-subtitle">
                <span class="d-block text-end">تخفیف</span>
                <button class="danger sm px-2 py-1" data-jsc="modal#action-modal"
                        data-modal='{"action":"{{ site_url("coupon/unapply/{$cart['id']}/{$cart['coupon']['id']}") }}","header":"حذف کدتخفیف","message":"آیا قصد دارید کدتخفیف را حذف کنید؟","btn":"حذف"}'>
                    <i class="si-cross-r fs-15"></i>
                    <span class="fs-13">{{ $cart['coupon']['label'] }}</span>
                </button>
            </small>
            <span class="card-title fa-number">{{ number_format($cart['total_price'] - $cart['final_price']) }} تومان</span>
        </div>
    @elseif(count($cart['items']) > 0)
        @foreach($cart['items'] as $item)
            @if(!isset($item['coupon']))
                @continue
            @endif
            <div class="card-row justify-content-between">
                <small class="card-subtitle">
                    <span class="d-block text-end">تخفیف</span>
                    <button class="danger sm px-2 py-1" data-jsc="modal#action-modal"
                            data-modal='{"action":"{{ site_url("coupon/unapply/{$cart['id']}/{$item['coupon']['id']}") }}","header":"حذف کدتخفیف","message":"آیا قصد دارید کدتخفیف را حذف کنید؟","btn":"حذف"}'>
                        <i class="si-cross-r fs-15"></i>
                        <span class="fs-13">{{ $item['coupon']['label'] }}</span>
                    </button>
                </small>
                <span class="card-title fa-number">{{ number_format($item['price'] - $item['final_price']) }} تومان</span>
            </div>
        @endforeach
    @endif

    <div class="w-100 bb"></div>
    <div class="card-row justify-content-between">
        <small class="card-subtitle">قابل پرداخت</small>
        <span class="card-title fa-number">{{ $cart['final_price']>0 ? number_format($cart['final_price']) : '' }} تومان</span>
    </div>
</div>

<button class="d-none show-payment-content" data-jsc="ajax-request" type="button"
        data-after-success="replace" data-target="#pay-content" data-stable="true"
        data-ajax='{"route": "{{ route('cart.checkout.gateways') }}"}'>
    پرداخت و تکمیل ثبت نام
</button>

<a href="{{ route('payment.requestLink', ['cart' => $cart['id'], 'gateway' => $defaultGateway['id']]) }}"
   class="btn w-100" id="payment-btn">پرداخت و تکمیل ثبت نام</a>