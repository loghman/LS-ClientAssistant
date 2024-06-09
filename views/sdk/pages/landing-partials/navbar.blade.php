<div class="navbar">
    <a href="{{ site_url('') }}" class="brand">
        <img src="{{ $product['landing_logo'] }}" alt="{{ $brandNameEn }}">
    </a>
    @if(is_null(current_user_id()))
        <a href="{{ setting('client_auth_index', route('auth.index')) . "?refer=" . request()->url() }}" class="btn transparent">
            <i class="i-log-in-2"></i>
            ورود به سایت
        </a>
    @else
        <button class="sticky-toggle-btn sm" data-jsc="ajax-request" style="z-index: 99; opacity: 1;" data-after-success="replace" data-target="#pay-content" data-stable="true" data-ajax='{"route": "{{ route('landing.mini.payment.details', ['slug' => $product['slug']]) }}"}'>
            <i class="i-bag animation-tada"></i>
            ثبت‌نام می‌کنم
        </button>
    @endif
</div>