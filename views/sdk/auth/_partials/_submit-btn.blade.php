@if(setting('google_recaptcha_v3_status'))
    <button class="g-recaptcha btn-primary w-100 btn-submit sm d-none" type="button" data-size="invisible"
            data-callback="{{ $callback }}" data-sitekey="{{ setting('_env_google_recaptcha_v3_site_key') }}">
        {!! $content !!}
    </button>
@else
    <button class="btn-primary w-100 btn-submit sm d-none">{!! $content !!}</button>
@endif
<button class="gray-hover w-100 sm">مرورگر شما مشکل دارد! امکان ورود نیست!</button>
<p class="text-danger alert-text">لطفا صفحه مرورگر خود را رفرش کنید.</p>
