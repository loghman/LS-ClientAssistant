<div class="verify-email">
    <div class="input-group">
        <label for="email">تایید ایمیل</label>
        <input id="email" type="text" name="input" style="background-color: #fff !important;"
               @if($emailVerified) disabled  @endif value="{{ $user['email'] }}" class="ltr">
        @if($emailVerified)
            <button type="button" class="sm text-success fw-700"><i class="si-check-r"></i></button>
        @else
            @include('sdk.auth._partials._send-verification-code-btn', [
                'text' => '<span>ارسال کد</span>',
                'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"',
                'route' => route('auth.updateEmail')
            ])
        @endif
    </div>
    @if(!$emailVerified)
        <form action="{{ route('verification.fields.verify') }}" class="verify mt-3 d-none" id="email-form"
              method="post" data-jsc="ajax-form" data-after-success="closure" data-fn="verifyAction">

            <div class="d-flex flex-column" style="gap: calc(var(--base-gutter));">
                <input type="hidden" name="auth_method" value="OtpBased">
                <input type="hidden" name="input" value="{{ $user['email'] }}">
                <input type="hidden" name="backurl" value="">

                @include('sdk.auth._partials._verify-opt-section', ['userLogin' => $user['email']])
                @include('sdk.auth._partials._submit-btn', ['content' => 'تایید', 'callback' => 'submitEmailForm'])
                @include('sdk.auth._partials._send-verification-code-btn', [
                    'text' => '<span>ارسال مجدد (</span><span class="text-danger-80" data-start="120" data-jsc="countdown">120</span><span>ثانیه</span><span>)</span>',
                    'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"',
                    'route' => route('auth.updateEmail')
                ])
            </div>
        </form>
    @endif
</div>