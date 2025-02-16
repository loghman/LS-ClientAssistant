<form class="{{ $wrapper_classes }}" action="{{ site_url('workflow/task-store') }}" method="post"
      data-jsc="ajax-form" data-after-success="closure" data-fn="afterSuccess" id="form">
    <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
    <input type="hidden" name="source" value="{{ $source ?? 'فرم فرایند در سایت' }}">
    <input type="hidden" name="time2call" value="{{ array_keys($timeToCallOptions)[0] }}">

    @if(! empty($workflowData['welcome_message']))
        <div class="step w-100 expanded mt-5">
            <p class="text-center text-white mb-3 fs-18">{{ $workflowData['welcome_message'] }}</p>
            <button class="next-step float-start mx-auto mt-3 bg-transparent btn-start">
                <span>شروع</span>
                <svg width="22px" height="22px" viewBox="0 -6.5 38 38" version="1.1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="ui-gambling-website-lined-icnos-casinoshunter" transform="translate(-1641.000000, -158.000000)" fill="#fff" fill-rule="nonzero">
                            <g id="1" transform="translate(1350.000000, 120.000000)">
                                <path d="M317.812138,38.5802109 L328.325224,49.0042713 L328.41312,49.0858421 C328.764883,49.4346574 328.96954,49.8946897 329,50.4382227 L328.998248,50.6209428 C328.97273,51.0514917 328.80819,51.4628128 328.48394,51.8313977 L328.36126,51.9580208 L317.812138,62.4197891 C317.031988,63.1934036 315.770571,63.1934036 314.990421,62.4197891 C314.205605,61.6415481 314.205605,60.3762573 314.990358,59.5980789 L322.274264,52.3739093 L292.99947,52.3746291 C291.897068,52.3746291 291,51.4850764 291,50.3835318 C291,49.2819872 291.897068,48.3924345 292.999445,48.3924345 L322.039203,48.3917152 L314.990421,41.4019837 C314.205605,40.6237427 314.205605,39.3584519 314.990421,38.5802109 C315.770571,37.8065964 317.031988,37.8065964 317.812138,38.5802109 Z" transform="translate(310.000000, 50.500000) scale(-1, 1) translate(-310.000000, -50.500000) "></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </button>
        </div>
    @endif

    @if(count($workflowData['variables']) > 0)
        @foreach($workflowData['variables'] as $variable)
            @php($input_type = str_replace('select','multichoice',$variable['type']))
            @include("sdk.form-builder.{$input_type}", [
                'placeholder' => $variable['name_fa'],
                'name' => "var[{$variable['name_en']}]",
                'choices' => $variable['payload']['choices'] ?? [],
                'classes' => 'sm fw-700',
                'expanded' => empty($workflowData['welcome_message']) && $variable == $workflowData['variables'][0],
                'type' => 'minimal'
            ])
        @endforeach
    @endif

    <div class="step w-100 info-fields">
        <label class="qLabel">نام و موبایل خود را وارد و ثبت نهایی کنید:</label>
        @if(!empty($courses))
            <input type="hidden" name="entity_type" value="lms_products">
            @include('sdk.form-builder.select', [
                'name' => 'entity_id',
                'choices' => $courses,
                'classes' => 'sm fw-700',
            ])
        @else
            <input type="hidden" name="entity_type" value="{{ $entityType??'lms_products'}}">
            <input type="hidden" name="entity_id" value="{{ $entityId }}">
        @endif
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
        <button type="submit" class="w-100 mt-xs">
            <span>ثبت و ارسال نهایی</span><i class="si-arrow-left-r"></i>
        </button>
    </div>
</form>

<div class="{{ $wrapper_classes }}" id="result-box" style="display: none !important;padding: 8px !important;">
    <h3 id="message" class="text-center" style="line-height: 34px;"></h3>
    <div class="justify-content-center text-center">
        <i class="icon si-checkbox-circle text-success" style="font-size: 8rem"></i>
    </div>
</div>
<style>
    .btn-start {
        border-color: #fff !important;
    }

    .btn-start:hover {
        background: var(--btn-bg) !important;
        border-color: var(--btn-bg) !important;
        color: #fff !important;
    }
</style>