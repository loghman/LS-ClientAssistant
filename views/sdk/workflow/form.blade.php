<form class="card p-xxs--sm" action="{{ site_url('workflow/task-store') }}" method="post"
      data-jsc="ajax-form" data-after-success="closure" data-fn="showSuccess">
    <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
    <input type="hidden" name="entity_type" value="{{ $entityType }}">
    <input type="hidden" name="entity_id" value="{{ $entityId }}">
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

@push('scripts')
    <script>
        function showSuccess(response)
        {
            jQuery('form').css('display', 'none');
            jQuery('#result-box').css('display', 'flex');
            jQuery('#message').html(response.response.message)
        }
    </script>
@endpush