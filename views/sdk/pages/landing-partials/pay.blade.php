<i class="toggle-icon i-bottom" style="cursor: pointer"></i>
<h2 class="pay-title">
<?= $product['final_price']['main'] > 0 ? '<span class="fasl">ثبت نام</span> و انتخاب روش پرداخت' : 'به <span class="fasl">رایگان</span> ثبت نام کنید' ?>
</h2> 
@foreach ($gateways->get('data') as $gateway)
    @php($isSnap = str_contains(strtolower($gateway['name_en']), 'snap'))
    @if($isSnap && (empty($eligibleResponse['successful'])
            || $eligibleResponse['successful'] !== true
            || $product['final_price']['main'] == 0))
        @continue
    @endif
    <a class="success gateway-item"
        href="{{ route('payment.qPay', [
            'gateway' => $gateway['id'],
            'et' => base64_encode('lms_products'),
            'ei' => $product['id'],
            'slug' => $product['slug'],
            'coupon' => $product['primaryCampaign']['coupon_label'] ?? null,
        ]) }}">
        <div class="text gw-logo">
                @if ($product['final_price']['main'] == 0)
                    <img style="width: 50px;height: 28px;" class="icon" src="https://up.7learn.com/z/s/2024/05/hot-sale-qJP7.svg">
                    ثبت نام رایگان
                @else
                    <img style="width: 50px;height: 50px;" src="{{ $gateway['thumbnail'] }}"  alt="{{ $gateway['name_en'] }}" class="icon">
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
            @else
                @if(isset($product['primaryCampaign']) && !$gateway['isInstallmentPaymentAvailable'])
                    <span class="subtitle fa-number">با
                        {{ to_persian_num($product['primaryCampaign']['discount_amount']) }}</span>
                @endif
            @endif
            </div>
            @if(!$gateway['isInstallmentPaymentAvailable'] || $gateway['isDiscountAvailable'])
                <span class="title">
                    @if($product['price']['main'] > $product['final_price']['main'])
                        <span class="strike">{{ to_persian_num($product['price']['human']) }}</span>
                    @endif
                    <span>
                        @if($product['final_price']['main'] == 0) 
                        برای فعال شدن سریع محصول <b>کلیک کنید</b>                    
                        @else
                        {{ to_persian_num($product['final_price']['human']) }}
                        @endif
                    </span>
                </span>
            @else
                {{ to_persian_num($product['price']['human']) }}
            @endif
            <span class="subtitle">
                @if($product['final_price']['main'] > 0)
                    @if($gateway['isInstallmentPaymentAvailable'])
                        پرداخت اقساط
                    @else
                        پرداخت نقدی
                    @endif
                @endif
            </span>
        </div>
    </a>
@endforeach