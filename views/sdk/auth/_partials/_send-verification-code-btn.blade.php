<button type="button" class="stable-theme primary sm w-100 send-code bs-0 {{ $class ?? '' }}"
        {!! setting('google_recaptcha_v3_status') ? 'onclick="sendVerificationCode(this)" data-size="invisible" data-sitekey="'.setting('_env_google_recaptcha_v3_site_key').'"' : 'data-jsc="ajax-request"' !!}
        {!! $attributes !!} data-ajax='{"route":"{{ $route ?? route('verification.send.code')}}"}'
>
    <i class="{{ isset($icon) && $icon ? $icon : '' }}"></i>
    {!! $text !!}
</button>
