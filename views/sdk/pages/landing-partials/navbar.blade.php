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
        <a href="#sticky" class="btn sm gradient">
            <i class="i-bag"></i>
            <span class="typing">ثبت‌نام می‌کنم</span>
        </a>
    @endif
</div>