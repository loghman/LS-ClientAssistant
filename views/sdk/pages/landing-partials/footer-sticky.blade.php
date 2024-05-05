<div class="sticky">
    <div class="footer">
        @if ($currentUser)
            @if ($product['price']['main'] > 0)
                <button class="toggle-btn" data-jsc="ajax-request" style="z-index: 99;" data-after-success="replace"
                    data-target="#pay-content" data-stable="true"
                    data-ajax='{"route": "{{ route('landing.mini.payment.details', ['slug' => $product['slug']]) }}"}'>
                    @if ($product['final_price']['main'] > 0)
                        پرداخت و ثبت نام در دوره
                    @else
                        ثبت نام در دوره
                    @endif
                </button>
                <div id="pay-content" class="content">
                    <i class="spinner me-auto ms-auto"
                        style="--spinner-color: var(--primary); --spinner-size: 45px"></i>
                </div>
            @else
                <a class="btn btn-primary toggle-btn" role="button" aria-disabled="true"
                    href="{{ route('payment.qPay', [
                        'et' => base64_encode('lms_products'),
                        'ei' => $product['id'],
                        'slug' => $product['slug'],
                        'coupon' => $product['primaryCampaign']['coupon_label'] ?? null,
                    ]) }}">
                    <i class="icon i-debit-card"></i>
                    ثبت نام رایگان
                </a>
            @endif
        @else
            <a href="{{ setting('client_auth_index', route('auth.index')) . '?refer=' . request()->url() }}"
                class="btn primary-btn" style="width: 100%">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}" class="arrow-right"
                    width="20" height="20" alt="arrow">
                {{ $product['price']['main'] > 0 ? 'ورود برای پرداخت' : 'ورود برای ثبت نام' }}
            </a>
        @endif
    </div>
</div>
