@php($isMinimal = isset($type) && $type === 'minimal')
<div class="{{ $isMinimal ? 'step' : '' }} {{ $expanded ? 'expanded' : '' }} w-100"
     data-qid="{{ $variable['id'] }}">

    @php($uniqueId = create_unique_id())
    <div class="{{ $isMinimal ? 'mt-4 minimal' : 'normal align-items-baseline d-flex justify-content-between' }}">
        <p class="{{ $isMinimal ? 'fs-26 fw-700 mb-4 mt-3 text-center text-white' : '' }}">{{ $variable['name_fa'] }}</p>

        <div class="flex-column uploading-box">
            <label class="{{ $isMinimal ? 'd-block mx-auto text-center w-fit' : 'd-flex flex-column gap-0' }}" for="file{{ $variable['id'] }}">
                <input type="file" class="d-none uploader" data-collection_name="attachment"
                       data-unique_id="{{ $uniqueId }}" data-max_size="{{ $variable['payload']['max_file_size'] * 1024 }}"
                       data-allowed_file="{{ implode(',', (array) $variable['payload']['file_mime_types']) }}"
                       id="file{{ $variable['id'] }}" upload="false" data-media_custom_rule="bpms_workflow_variables,{{ $variable['id'] }}">
                <span class="bg-transparent sm btn {{ $isMinimal ? 'btn-mini' : 'btn-normal' }}">
                    <span>انتخاب فایل</span>
                    <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5535 2.49392C12.4114 2.33852 12.2106 2.25 12 2.25C11.7894 2.25 11.5886 2.33852 11.4465 2.49392L7.44648 6.86892C7.16698 7.17462 7.18822 7.64902 7.49392 7.92852C7.79963 8.20802 8.27402 8.18678 8.55352 7.88108L11.25 4.9318V16C11.25 16.4142 11.5858 16.75 12 16.75C12.4142 16.75 12.75 16.4142 12.75 16V4.9318L15.4465 7.88108C15.726 8.18678 16.2004 8.20802 16.5061 7.92852C16.8118 7.64902 16.833 7.17462 16.5535 6.86892L12.5535 2.49392Z"/>
                        <path d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z"/>
                    </svg>
                </span>
                <div class="upload-progress">
                    <div id="progress_bar_percent" class="progress-percent d-none"> % 0</div>
                    <div id="progress_bar" class="progress">
                        <div class="progress-bar" style="width: 0%"></div>
                    </div>
                </div>
            </label>
            <small class="fs-13 mt-2 op-70 t-subtitle text-center">(حداکثر {{ $variable['payload']['max_file_size'] }} مگابایت)</small>
        </div>

        <div class="uploaded-file d-none mt-4">
            <input type="hidden" class="response-value" name="{{ $name }}" value="">
            <div class="file"></div>
            <div class="content">
                <span class="title">فایل شما با موفقیت آپلود شد</span>
                <div class="actions">
                    <a href="" target="_blank" class="action download-file">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M280 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 270.1-95-95c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9L239 369c9.4 9.4 24.6 9.4 33.9 0L409 233c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-95 95L280 24zM128.8 304L64 304c-35.3 0-64 28.7-64 64l0 80c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-80c0-35.3-28.7-64-64-64l-64.8 0-48 48L448 352c8.8 0 16 7.2 16 16l0 80c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-80c0-8.8 7.2-16 16-16l112.8 0-48-48zM432 408a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z"/>
                        </svg>
                    </a>
                    <div class="action cancel-upload">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path d="M345 137c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-119 119L73 103c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l119 119L39 375c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l119-119L311 409c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-119-119L345 137z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('_common.scripts.uploader')

    @if($isMinimal)
        <button type="button" class="m-submit next-step float-start sm align-self-end">ثبت و بعدی</button>
    @endif
    <style>
        .upload-progress .progress-percent {
            line-height: 20px;
            margin-top: 10px;
        }

        .upload-progress .progress {
            display: none;
        }

        .uploading-box {
            display: flex;
        }

        .uploaded-file {
            padding: 4px;
            display: flex;
            align-items: stretch;
            gap: 15px;
            background-color: #fff;
            border-radius: 4px;
            overflow: hidden;
        }

        .uploaded-file .content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 10px 10px 15px;
            gap: 10px;
            flex: 1;
        }

        .uploaded-file .file {
            border-radius: 4px;
            width: 120px;
            position: relative;
            display: flex;
            align-items: center;
            text-align: center;
            background-color: var(--primary-10);
            position: relative;
            overflow: hidden;
            justify-content: center;
            flex-shrink: 0;
            padding: 20px 0;
        }

        .uploaded-file .file .type {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
            position: relative;
            z-index: 1;
        }

        .uploaded-file .file img {
            position: absolute;
            inset: 0;
            object-fit: cover;
            z-index: 2;
            width: 100%;
            height: 100%;
        }

        .uploaded-file .title {
            font-size: 16px;
            font-weight: 600;
            line-height: 24px;

        }

        .uploaded-file .actions {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .uploaded-file .actions .action {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            font-size: 20px;
            background-color: var(--secondary-10);
            color: var(--secondary-70);
            cursor: pointer;
            transition: all ease-in-out .15s;

        }

        .uploaded-file .actions .action svg {
            width: 20px;
            height: 20px;
            fill: var(--secondary-70);
        }

        .uploaded-file .actions .action:hover {
            background-color: var(--primary-10);
            color: var(--primary-70);
        }

        .uploaded-file .actions .action:hover svg {
            fill: var(--primary-70);
        }

        .btn-mini {
            color: #fff;
            border-color: #fff;

        }

        .btn-mini svg path {
            fill: #fff
        }

        .btn-normal svg path {
            fill: var(--base-color)
        }

        .btn-mini:hover svg path,
        .btn-normal:hover svg path {
            fill: var(--primary)
        }

        .btn-normal {
            color: var(--base-color);
            border-color: var(--base-color);
        }

        .minimal .t-subtitle {
            color: #fff;
        }

        .minimal .progress-percent {
            color: #fff;
        }

        @media (max-width: 575.999px) {
            .uploaded-file {
                gap: 5px;
            }

            .uploaded-file .content {
                flex-direction: column;
                align-items: start;
            }

            .uploaded-file .content .actions .action {
                width: 32px;
                height: 32px;
                font-size: 16px;
            }

            .uploaded-file .actions .action svg {
                width: 16px;
                height: 16px;
            }

            .uploaded-file .title {
                font-size: 14px;
                line-height: 22px;
            }

            .uploaded-file .file {
                width: 90px;
            }
        }
    </style>
</div>
