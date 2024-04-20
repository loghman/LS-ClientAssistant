<div class="verify-mobile">
    <form action="{{ route('auth.updateMobile') }}"
          method="post"
          class="mt-3"
          data-jsc="ajax-form"
          data-after-success="closure"
          data-fn="inputUpdate">

        <div class="input-group overflow-hidden">
            <label for="mobile" class="sm min-w-fit">تایید موبایل</label>
            @if(!$mobileVerified)
                <button type="button" class="sm text-secondary px-3 input-edit"><i class="si-edit"></i></button>
            @endif
            <input id="mobile" type="text" name="input" style="background-color: #fff !important;"
                   disabled value="{{ $user['mobile'] }}" class="ltr sm" placeholder="شماره موبایل شما ...">
            @if($mobileVerified)
                <button type="button" class="sm text-success fw-700"><i class="si-check-r"></i></button>
            @else
                @include('sdk.auth._partials._send-verification-code-btn', [
                    'text' => '<span>ارسال کد <span class="d-none d-sm-inline">پیامکی</span></span>',
                    'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"',
                ])
                <button type="submit" class="sm text-secondary px-3 d-none">ذخیره</button>
            @endif
        </div>
    </form>
    @if(!$mobileVerified)
        <form action="{{ route('verification.fields.verify') }}" class="verify mt-3 d-none" id="mobile-form"
              method="post" data-jsc="ajax-form" data-after-success="closure" data-fn="verifyAction">

            <div class="d-flex flex-column" style="gap: calc(var(--base-gutter));">
                <input type="hidden" name="input" value="{{ $user['mobile'] }}">

                @include('sdk.auth._partials._verify-opt-section', ['userLogin' => $user['mobile']])
                @include('sdk.auth._partials._submit-btn', ['content' => 'تایید', 'callback' => 'submitMobileForm'])
                @include('sdk.auth._partials._send-verification-code-btn', [
                    'text' => '<span>ارسال مجدد (</span><span data-start="120" data-jsc="countdown">120</span><span>ثانیه</span><span>)</span>',
                    'attributes' => 'data-after-failed="failedSentToken" data-after-success="closure" data-fn="afterSentToken" data-before-send="addInputValue"'
                ])
            </div>
        </form>
    @endif
</div>