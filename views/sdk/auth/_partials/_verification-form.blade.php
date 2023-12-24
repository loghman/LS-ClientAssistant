@php($isReset = isset($reset) && $reset)
<form action="{{ $isReset ? route('auth.reset-password.verify') : route('auth.login') }}" method="post"
      data-jsc="ajax-form" data-after-success="refresh" id="verification-form"
      class="card wizard-item card-verification">

    <input type="hidden" name="backurl" value="{{ $isReset ? route('auth.passwordResetForm') : site_url() }}">
    <input type="hidden" name="provider" value="otp">
    <input type="hidden" name="input" value="" id="verification-user-input">
    @if($isReset)
        <input type="hidden" name="password-reset" value="1">
    @endif

    <div class="header">
        <button type="button" class="icon sm lg white wizard-cta" data-wizard="{{ $isReset ? '.card-reset' : '.card-auth' }}">
            <i class="si-arrow-right-r"></i>
        </button>
        <h3 class="card-heading">ثبت کد تایید</h3>
    </div>

    <div class="content">
        @include('sdk.auth._partials._verify-opt-section')
        @include('sdk.auth._partials._submit-btn', ['content' => 'تایید', 'callback' => 'submitVerificationForm'])
        @include('sdk.auth._partials._send-verification-code-btn', [
            'text' => '<span>ارسال مجدد (</span><span><span class="text-danger-85" data-start="120" data-jsc="countdown">120</span> ثانیه</span><span>)</span>',
            'attributes' => 'data-after-success="wizard" data-wizard=".card-verification"'
        ])
    </div>
</form>
