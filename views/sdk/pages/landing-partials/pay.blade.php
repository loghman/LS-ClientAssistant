<h2 class="pay-title">
@if($product['final_price']['main'] > 0)
    <i class="fa-solid fa-credit-card" style="margin-bottom: 20px; font-size: 40px; color: var(--primary);"></i><br>
    <span class="fasl">ثبت نام</span> و پرداخت اینترنتی
@else
    <i class="fa-solid fa-gift" style="margin-bottom: 20px; font-size: 40px; color: var(--primary);"></i><br>
    به <span class="fasl">رایگان</span> ثبت نام کنید
@endif
<br><small style="font-size: 15px; font-weight: 300;">
    <?=$product['title']?><br>
    
    @include('sdk.pwa.shopping._partials.priceline',['course'=>$product])
</small> 
<style>
.gw-logo{
    position: relative;
}
.gw-logo span.offer {
    position: absolute;
    top: 14px;
    left: 18px;
    font-size: 13px;
    font-weight: 500;
    color: var(--primary-50);
}
</style>
</h2>
@foreach ($gateways->get('data') as $gateway)
    @php($isSnap = str_contains(strtolower($gateway['name_en']), 'snap'))
    @if($isSnap && (empty($eligibleResponse['successful'])
            || $eligibleResponse['successful'] !== true
            || $product['final_price']['main'] == 0))
        @continue
    @endif
    <a class="success gateway-item" href="{{ route('payment.qPay', [
            'gateway' => $gateway['id'],
            'et' => base64_encode('lms_products'),
            'ei' => $product['id'],
            'slug' => $product['slug'],
            'coupon' => $product['primaryCampaign']['coupon_label'] ?? null,
            'payback_url' => site_url('pwa/payback/###payment_id###')
        ]) }}">
        <div class="text gw-logo">
            @if(isset($product['primaryCampaign']))
                <span class="offer fa-number"><?= to_persian_num($product['primaryCampaign']['discount_amount']) ?></span>
                <!-- <span class="offer fa-number"><?= to_persian_num(str_replace(' تخفیف','',$product['primaryCampaign']['discount_amount'])) ?></span> -->
            @endif
            @if ($product['final_price']['main'] == 0)
                <i class="fa-solid fa-gift" style="margin-left: 5px; color: var(--primary);"></i>
                ثبت نام رایگان
            @else
                <img src="{{ $gateway['thumbnail'] }}"  alt="{{ $gateway['name_en'] }}" class="icon">
                <div>
                @if($isSnap)
                    {{ $eligibleResponse['response']['title_message'] }}
                @else
                    {{ $gateway['name_fa'] }}
                @endif
            </div>
            @endif
        </div>
        <div class="text gw-desc">
            <div>
            @if($isSnap)
                @if(!empty($eligibleResponse['response']['description']))
                    <span class="subtitle fa-number">{{ $eligibleResponse['response']['description'] }}</span>
                @endif
            @endif
            </div>
            @if((!$gateway['isInstallmentPaymentAvailable'] || $gateway['isDiscountAvailable']))
                <span class="title">
                    <span>
                        @if($product['final_price']['main'] == 0) 
                        برای فعال شدن سریع محصول <b>کلیک کنید</b>                   
                        @else
                            @if(!$isSnap)
                                {{ to_persian_num($product['final_price']['readable']) }} تومان
                            @endif
                        @endif
                    </span>
                </span>
            @else
                {{ to_persian_num($product['price']['readable']) }} تومان
            @endif
            <span class="subtitle">
                @if($product['final_price']['main'] > 0)
                    @if(!$gateway['isInstallmentPaymentAvailable'])
                        پرداخت نقدی
                    @endif
                @endif
            </span>
        </div>
    </a>
@endforeach
