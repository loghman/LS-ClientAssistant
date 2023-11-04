<form class="input-group lg solid gap-fix input-stable" data-jsc="ajax-form" data-after-success="refresh"
        action="{{ site_url("coupon/apply/{$cart['id']}") }}" method="post">
    <input type="hidden" name="backurl" value="{{ route('cart.checkout') }}">

    <input type="text" name="coupon" placeholder="کد تخفیف را وارد کنید ...">
    <button type="submit" class="white">
        <span>ثبت</span><i class="si-arrow-left-r"></i>
    </button>
</form>
