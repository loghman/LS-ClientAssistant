<!doctype html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاوره {{ $workflowData['name_fa'] }}</title>
    <link rel="stylesheet" href="{{ asset_url('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ core_url('css/client-common-components.min.css') }}">
    <meta name="csrf-token" content="">
    <link rel="dns-prefetch" id="storage_url" href="{{ base_storage_url() }}"/>
    <link rel="preconnect" href="{{ base_storage_url() }}"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
    <meta name="apple-mobile-web-app-title" content="7Learn">
    <meta name="application-name" content="7Learn">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <style>
        <?php
            $bgColor ='#' . ($_GET['color'] ?? '272727');
            $bgt = $_GET['bgt'] ?? '70';
        ?>
        .page-form{
            background: <?=$bgColor?> url(https://up.7learn.com/1/bg/bgt-<?=$bgt?>.png) !important;
            background-repeat:repeat-x !important;
        } 
        
        .progressbar{
            display: flex;
            flex-direction: row-reverse;
            align-items: stretch;
            height: 5px;
            gap: 5px;
            margin-bottom: 20px;
        }
        .progressbar>div{
            flex: 1;
            background: rgba(255,255,255,0.1);
        }
        .progressbar>div.active{
            flex: 1;
            background: rgba(255,255,255,0.5);
        }

        .footer{
            display: block;
            flex-direction: row-reverse;
            align-items: stretch;
            height: 5px;
            gap: 5px;
            margin: 20px 0;
        }
        .footer #btn-next,
        .footer #btn-prev{
            padding: 5px 10px;
            min-width: 60px;
            margin: 0;
            float: right;
            direction: ltr;
            background: rgba(255,255,255,0.1);
            border:0;
            gap:3px;
        }
        .footer #btn-next{
            border-radius: 0  5px 5px 0;
            margin-left: 1px;
            padding-left: 14px;
        }
        .footer #btn-prev{
            border-radius: 5px;
            padding-right: 20px;
        }
        
        .footer button.disable {
            display: none;
        }
        .footer button.rounded {
            border-radius: 5px !important;
        }
        .step{
            display: none;
        }
        .step.expanded{
            display: block;
        }
        .qLabel{
            color:#ffffff;
            text-align: right;
            font-size: 20px;
            font-weight: 600 !important;
            margin-bottom: 20px;
        }
        .qOption{
            display: block;
            background: rgba(255,255,255,0.8);
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            padding: 7px 15px;
            margin-bottom: 5px;
        }
        .qOption:hover{
            background: rgba(255,255,255,1);
        }
        .qOption > input{
            vertical-align: middle;
        }

        @keyframes blinker {
            0% { background: rgba(255,255,255,1); }
            30% { background: rgba(255,255,255,0.5); }
            100% { background: rgba(255,255,255,1); }
        }
        .m-submit{
            display: flex !important;
        }
        #msg{
            display: none;
            background: rgba(255, 255, 255, 0.97);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
            font-size: 30px;
            padding: 10% 12%;
        }
    </style>
</head>
<body class="bg-secondary page-form">
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

            {{-- <img style="opacity: .15" height="35" src="{{ asset_url('img/icons/logo-white.svg') }}" alt=""> --}}
        </div>
    </div>
</div>
<div id="msg"></div>

<script src="{{ asset_url('js/jquery.min.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/js/jss.js') }}"></script>
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
            let input_id = element.getAttribute('data-required') ;
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
        '<br><br><br><a href="https://7Learn.com" class="badge sm">بازگشت به سون لرن</a>';
    }

</script>

@stack('footer')
</body>
</html>
