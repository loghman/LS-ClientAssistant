@extends('sdk._common.layouts.foundation')

@section('heads')
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
        body {
            -moz-font-feature-settings: "ss02";
            -webkit-font-feature-settings: "ss02";
            font-feature-settings: "ss02";
        }

        .ltr {
            direction: ltr;
        }

        .spinner {
            --sipnner-w: 54px;
            width: var(--sipnner-w);
            height: var(--sipnner-w);
            border: 5px solid black;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spinner 0.7s linear infinite;
        }

        @keyframes spinner {
            from {
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slide-in {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-in {
            animation: slide-in 0.5s ease forwards; /* مدت زمان و نوع انیمیشن */
        }

        @media (max-width: 639.99px) {
            .spinner {
                --sipnner-w: 44px;
                border: 4px solid black;
                border-top-color: transparent;
            }
        }
    </style>
    <script src="https://cdn.planet.bz/js/library/tailwind/3.4.16.js"></script>
    <link rel="stylesheet" href="https://cdn.planet.bz/font/iranyekan/font.css"/>
    <script src="https://cdn.planet.bz/js/library/jquery/3.7.1.min.js"></script>
    <!-- tailwind config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#ecf1fc',
                            100: '#d8e3fa',
                            200: '#bacef6',
                            300: '#96b7f3',
                            400: '#74a3f0',
                            500: '#428ded',
                            600: '#1376d3',
                            700: '#0060ba',
                            800: '#003889',
                            900: '#00135b'
                        },
                        secondary: {
                            50: '#ececed',
                            100: '#d7d7da',
                            200: '#b7b8be',
                            300: '#90939c',
                            400: '#6a6e7e',
                            500: '#2a3554',
                            600: '#15223f',
                            700: '#000f2b',
                            800: '#000001',
                            900: '#000000'
                        },
                        success: {
                            50: '#ebf8f3',
                            100: '#d6f1e5',
                            200: '#b6e8d3',
                            300: '#8edebe',
                            400: '#67d6ad',
                            500: '#1ece9a',
                            600: '#00b583',
                            700: '#009c6c',
                            800: '#006c41',
                            900: '#003f1a'
                        },
                        warning: {
                            50: '#fff6ec',
                            100: '#ffeed8',
                            200: '#ffe1b9',
                            300: '#ffd493',
                            400: '#ffca6f',
                            500: '#ffbf38',
                            600: '#e3a719',
                            700: '#c78f00',
                            800: '#926200',
                            900: '#613800'
                        },
                        danger: {
                            50: '#feeded',
                            100: '#fedada',
                            200: '#fdbdbd',
                            300: '#fc9c9c',
                            400: '#fc7c7c',
                            500: '#fb5252',
                            600: '#de363d',
                            700: '#c11129',
                            800: '#890000',
                            900: '#560000'
                        }
                    }
                }
            },

            plugins: [
                function ({addVariant}) {
                    addVariant('peer-checked-hover', '&:checked:hover');
                }
            ]
        };
    </script>
    <script>
        $(document).ready(function () {
            const wizardCard = $('#wizard-card');
            const wizardAlert = $('#wizard-alert');
            const authStep = $('#auth-step');
            const makeCartStep = $('#make-cart-step');
            const error = $('#error');
            const form = $('#wizard-form');
            const button = $('#button');
            const buttonCountdown = $('#button-countdown');
            const buttonLabel = $('#button-label');
            const otpInput = $('#otp-input');
            const otpError = $('#otp-error');

            const countDownTime = 120;

            @if($data['step'] === 'makeCart')
            showMakeCartStep();
            setTimeout(() => form.trigger('submit'), 5);
            @elseif($data['step'] === 'auth')
            showAuthStep();
            @elseif(isset($message))
            showMessage("{{ $message }}");
            @endif

            function startCountdown(time, lastStep) {
                const interval = setInterval(() => {
                    const currentStep = form.find('input[name="step"]').val();

                    if (!['auth', 'sendToken'].includes(currentStep)) {
                        clearInterval(interval);
                        return;
                    }

                    if (time >= 0) {
                        updateCountdown(time);

                        if (lastStep !== 'auth') {
                            updateAuthState();
                            lastStep = 'auth';
                        }

                        time--;
                    } else {
                        if (lastStep !== 'sendToken') {
                            updateSendTokenState();
                            lastStep = 'sendToken';
                        }

                        clearInterval(interval);
                    }
                }, 1000);
            }

            function updateCountdown(time) {
                const displayMinutes = Math.floor(time / 60);
                const displaySeconds = time % 60;
                const persianMinutes = displayMinutes.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
                const persianSeconds = displaySeconds.toString().replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);

                buttonCountdown.text(`${persianMinutes}:${persianSeconds}`);
            }

            function updateAuthState() {
                buttonCountdown.removeClass('hidden');
                button.addClass('bg-primary-500 hover:bg-primary-600').removeClass('bg-gray-500 hover:bg-gray-600');
                buttonLabel.text('ورود و ادامه');
                otpInput.prop('disabled', false).removeClass('disable');
                form.find('input[name="step"]').val('auth');
            }

            function updateSendTokenState() {
                buttonCountdown.addClass('hidden');
                button.addClass('bg-gray-500 hover:bg-gray-600').removeClass('bg-primary-500 hover:bg-primary-600');
                buttonLabel.text('ارسال مجدد کد تایید');
                otpInput.prop('disabled', true).addClass('disable');
                form.find('input[name="step"]').val('sendToken');
            }

            startCountdown(countDownTime, "{{ $data['step'] }}");

            form.on('submit', function (event) {
                event.preventDefault();
                const formData = new FormData(this);
                const step = formData.get('step');
                const data = Object.fromEntries(formData.entries());

                callStep(step, data);
            });

            function callStep(step, data) {
                const methods = {
                    sendToken: () => sendToken(data),
                    auth: () => auth(data),
                    makeCart: () => makeCart(data),
                    default: () => showMessage("Default or Invalid Step"),
                };

                (methods[step] || methods.default)();
            }

            function auth(data) {
                otpError.addClass('hidden');

                fetch("{{ route('qpay.auth') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: JSON.stringify(data),
                }).then(response => {
                    if (response.ok) {
                        return response.json().then(data => {
                            form.find('input[name="step"]').val('makeCart');
                            setTimeout(() => form.trigger('submit'), 200);
                        });
                    } else {
                        return response.json().then(errorData => {
                            otpError.removeClass('hidden').text(errorData.message);
                            otpInput.val('');
                        });
                    }
                });
            }

            function sendToken(data) {
                otpError.addClass('hidden');

                fetch("{{ route('qpay.send-token') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: JSON.stringify(data),
                }).then(response => {
                    if (response.ok) {
                        return response.json().then(() => startCountdown(countDownTime, form.find('input[name="step"]').val()));
                    } else {
                        return response.json().then(errorData => showMessage(errorData.message));
                    }
                });
            }

            async function makeCart(data) {
                showMakeCartStep();

                let uc = {valid: false, discount: 0};
                let pcc = {valid: false, discount: 0};
                if (data.user_coupon) {
                    $('.wizard-steps').text('در حال بررسی وضعیت کدتخفیف وارد شده توسط شما...');
                    data.coupon = data.user_coupon;
                    uc = await checkCoupon(data);
                    await delay(1500);
                    if (! uc.valid) {
                        data.coupon = null;
                        $('.wizard-steps').text(uc.message);
                        await delay(1500);
                    }
                }

                if (data.primary_campaign_coupon) {
                    $('.wizard-steps').text('در حال بررسی وضعیت کدتخفیف کمپین {{ $campaignName }}...');
                    data.coupon = data.primary_campaign_coupon;
                    pcc = await checkCoupon(data);
                    if (! pcc.valid) {
                        data.coupon = null;
                    }
                    await delay(1500);
                }
                if (uc.valid && uc.discount > pcc.discount) {
                    $('.wizard-steps').text('کد تخفیف وارد شده توسط شما تخفیف بیشتری اعمال میکرد...');
                    data.coupon = data.user_coupon;
                    await delay(1500);
                }
                if (pcc.valid && pcc.discount > uc.discount) {
                    $('.wizard-steps').text('کد تخفیف کمپین {{ $campaignName }} تخفیف بیشتری اعمال میکرد...');
                    data.coupon = data.primary_campaign_coupon;
                    await delay(1500);
                }
                const steps = ['در حال افزودن به سبد خرید', 'به سبد خرید افزوده شد', 'در حال انتقال به درگاه پرداخت'];

                let currentStep = 0;
                const interval = setInterval(() => {
                    if (currentStep < steps.length) {
                        $('.wizard-steps').text(steps[currentStep]);
                        currentStep++;
                    } else {
                        clearInterval(interval);
                        $('.some-section').addClass('completed');
                    }
                }, 1500);

                fetch("{{ route('qpay.pay') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: JSON.stringify(data),
                }).then(response => {
                    if (response.ok) {
                        return response.json().then(data => window.location.href = data.data.link);
                    } else {
                        return response.json().then(errorData => showMessage(errorData.message));
                    }
                });
            }

            const delay = (ms) => new Promise(resolve => setTimeout(resolve, ms));

            async function checkCoupon(data) {
                try {
                    const response = await fetch("{{ route('qpay.coupon') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        body: JSON.stringify(data),
                    });

                    const json = await response.json();
                    return {
                        valid: json.data.valid,
                        discount: json.data.discount_amount ?? 0,
                        message: json.message
                    };
                } catch (error) {
                    return {
                        valid: false,
                        discount: 0,
                        message: 'عدم پاسخگویی سرور.'
                    };
                }
            }

            function showAuthStep() {
                updateWizardAlert('bg-gray-800');
                toggleSteps(authStep, makeCartStep, true);
            }

            function showMakeCartStep() {
                updateWizardAlert('bg-green-800');
                toggleSteps(makeCartStep, authStep, true);
            }

            function showMessage(message) {
                updateWizardAlert('bg-red-800');
                toggleSteps(error, authStep, false);
                toggleSteps(error, makeCartStep, false);
                error.find('span').text(message);
            }

            function updateWizardAlert(colorClass) {
                wizardAlert.removeClass('bg-gray-800 bg-green-800 bg-red-800').addClass(colorClass);
            }

            function toggleSteps(showElement, hideElement, isFlex = false) {
                showElement.removeClass('hidden').addClass(isFlex ? 'flex slide-in' : '');
                hideElement.addClass('hidden');
                autoHeight();
            }

            function autoHeight() {
                wizardCard.css('height', wizardCard.outerHeight() + 'px');
            }
        });
    </script>
    <title>پرداخت سریع</title>
