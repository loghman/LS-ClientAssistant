<i class="toggle-icon i-bottom" style="cursor: pointer"></i>
<span class="title justify-content-center text-center mb">همین الان ثبت نام کن</span>
@foreach ($gateways->get('data') as $gateway)
    @if (in_array($gateway['name_en'], ['snap', 'Snap', 'SnapPay', 'snappay']) &&
            (empty($eligibleResponse['successful']) ||
                $eligibleResponse['successful'] !== true ||
                $product['final_price']['main'] == 0))
        @continue
    @endif
    <a class="success"
        href="{{ route('payment.qPay', [
            'gateway' => $gateway['id'],
            'et' => base64_encode('lms_products'),
            'ei' => $product['id'],
            'slug' => $product['slug'],
            'coupon' => $product['primaryCampaign']['coupon_label'] ?? null,
        ]) }}">
        <span class="text">
            <span class="title">
                @if ($product['final_price']['main'] == 0)
                    <img style="width: 50px;height: 50px;" class="icon"
                        src="https://up.7learn.com/z/s/2024/05/hot-sale-qJP7.svg">
                    ثبت نام
                @else
                    <img style="width: 50px;height: 50px;" src="{{ $gateway['thumbnail'] }}"
                        alt="{{ $gateway['name_en'] }}" class="icon">
                    {{ $gateway['name_fa'] }}
                @endif
            </span>
            @if (in_array($gateway['name_en'], ['snap', 'Snap', 'SnapPay', 'snappay']))
                @if (!empty($eligibleResponse['response']['description']))
                    <span class="subtitle fa-number">{{ $eligibleResponse['response']['description'] }}</span>
                @endif
            @else
                @if (isset($product['primaryCampaign']) && !$gateway['isInstallmentPaymentAvailable'])
                    <span class="subtitle fa-number">با
                        {{ to_persian_num($product['primaryCampaign']['discount_amount']) }}</span>
                @endif
            @endif
        </span>
        <span class="text me-auto align-items-left text-left">
            @if (!$gateway['isInstallmentPaymentAvailable'])
                <span class="title">
                    @if ($product['price']['main'] > $product['final_price']['main'])
                        <span class="strike">{{ to_persian_num($product['price']['human']) }}</span>
                    @endif
                    {{ to_persian_num($product['final_price']['human']) }}
                </span>
            @else
                {{ to_persian_num($product['price']['human']) }}
            @endif
            <span class="subtitle">
                @if ($product['final_price']['main'] > 0)
                    @if ($gateway['isInstallmentPaymentAvailable'])
                        پرداخت اقساط
                    @else
                        پرداخت نقدی
                    @endif
                @else
                    ثبت نام کنید
                @endif
            </span>
        </span>
    </a>
@endforeach
