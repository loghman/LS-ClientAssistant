<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
<style>
    button:hover, .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .card-product .title{
        font-size: 22px;
        padding-bottom: 8px;
    }
    .progress {
        text-align: center;
        font-size: 11px;
        padding-left: 11px;
        line-height: 20px;
        height: 20px;
        margin-left: 15px;
        width: 100%;
    }

    .progress span {
        z-index: 99999;
        position: absolute;
        text-align: center;
        color: var(--primary-50);
    }

    .fasl {
        color: var(--primary);
    }

    .truncate {
        width: 320px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .accordions .accordion .header .picon {
        font-size: 18px;
    }

    .completed .picon {
        color:var(--primary);
    }

    .accordions .accordion .header .time{
        font-size: 11px;
        font-weight: 300;
        opacity: 0.7;
    }
    .accordions .accordion .header {
        background: none !important;
        gap: 7px;
    }
    .accordions .accordion .header:after {
        margin-right: 10px;
        font-size: 12px;
    }

    .accordions .accordion .content{
        padding: 0 !important;
    }

    .accordions{
        margin-top: 10px;
    }

    .accordions .accordion {
        border: 1px solid #e7e7e7 !important;
        border-radius: 5px;
        border-top-right-radius: 5px !important;
        border-top-left-radius: 5px !important;
        padding: 0 12px;
        background-color: var(--primary-1);
        margin-bottom: 5px;
    }

    .accordions .accordion.expanded {
        z-index: 1;
        border-color: var(--primary) !important;
        background: var(--primary-5);
        padding: 0 12px 15px 12px;
    }

    .accordions .accordion .content {
        background: none !important;
    }

    .playerbox{
        max-width: 100%;
        position: relative;
        width: 100%;
        padding-top: 56.25%; 
        height: 0;
        overflow: hidden;
        z-index: 5;
    }
    
    .playerbox::after {
        content: 'کمی صبر کنید ...'; 
        position: absolute;
        top: 50%;
        left: 50%;
        color:var(--primary-70);
        font-size: 18px;
        transform: translate(-50%, -50%);
    }

    .playerbox iframe,.playerbox video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
        z-index: 50;
        border-radius: 10px;
    } 


    .signal-box {
        display: flex;
        background: var(--primary-20);
        padding: 30px 15px 12px 15px;
        margin: -20px 0 0 0;
        font-size: 14px;
        border-radius: 15px;
    }
    @media (max-width:640px){
        .signal-box {
            display: block;
            text-align: center;
        }
        .signal-box>* {
            width: 100%;
        }
    }

    .signal-box button {
        padding: 0px 20px;
        border-radius: 10px;
        font-size: 14px;
    }    
    .attachments{
        padding: 10px 0;
    }

    a.atlink i{
        font-style: normal;
    }
    a.atlink {
        display: flex;
        background: #fff;
        border: 1px solid var(--primary-10);
        border-radius: 5px;
        margin: 5px auto;
        padding: 5px 15px;
        font-size: 14px;
    }
    a.atlink .size {
        font-size: 9px; 
    }

    .bghead{
        position: relative;
        align-items: center;
        min-height: 100%;
        padding-top: 40px !important;
        padding-bottom: 80px !important;
        background-size: cover !important;
        background: linear-gradient(0deg, <?=$status ? "#a5e1a7" : "#e1ada5" ?>, #fff);
    }
    .txid{
        font-size: 16px;
        background: #fff;
        padding: 2px 20px 2px 20px;
        border-radius: 30px;
        margin-top: 10px;
        display: inline-block;
    }
    </style>
</head>

<body>
    <div class="base-content">
        @if($status)
        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div class="text w-100 text-center" style="margin-top: 60px;color: #006004;">
                <i class="fa-solid fa-circle-check" style="font-size: 32px;"></i><br>
                <span class="title" style="font-size: 24px;">با تشکر از پرداخت شما</span><br>
                @if($payment['ref_id'] ?? false)
                <small class="txid">شماره تراکنش: <?=to_persian_num($payment['ref_id'])?></small>
                @endif
            </div>
        </div>
        <div class="content" style="margin-top: 30px;text-align: center;font-size: 20px">
            <img src="<?=$logo??''?>" style="max-width: 64px">
            <div style="padding: 0 20px">از اعتماد شما سپاسگزاریم<br>می توانید از بخش دوره های من شروع به مشاهده محتوا کنید</div>
            <div><a href="<?=site_url('pwa/my-courses')?>" class="btn" style="min-width: 70%; margin-top: 30px;">مشاهده دوره های من</a></div>
        </div>
        @else
        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div class="text w-100 text-center" style="margin-top: 120px;color: #741603">
                <i class="fa-solid fa-circle-check" style="font-size: 32px;"></i><br>
                <span class="title" style="font-size: 24px;">پرداخت ناموفق بود</span><br>
            </div>
        </div>
        <div class="content" style="margin-top: 30px;text-align: center;font-size: 20px">
            <img src="<?=$logo??''?>" style="max-width: 64px">
            <div style="padding: 0 20px">در فرایند پرداخت شما مشکلی پیش آمده است. در صورت نیاز می توانید با پشتیبانی در تماس باشید</div>
            <div><a href="<?=site_url('pwa/courses')?>" class="btn" style="min-width: 70%; margin-top: 30px;">اقدام برای پرداخت مجدد</a></div>
        </div>
        @endif

    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages');
    @include('sdk.pwa._partials.scripts')


</body>

</html>
