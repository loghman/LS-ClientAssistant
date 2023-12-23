<form action="{{ route('auth.login') }}" method="post" class="card wizard-item card-login"
      data-jsc="ajax-form" data-after-success="refresh" id="login-form">
    <input type="hidden" name="backurl" value="{{ site_url() }}">
    <input type="hidden" name="input" value="" id="login-user-input">
    <input type="hidden" name="provider" value="password">

    <div class="header">
        <button type="button" class="icon sm lg white wizard-cta" data-wizard=".card-auth">
            <i class="si-arrow-right-r"></i>
        </button>
        <h3 class="card-heading">ورود به سون لرن</h3>
    </div>

    <div class="content">
        <span class="badge bg-warning text-secondary bg-warning-30 lh-2 fs-14 py-3 px-4">با توجه به تغیر پلتفرم سون لرن تمامی رمز عبورهای گذشته نامعتبرند. لطفا از طریق کد یکبار مصرف وارد شوید و رمز عبور خود را تغیر دهید.</span>
        <input type="password" name="password" placeholder="رمز عبور" required="required"
               class="sm ltr text-center {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}">

        @include('sdk.auth._partials._submit-btn', ['content' => 'ورود', 'callback' => 'submitLoginForm'])

        @php($userLoginFields = get_user_login_fields())
        @if (in_array('email', $userLoginFields) || in_array('mobile', $userLoginFields))
            @include('sdk.auth._partials._send-verification-code-btn', [
                'text' => '<span>ورود با کد یکبار مصرف</span>',
                'attributes' => 'data-after-success="wizard" data-wizard=".card-verification"'
            ])
        @endif
        <a href="{{ route('auth.passwordReset') }}" class="btn white sm w-100">رمز خود را فراموش کرده‌ام</a>
    </div>
</form>
