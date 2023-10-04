@extends('_common.layouts.base-simple')
@section('title', $title)
@section('body-class', 'bg-secondary page-form')
@section('content')
    <div class="container mb-xxl">
        <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column text-white justify-content-center text-center py-sm gap-xs">
                @if($title && strlen($title) > 10)
                    <h1 class="t-heading-sm">{{ $title }}</h1>
                @endif
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-center gap-sm">
                <form class="card p-xxs--sm" action="{{ site_url('workflow/task-store') }}" method="post"
                      data-jsc="ajax-form" data-after-success="refresh">
                    <input type="hidden" name="workflow" value="{{ $workflowData['name_en'] }}">
                    <input type="hidden" name="entity_type" value="{{ $entityType ?? 'lms_products' }}">
                    <input type="hidden" name="backurl" value="{{ $backUrl }}">
                    @if($source)
                        <input type="hidden" name="source" value="{{ $source }}">
                    @endif
                    <div class="flex-column gap-xxs">
                        @include('form-builder.select', [
                            'name' => 'entity_id',
                            'choices' => ['' => $entityIdLabel] + $courses,
                            'classes' => 'sm fw-700',
                            'selected' => $entityId,
                        ])
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
                                @include("form-builder.{$variable['type']}", [
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
                <img style="opacity: .15" height="35" src="{{ asset_url('img/icons/logo-white.svg') }}" alt="">
            </div>
        </div>
    </div>
@endsection
