@extends('sdk._common.layouts.foundation')
@section('heads')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاوره {{ $workflowData['name_fa'] }}</title>
    <link rel="stylesheet" href="https://up.7learn.com/1/css/yekan/font.css">
    <meta name="csrf-token" content="">
    <link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
    <link rel="preconnect" href="{{ base_storage_url() }}"/>
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
    <meta name="apple-mobile-web-app-title" content="{{setting('brand_name_en')}}">
    <meta name="application-name" content="{{setting('brand_name_en')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <style>
        <?php
            $bgColor ='#' . ($_GET['color'] ?? '2e2e2e');
            $bgt = $_GET['bgt'] ?? '70';
        ?>
        .page-form{
            background: <?=$bgColor?> url(https://up.7learn.com/1/bg/bgt-<?=$bgt?>.png) !important;
            background-repeat:repeat-x !important;
        }

        html, body {
            width: 100%;
        }

        body {
            font-family: var(--base-font-family) !important;
            background-color: var(--base-bg);
            color: var(--base-color);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: transparent;
            -webkit-font-smoothing: antialiased;
            padding: 0;
            margin: 0;
            min-height: 100vh;
        }

        * {
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        [tabindex="-1"]:focus:not(:focus-visible) {
            outline: 0 !important;
        }

        hr {
            margin: 1rem 0;
            color: inherit;
            background-color: var(--gray-4);
            border: 0;
        }

        hr:not([size]) {
            height: 1px;
        }

        abbr[title],
        abbr[data-bs-original-title] {
            text-decoration: underline;
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
            cursor: help;
            -webkit-text-decoration-skip-ink: none;
            text-decoration-skip-ink: none;
        }

        address {
            margin-bottom: 1rem;
            font-style: normal;
            line-height: inherit;
        }

        b,
        strong {
            font-weight: bolder;
        }

        a {
            color: inherit;
            text-decoration: none;
        }
        a:hover {
            text-decoration: none;
        }

        a:not([href]):not([class]), a:not([href]):not([class]):hover {
            color: inherit;
            text-decoration: none;
        }

        pre,
        code,
        kbd,
        samp {
            direction: ltr /* rtl:ignore */;
        }

        pre {
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-left: 3px solid var(--primary-50);
            color: #666;
            page-break-inside: avoid;
            font-family: monospace;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 1.6em;
            max-width: 100%;
            overflow: auto;
            padding: 1em 1.5em;
            display: block;
            word-wrap: break-word;
        }
        pre code {
            color: inherit;
            word-break: normal;
        }

        code {
            color: inherit;
            word-wrap: break-word;
        }
        a > code {
            color: inherit;
        }

        img,
        svg {
            vertical-align: middle;
        }

        table {
            caption-side: bottom;
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
            text-align: -webkit-match-parent;
        }

        thead,
        tbody,
        tfoot,
        tr,
        td,
        th {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        label {
            display: inline-block;
        }

        input,
        button,
        select,
        optgroup,
        textarea {
            margin: 0;
            font-family: inherit;
            line-height: inherit;
        }

        button,
        select {
            text-transform: none;
        }

        [role=button] {
            cursor: pointer;
        }

        select {
            word-wrap: normal;
        }

        [list]::-webkit-calendar-picker-indicator {
            display: none;
        }

        button,
        [type=button],
        [type=reset],
        [type=submit] {
            -webkit-appearance: button;
        }
        button:not(:disabled),
        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled) {
            cursor: pointer;
        }

        ::-moz-focus-inner {
            padding: 0;
            border-style: none;
        }

        textarea {
            resize: vertical;
        }

        fieldset {
            min-width: 0;
            padding: 0;
            margin: 0;
            border: 0;
        }

        ::-webkit-datetime-edit-fields-wrapper,
        ::-webkit-datetime-edit-text,
        ::-webkit-datetime-edit-minute,
        ::-webkit-datetime-edit-hour-field,
        ::-webkit-datetime-edit-day-field,
        ::-webkit-datetime-edit-month-field,
        ::-webkit-datetime-edit-year-field {
            padding: 0;
        }

        ::-webkit-inner-spin-button {
            height: auto;
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        ::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        ::file-selector-button {
            font: inherit;
        }

        ::-webkit-file-upload-button {
            font: inherit;
            -webkit-appearance: button;
        }

        output {
            display: inline-block;
        }

        iframe {
            border: 0;
        }

        summary {
            display: list-item;
            cursor: pointer;
        }

        progress {
            vertical-align: baseline;
        }

        [hidden] {
            display: none !important;
        }

        ul, li {
            display: flex;
        }

        ul {
            list-style: none;
            flex-direction: column;
        }

        li {
            align-items: center;
            position: relative;
        }

        small {
            font-size: inherit;
        }

        .hoverable {
            cursor: pointer;
        }
        .hoverable:hover {
            opacity: 0.75;
        }
        @include('sdk.workflow.bootstrap')
    </style>
@endsection
@section('body-class', 'page-form')
@section('body')
    <div class="container mb-xxl">
        <div class="row justify-content-center pt-3">
            <div class="col-12 d-flex flex-column text-white justify-content-center text-center">
                @if($title && strlen($title) > 10)
                    <h1 class="t-heading-sm">{{ $title }}</h1>
                @endif
            </div>
            <div class="col-lg-6 d-flex flex-column align-items-center gap-sm">
                <div class="card p-xxs--sm bg-transparent w-100">
                    <div class="progressbar" id="progressbar"></div>
                    @include('sdk.workflow.form-m', ['wrapper_classes' => 'd-flex flex-column gap-xs'])
                    <div class="footer">
                        <button class="sm d-none" id="btn-next">بعدی <i class="si-chevron-right-r"></i></button>
                        <button class="sm disable rounded" id="btn-prev"><i class="si-chevron-left-r"></i> قبلی</button>
                    </div>
                </div>

{{--                 <img style="opacity: .15" height="35" src="{{  setting('logo_url') }}" alt=""> --}}
            </div>
        </div>
    </div>
    <div id="msg" class="card"></div>

    <script src="{{ asset_url('js/jquery.min.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/js/app/jss.js') }}"></script>
    <script>
        const steps = document.querySelectorAll('.step');
        const form = document.getElementById('form');
        const progressbar = document.getElementById('progressbar');
        const nextButton = document.getElementById('btn-next');
        const prevButton = document.getElementById('btn-prev');
        for (let i = 0; i < steps.length; i++) {
            let div = document.createElement("div");
            if(i == 0)
                div.classList.add('active');
            progressbar.append(div);
        }
        const bars = document.querySelectorAll('.progressbar>div');

        function getCurrentIndex() {
            for (let i = 0; i < steps.length; i++) {
                if (steps[i].classList.contains('expanded')) {
                    return i;
                }
            }
        }
        function getCurrentStep() {
            return steps[getCurrentIndex()];
        }


        function updateProgressbar() {
            let currentIndex = getCurrentIndex();
            for (let i = 0; i < bars.length; i++) {
                if (i <= currentIndex) {
                    bars[i].classList.add('active');
                }else{
                    bars[i].classList.remove('active');
                }
            }
            if(currentIndex == 0){
                prevButton.classList.add('disable');
                nextButton.classList.add('rounded');
            }else{
                prevButton.classList.remove('disable');
                nextButton.classList.remove('rounded');
            }
            if(currentIndex == bars.length-1){
                nextButton.classList.add('disable');
                prevButton.classList.add('rounded');
            }else{
                nextButton.classList.remove('disable');
                prevButton.classList.remove('rounded');
            }
        }

        function goToStep(str){
            let current = getCurrentStep();
            if(str == 'next'){
                target = current.nextElementSibling
            }else if(str == 'prev'){
                target = current.previousElementSibling
            }
            if (target.classList.contains('step')) {
                current.classList.remove('expanded');
                target.classList.add('expanded');
                updateProgressbar();
            }
        }
        document.querySelectorAll('.qOption').forEach(function(element) {
            element.addEventListener('click', function(e) {
                // e.preventDefault();
                this.style.animation = 'blinker 0.5s';
                this.getElementsByTagName('input')[0].checked = true;
                setTimeout(() => {
                    this.style.animation = '';
                    goToStep('next');
                }, 500);
            });
        });

        nextButton.addEventListener('click', function() {
            setTimeout(() => {goToStep('next');}, 100);
        });
        prevButton.addEventListener('click', function() {
            setTimeout(() => {goToStep('prev');}, 100);
        });
        document.querySelectorAll('.next-step').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                let input_id = element.getAttribute('data-required');
                if(input_id != null){
                    filled = document.getElementById(input_id).value.length > 0;
                    if(!filled){
                        alert('لطفا این فیلد را با دقت پر نمایید');
                        return false;
                    }
                }
                setTimeout(() => {goToStep('next');}, 100);
            });
        });

        function afterSuccess(response){
            let msg = document.getElementById('msg');
            msg.style.display = 'block';
            msg.innerHTML = "🙏<br><br>" + response.response.message +
                '<br><br><br><a href="{{setting('_env_client_url')}}" class="btn sm">بازگشت به {{setting('brand_name_fa')}}</a>';
        }

    </script>

    @stack('footer')
@endsection