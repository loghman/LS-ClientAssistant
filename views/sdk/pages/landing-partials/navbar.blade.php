<div class="navbar">
    <a href="{{ site_url('') }}" class="brand">
        <img src="{{ $product['landing_logo'] }}" alt="{{ $brandNameEn }} logo">
    </a>
    @if(is_null(current_user_id()))
        <a href="{{ route('auth.index') }}" class="btn transparent">
            <i class="i-log-in-2"></i>
            ورود به سایت
        </a>
    @else
        <a class="btn transparent" href="{{ route('panel.course.list') }}">
            <i class="si-play-circle-r"></i>
            دوره‌های من
        </a>
    @endif
</div>