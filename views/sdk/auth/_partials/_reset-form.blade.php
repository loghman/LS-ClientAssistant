<form class="card card-reset wizard-item active" action="{{ route('verification.send.code')  }}" id="reset-form"
      method="post" data-jsc="ajax-form" data-after-success="wizard" data-wizard=".card-verification">
    <input type="hidden" name="auth_method" value="OtpBased">

    <div class="header">
        <small class="t-small text-secondary">بازیابی رمز عبور</small>
    </div>

    <div class="content">
        <input type="text" name="input" placeholder="{{ auth_label() }}"
               class="sm text-center ltr en-number {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}">

        @include('sdk.auth._partials._submit-btn', ['content' => 'بازیابی', 'callback' => 'submitResetForm'])
    </div>
</form>
