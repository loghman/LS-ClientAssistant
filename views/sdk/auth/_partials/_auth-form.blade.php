<div method="post" action="{{ route('auth.pre.login') }}" id="pre-login" data-jsc="ajax-form" data-stable="true"
     data-after-success="wizard" data-wizard=".card-login" class="card wizard-item active card-auth">
    <div class="header">
        <small class="t-small text-secondary">اگر حساب کاربری دارید، وارد شوید:</small>
    </div>
    <div class="content">
        @php($userLoginFields = get_user_login_fields())
        <input class="sm text-center ltr en-number {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}"
               name="input" placeholder="{{ auth_label() }} خود را وارد کنید"
               type="{{ count($userLoginFields) == 1 && in_array('email', $userLoginFields) ? 'email' : 'text' }}">

        @if(setting('can_user_logged_in_with_password', true))
            @include('sdk.auth._partials._submit-btn', [
                'content' => '<span>ورود</span><i class="si-arrow-left-r"></i>',
                'callback' => 'submitPreLoginForm'
             ])
        @else
            @php($userLoginFields = get_user_login_fields())
            @if (in_array('email', $userLoginFields) || in_array('mobile', $userLoginFields))
                @include('sdk.auth._partials._send-verification-code-btn', [
                    'text' => '<span>ورود با کد یکبار مصرف</span>',
                    'attributes' => 'data-after-success="wizard" data-wizard=".card-verification"'
                ])
            @endif
        @endif

        <div class="middle-line t-small text-secondary my-2 my-sm-3">یا</div>
        <div class="card-row sm flex-column flex-sm-row">
            <button type="button" class="w-100 w-sm-50 sm wizard-cta" data-wizard=".card-register">
                <span>ایجاد حساب کاربری</span>
            </button>
            {{--<button type="button" class="outline-secondary w-100 w-sm-50 sm">
                    <img src="{{ asset_url('img/icons/google.svg') }}" class="icon">
                    <span>ورود با گوگل</span>
                </button>--}}
        </div>
    </div>
</div>
