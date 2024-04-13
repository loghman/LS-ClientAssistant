<div class="sticky">
    <div class="footer">
        @if($currentUser)
            @if($product['price']['main']>0)
                <button class="toggle-btn">
                    پرداخت و ثبت نام در دوره
                </button>
            @else
                <a  class="btn btn-primary toggle-btn" role="button" aria-disabled="true"
                    href="{{ route('payment.qPay', [
                            'gateway' => $defaultGateway['id'],
                            'et' => base64_encode('lms_products'),
                            'ei' => $product['id'],
                            'slug' => $product['slug'],
                            'coupon' => $product['primaryCampaign']['coupon_label'] ?? null
                        ]) }}">
                    <i class="icon i-debit-card"></i>
                    ثبت نام رایگان
                </a>
            @endif
        @else
            <a href="{{ route('auth.index') }}" class="btn primary-btn" style="width: 100%">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}"
                     class="arrow-right" width="20" height="20" alt="arrow">
                {{ $product['price']['main']>0? "ورود برای پرداخت" : "ورود برای ثبت نام" }}
            </a>
        @endif
    </div>
    <div class="content">
        <i class="toggle-icon i-bottom"></i>
        <span class="title justify-content-center text-center mb">همین الان ثبت نام کن</span>
        <a class="success"
           href="{{ route('payment.qPay', [
                            'gateway' => $defaultGateway['id'],
                            'et' => base64_encode('lms_products'),
                            'ei' => $product['id'],
                            'slug' => $product['slug'],
                            'coupon' => $product['primaryCampaign']['coupon_label'] ?? null
                        ]) }}">
            <span class="text">
                <span class="title">
                    <i class="icon i-debit-card"></i>
                    پرداخت نقدی
                </span>
                @isset($product['primaryCampaign'])
                    <span class="subtitle fa-number">با {{ to_persian_num($product['primaryCampaign']['discount_amount']) }}</span>
                @endisset
            </span>
            <span class="text me-auto align-items-left text-left">
                <span class="title">
                    @if($product['price']['main'] > $product['final_price']['main'])
                        <span class="strike">{{ to_persian_num($product['price']['human']) }}</span>
                    @endif
                    {{ to_persian_num($product['final_price']['human']) }}
                </span>
                <span class="subtitle">پرداخت کن</span>
            </span>
        </a>
    </div>
</div>