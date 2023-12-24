<button type="button" class="white sm w-100 send-code {{ $class ?? '' }}"
        {!! setting('google_recaptcha_v3_status') ? 'onclick="sendVerificationCode(this)" data-size="invisible" data-sitekey="'.setting('_env_google_recaptcha_v3_site_key').'"' : 'data-jsc="ajax-request"' !!}
        {!! $attributes !!} data-ajax='{"route":"{{ route('verification.send.code') }}"}'
>
    <i class="{{ isset($icon) && $icon ? $icon : 'si-comment-text-r' }}"></i>
    {!! $text !!}
</button>
