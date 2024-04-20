<div class="verify-email">
    <form action="{{ route('auth.updateEmail') }}" method="post"
          data-jsc="ajax-form" data-after-success="closure" data-fn="inputUpdate">
        <div class="input-group overflow-hidden">
            <label class="min-w-fit sm" for="email">تایید ایمیل</label>
            @if(!$emailVerified)
                <button type="button" class="sm text-secondary px-3 input-edit"><i class="si-edit"></i></button>
            @endif
            <input id="email" type="text" name="input" style="background-color: #fff !important;"
                   disabled value="{{ $user['email'] }}" class="sm ltr" placeholder="ایمیل شما...">
            @if($emailVerified)
                <button type="button" class="sm text-success fw-700"><i class="si-check-r"></i></button>
            @else
                @include('sdk.auth._partials._send-verification-code-btn', [
                    'text' => '<span>ارسال کد <span class="d-none d-sm-inline">به ایمیل</span></span>',
                    'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"'
                ])
                <button type="submit" class="sm text-secondary px-3 d-none">ذخیره</button>
            @endif
        </div>
    </form>
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
                    'text' => '<span>ارسال مجدد (</span><span data-start="120" data-jsc="countdown">120</span><span>ثانیه</span><span>)</span>',
                    'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"'
                ])
            </div>
        </form>
    @endif
</div>