@endsection

@section('body-class', 'bg-gray-100 px-5 lg:px-10 py-20 flex justify-center items-center')

@section('body')
    <div id="wizard-alert" class="absolute h-40 w-full -z-10 top-0 overflow-hidden transition-all"></div>
    <div class="wizard-card login 2xl:basis-3/12 lg:basis-4/12 md:basis-8/12 sm:basis-10/12 basis-full rounded-2xl bg-white relative">
        <div id="auth-step" class="hidden p-4 lg:p-7 flex flex-col gap-3 relative">
            <a href="{{ $backUrl }}"
               class="absolute -top-12 right-0 flex items-center gap-1 text-sm text-gray-400 pr-3 pl-4 py-2 rounded-full w-fit hover:bg-primary-500 hover:text-white transition-all group">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 256"
                        class="size-4 fill-gray-400 group-hover:fill-white transition-all"
                >
                    <path
                            d="M224.49,136.49l-72,72a12,12,0,0,1-17-17L187,140H40a12,12,0,0,1,0-24H187L135.51,64.48a12,12,0,0,1,17-17l72,72A12,12,0,0,1,224.49,136.49Z"
                    ></path>
                </svg>
                بازگشت
            </a>
            <img
                    class="mt-6 w-14 h-14 object-contain mx-auto"
                    src="https://cdn.planet.bz/icon/demo/brand/7learn/logo-icon.svg"
                    alt="سون لرن"
            />
            <span class="mt-3 text-2xl font-extrabold block mx-auto text-center">کد تایید</span>
            <span class="block leading-8 text-sm text-gray-400 mx-auto text-center">
              کد پیامک شده به موبایل‌تان را وارد کنید
            </span>

            <form id="wizard-form" class="mt-6 flex flex-col gap-2">
                <input
                        placeholder="{{ rtrim(str_repeat("----    ", $otpLength)) }}"
                        type="text"
                        name="password"
                        id="otp-input"
                        class="block w-full rounded-lg bg-white px-3 py-3 text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-500 text-2xl font-medium text-center ltr tracking-[.25em] placeholder:tracking-[-2px]"
                        minlength="{{ $otpLength }}"
                        maxlength="{{ $otpLength }}"
                />
                <span id="otp-error" class="hidden text-sm text-red-400 mx-auto text-center"></span>
                @foreach($data as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                <button
                        id="button"
                        type="submit"
                        class="countdown-target wizard-toggle relative w-full shrink-0 inline-flex items-center gap-3 justify-center rounded-lg bg-primary-500 px-5 py-4 text-sm font-medium text-white shadow-xs hover:bg-primary-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600"
                >
                    <span id="button-label">ورود و ادامه</span>
                    <span id="button-countdown" class="text-base pt-1 absolute left-5 opacity-50" data-countdown="02:00"></span>
                </button>
            </form>
        </div>
        <div id="make-cart-step" class="hidden p-4 lg:p-7 flex-col gap-3 items-center justify-center h-full">
            <img class="size-20 sm:size-24" src="https://cdn.planet.bz/image/gif/icon-key-check.gif" alt=""/>
            <span class="text-xl sm:text-2xl font-extrabold mt-3">با موفقیت وارد شدید</span>
            <span class="wizard-steps block leading-8 text-sm text-gray-400 mx-auto text-center">
          در حال بررسی درخواست شما
        </span>
            <div class="spinner mt-4"></div>
        </div>
        <div id="error" class="hidden p-4 lg:p-7 flex flex-col gap-3 relative">
            <a href="{{ $backUrl }}"
               class="absolute -top-12 right-0 flex items-center gap-1 text-sm text-gray-400 pr-3 pl-4 py-2 rounded-full w-fit hover:bg-primary-500 hover:text-white transition-all group">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 256 256"
                        class="size-4 fill-gray-400 group-hover:fill-white transition-all"
                >
                    <path
                            d="M224.49,136.49l-72,72a12,12,0,0,1-17-17L187,140H40a12,12,0,0,1,0-24H187L135.51,64.48a12,12,0,0,1,17-17l72,72A12,12,0,0,1,224.49,136.49Z"
                    ></path>
                </svg>
                بازگشت
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" class="size-14 fill-red-500 mx-auto mt-6" viewBox="0 0 256 256">
                <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm-8-80V80a8,8,0,0,1,16,0v56a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,172Z"></path>
            </svg>

            <span class="block leading-8 text-sm text-gray-400 mx-auto text-center pb-8 md:pb-4"></span>
        </div>
    </div>
@endsection