<!doctype html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset_url('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ core_url('css/client-common-components.min.css') }}">
    <meta name="csrf-token" content="">
    <link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
    <link rel="preconnect" href="{{ base_storage_url() }}"/>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
    <meta name="apple-mobile-web-app-title" content="7Learn">
    <meta name="application-name" content="7Learn">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body class="bg-secondary page-form">
<div class="container mb-xxl">
    <div class="row justify-content-center">
        <div class="col-12 d-flex flex-column text-white justify-content-center text-center py-sm gap-xs">
            @if($title && strlen($title) > 10)
                <h1 class="t-heading-sm">{{ $title }}</h1>
            @endif
        </div>
        <div class="col-lg-6 d-flex flex-column align-items-center gap-sm">
            <form class="card p-xxs--sm" action="{{ site_url('workflow/task-store') }}" method="post"
                  data-jsc="ajax-form" data-after-success="closure" data-fn="showSuccess">
                <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
                <input type="hidden" name="entity_type" value="{{ $entityType }}">
                <input type="hidden" name="entity_id" value="{{ $entityId }}">
                <input type="hidden" name="backurl" value="{{ $backUrl }}">
                @if($source)
                    <input type="hidden" name="source" value="{{ $source }}">
                @endif
                <div class="flex-column gap-xxs">
                    <div class="input-group sm">
                        <label class="fw-700">نام شما</label>
                        <input type="text" name="full_name" required="required" placeholder="مثلا: لقمان آوند">
                    </div>
                    <div class="input-group sm">
                        <label class="fw-700">شماره موبایل</label>
                        <input class="ltr text-start" type="text" name="mobile" required="required"
                               placeholder="091xxxxxxxx">
                    </div>
                    @if(setting('crm_has_email_field'))
                        <div class="input-group sm">
                            <label class="fw-700">ایمیل شما</label>
                            <input class="ltr text-start" type="email" name="email" required="required"
                                   placeholder="yourName@domain.com">
                        </div>
                    @endif

                    @if(count($workflowData['variables']) > 0)
                        @foreach($workflowData['variables'] as $variable)
                            @include("sdk.form-builder.{$variable['type']}", [
                                'placeholder' => $variable['name_fa'],
                                'name' => "var[{$variable['name_en']}]",
                                'choices' => isset($variable['payload']['choices']) ? array_merge(['' => $variable['name_fa']], $variable['payload']['choices']) : [],
                                'classes' => 'sm fw-700',
                            ])
                        @endforeach
                    @endif

                    <label class="fw-700 mt-xs">چه ساعتی با شما تماس بگیریم؟</label>
                    <div class="d-flex align-items-center gap-sm gap-xxs--sm mt-xxs-neg mt-0--sm">
                        @foreach($timeToCallOptions as $value => $option)
                            <label for="time2call-{{ $id = rand(1,999) }}">
                                <input type="radio" id="time2call-{{ $id }}" name="time2call" value="{{ $value }}">
                                <span>{{ $option }}</span>
                            </label>
                        @endforeach
                    </div>

                    <button type="submit" class="secondary w-100 mt-xs">
                        <span>ثبت درخواست</span><i class="si-arrow-left-r"></i>
                    </button>
                </div>
            </form>

            <div class="card p-xxs--sm" id="result-box" style="display: none">
                <div class="justify-content-center">
                    <i class="icon si-checkbox-circle text-success" style="font-size: 12rem"></i>
                </div>
                <h3 id="message"></h3>
            </div>

            <img style="opacity: .15" height="35" src="{{ asset_url('img/icons/logo-white.svg') }}" alt="">
        </div>
    </div>
</div>

<script src="{{ asset_url('js/jquery.min.js') }}"></script>
<script>
    function showSuccess(response)
    {
        jQuery('form').css('display', 'none');
        jQuery('#result-box').css('display', 'flex');
        jQuery('#message').html('با تشکر '+response.response.name+' عزیز درخواست شما ارسال شد و بدست ما رسید.')
    }
</script>
<script src="{{ core_url('js/jss.js?v=5') }}"></script>
</body>
</html>