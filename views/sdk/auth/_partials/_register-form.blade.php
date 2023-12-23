<div action="{{ route('auth.register') }}" method="post" class="card wizard-item card-register"
     data-jsc="ajax-form" data-after-success="refresh" id="register-form">
    <input type="hidden" name="backurl" value="{{ route('verification.fields.verify') }}">
    <input type="hidden" name="provider" value="password">

    <div class="header">
        <button type="button" class="icon sm lg white wizard-cta" data-wizard=".card-auth">
            <i class="si-arrow-right-r"></i>
        </button>
        <h3 class="card-heading">ایجاد حساب کاربری</h3>
    </div>

    <div class="content">
        @php($availableRegistrationFields = \Ls\ClientAssistant\Helpers\Config::get('auth.available_registration_fields'))
        @php($registrationFields = get_registration_fields())
        @foreach($registrationFields as $field)
            @if(in_array($field, ['password', 'sex']))
                @continue
            @endif
            <input class="sm text-center {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}" name="{{ $field }}"
                   type="{{ $field == 'email' ? 'email' : 'text' }}"
                   placeholder="{{ $availableRegistrationFields[$field] ?? $field }}" autocomplete="new">
        @endforeach
        @if(in_array('sex', $registrationFields))
            <select class="sm text-center" name="sex">
                <option value="" disabled selected>جنسیت</option>
                <option value="male">آقا</option>
                <option value="female">خانوم</option>
            </select>
        @endif
        @if(in_array('password', $registrationFields))
            <input type="password" name="password" class="sm text-center {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}"
                   autocomplete="new-password" placeholder="رمز عبور">
            <input type="password" name="password_confirmation" class="sm text-center {{ setting('google_recaptcha_v3_status') ? 'recaptcha-submit' : '' }}"
                   autocomplete="new-password" placeholder="تکرار رمز عبور">
        @endif

        @include('sdk.auth._partials._submit-btn', ['content' => 'ثبت نام', 'callback' => 'submitRegisterForm'])

        <small class="t-small text-secondary pt-3">
            <a class="text-primary" href="#">قوانین</a>
            <span>سون لرن را مطالعه کرده‌ام و قبول دارم.</span>
        </small>
        {{--<div class="middle-line t-small text-secondary my-2 my-sm-3">یا</div>--}}
        {{--<button type="button" class="outline-secondary w-100 sm">
            <img src="{{ asset_url('img/icons/google.svg') }}" class="icon">
            ثبت‌نام با حساب گوگل
        </button>--}}
    </div>
</div>
