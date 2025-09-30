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
        .gw-logo {
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
                <span class="offer fa-number"><?=to_persian_num($product['primaryCampaign']['discount_amount'])?></span>
            @endif

            @if ($product['final_price']['main'] == 0)
                <i class="fa-solid fa-gift" style="margin-left: 5px; color: var(--primary);"></i>
                ثبت نام رایگان
            @else
                <img src="{{ $gateway['thumbnail'] }}" alt="{{ $gateway['name_en'] }}" class="icon">
                <div>
                    @if (!empty($gateway['title']))
                        {{ $gateway['title'] }}
                    @else
                        {{ $gateway['name_fa'] }}
                    @endif
                </div>
            @endif
        </div>
        <div class="text gw-desc">
            @if (!empty($gateway['description']))
                <span class="subtitle fa-number">{{ $gateway['description'] }}</span>
            @else
                @if((!$gateway['is_installment_payment_available'] || $gateway['is_discount_available']))
                    <span class="title">
                        <span>
                            @if($product['final_price']['main'] == 0)
                                برای فعال شدن سریع محصول <b>کلیک کنید</b>
                            @else
                                {{ to_persian_num($product['final_price']['readable']) }} تومان
                            @endif
                        </span>
                    </span>
                @else
                    @if($product['price']['main'] == 0)
                        برای فعال شدن سریع محصول <b>کلیک کنید</b>
                    @else
                        {{ to_persian_num($product['price']['readable']) }} تومان
                    @endif
                @endif
            @endif

            <span class="subtitle">
                @if($product['final_price']['main'] > 0)
                    @if(!$gateway['is_installment_payment_available'])
                        پرداخت نقدی
                    @endif
                @endif
            </span>
        </div>
    </a>
@endforeach