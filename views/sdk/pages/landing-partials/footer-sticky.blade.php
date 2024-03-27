<div class="sticky">

    <div class="footer">
        @if($currentUser)
            <button class="toggle-btn">
                <i class="i-edit"></i>
                پرداخت و ثبت‌نام در دوره
            </button>
        @else
            <a href="{{ route('auth.index') }}" class="btn primary-btn" style="width: 100%">
                <img src="{{ core_asset('resources/assets/img/clients/mini-landing/arrow.svg') }}"
                     class="arrow-right" width="20" height="20" alt="arrow">
                ورود برای پرداخت
            </a>
        @endif
    </div>
    <div class="content">
        <i class="toggle-icon i-bottom"></i>
        <span class="title justify-content-center text-center mb">همین الان ثبت نام کن</span>

        <a class="success"
           href="{{ route('payment.qPay', ['gateway' => $defaultGateway['id'], 'et' => base64_encode('lms_products'), 'ei' => $product['id'], 'slug' => $product['slug']]) }}">
            <span class="text">
                <span class="title">
                    <i class="icon i-debit-card"></i>
                    پرداخت نقدی
                </span>
            </span>
            <span class="text me-auto align-items-left text-left">
                <span class="title">
                    {{ $product['price']['human'] }}
                </span>
                <span class="subtitle">پرداخت کن</span>
            </span>
        </a>
    </div>
    {{--<div class="content">
        <i class="toggle-icon i-bottom"></i>
        <span class="title justify-content-center text-center mb">یکی از روش های زیر رو انتخاب کن</span>
        <a class="success" href="">
            <span class="text">
                <span class="title">
                    <i class="icon i-debit-card"></i>
                    پرداخت نقدی</span>
                <span class="subtitle">با ۱۵٪ تخفیف</span>
            </span>
            <span class="text me-auto align-items-left text-left">
                <span class="title">
                    <span class="strike">۳.۹</span>
                    ۲.۶ میلیون
                </span>
                <span class="subtitle">پرداخت کن</span>
            </span>
        </a>
        <a href="">
            <span class="text">
                <span class="title">
                    <img src="assets/img/snapp-pay.svg" alt="" class="icon">
                    پرداخت اقساط</span>
                <span class="subtitle">۴ قسط ماهانه</span>
            </span>
            <span class="text me-auto align-items-left text-left">
                <span class="title">
                    ۳.۹ میلیون
                </span>
                <span class="subtitle">پرداخت قسط اول، ۲.۹ میلیون</span>
            </span>
        </a>
    </div>--}}
</div>