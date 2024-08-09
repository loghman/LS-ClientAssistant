<form class="{{ $wrapper_classes }}" action="{{ site_url('workflow/task-store') }}" method="post"
      data-jsc="ajax-form" data-after-success="closure" data-fn="afterSuccess" id="form"> 
    <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
    <input type="hidden" name="source" value="{{ $source ?? 'فرم فرایند در سایت' }}">
    <input type="hidden" name="time2call" value="{{ array_keys($timeToCallOptions)[0] }}">

    @if(count($workflowData['variables']) > 0)
    @foreach($workflowData['variables'] as $variable)
        <?php $input_type = str_replace('select','multichoice',$variable['type']);  ?>
        @include("sdk.form-builder.{$input_type}", [
            'placeholder' => $variable['name_fa'],
            'name' => "var[{$variable['name_en']}]",
            'choices' => isset($variable['payload']['choices']) ? $variable['payload']['choices'] : [],
            'classes' => 'sm fw-700',
            'expanded' => $variable == $workflowData['variables'][0],
            'var' => $variable,
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
        <div class="input-group sm mt-2">
            <label class="fw-700">شماره موبایل</label>
            <input class="ltr text-start" type="text" name="mobile" required="required"
                placeholder="091xxxxxxxx">
        </div>
        @if(setting('crm_has_email_field'))
            <div class="input-group sm mt-2">
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