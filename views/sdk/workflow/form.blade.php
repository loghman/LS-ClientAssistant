<form class="{{ $wrapper_classes }}" action="{{ site_url('workflow/task-store') }}" method="post"
      data-jsc="ajax-form" data-after-success="closure" data-fn="showSuccess">
    <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
    <input type="hidden" name="source" value="{{ $source ?? 'فرم فرایند در سایت' }}">
    <input type="hidden" name="owner_id" value="{{ $owner ?? '' }}">

    @if(!empty($workflowData['welcome_message']) && isset($showWelcomeMessage) && $showWelcomeMessage === true)
        <p class="mb-3">{{ $workflowData['welcome_message'] }}</p>
    @endif

    @if(!empty($courses))
        <input type="hidden" name="entity_type" value="lms_products">
        @include('sdk.form-builder.select', [
            'name' => 'entity_id',
            'choices' => $courses,
            'classes' => 'sm fw-700',
        ])
    @else
        <input type="hidden" name="entity_type" value="{{ $entityType ?? 'lms_products' }}">
        <input type="hidden" name="entity_id" value="{{ $entityId }}">
    @endif
    <div class="input-group sm">
        <label class="fw-700">نام شما</label>
        <input type="text" name="full_name" required="required" placeholder="مثلا: مریم محمدی">
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
                'expanded' => false,
            ])
        @endforeach
    @endif

    <input type="hidden" name="time2call" value="{{ array_keys($timeToCallOptions)[0] }}">
    {{--<label class="fw-700 mt-xs w-100 justify-content-center">چه ساعتی با شما تماس بگیریم؟</label>
    <div class="d-flex align-items-center justify-content-center gap-sm gap-xxs--sm mt-xxs-neg mt-0--sm">
        @foreach($timeToCallOptions as $value => $option)
            <label for="time2call-{{ $id = rand(1,999) }}">
                <input type="radio" id="time2call-{{ $id }}" name="time2call" value="{{ $value }}">
                <span>{{ $option }}</span>
            </label>
        @endforeach
    </div>--}}

    <button type="submit" class="w-100 mt-xs">
        <span>ثبت درخواست</span><i class="si-arrow-left-r"></i>
    </button>
</form>

<div class="{{ $wrapper_classes }}" id="result-box" style="display: none !important;padding: 8px !important;">
    <h3 id="message" class="text-center" style="line-height: 34px;"></h3>
    <div class="justify-content-center text-center">
        <i class="icon si-checkbox-circle text-success" style="font-size: 8rem"></i>
    </div>
</div>

@push('footer')
    <script>
        function showSuccess(response) {
            jQuery('form').css('display', 'none');
            jQuery('form').removeClass('d-flex');
            jQuery('#result-box').css('display', 'flex');
            jQuery('#result-box').addClass('d-flex');
            jQuery('#message').html(response.response.message)
        }
    </script>
@endpush