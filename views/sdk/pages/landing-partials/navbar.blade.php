<div class="navbar">
    <a href="{{ site_url('') }}" class="brand">
        <img src="{{ $product['landing_logo'] }}" alt="{{ $brandNameEn }} logo">
    </a>
    @if(is_null(current_user_id()))
        <a href="{{ route('auth.index') }}" class="btn transparent">
            <i class="i-log-in-2"></i>
            ورود به سایت
        </a>
    @endif
</div>