<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>درحال بروزرسانی زیرساخت هستیم، لطفا چند دقیقه دیگر مجددا تلاش کنید...</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        body{
            background: #2b2f36;
            display: -webkit-flex;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
            min-height: 80vh;
            direction: rtl;
            text-align: center;
            font-family: 'iransansxv', tahoma !important;
            padding: 10vh 12vw;
        }
        @font-face {
            font-family: 'iransansxv';
            src: url('<?= core_url('css/fonts/iransans/iransansxv.woff') ?>') format('woff-variations'),
            url('<?= core_url('css/fonts/iransans/iransansxv.woff') ?>') format('woff');
            font-weight: 100 900;
            font-display: fallback;
        }
        .icon{
            width: 150px;
            margin-bottom: 40px;
        }
        .title{
            color: white;
            font-weight: 600;
            font-size: 32px;
            line-height: 44px;
        }
        .subtitle{
            color: white;
            font-weight: 300;
            font-size: 22px;
            line-height: 34px;
            opacity: .4;
        }
        @media (max-width: 1599.98px) {
            body{
                gap: 24px;
            }
            .icon{
                width: 100px;
                margin-bottom: 20px;
            }
            .title{
                font-size: 27px;
            }
            .subtitle{
                font-size: 19px;
            }
        }
        @media (max-width: 575.98px) {
            body{
                gap: 10px;
            }
            .icon{
                width: 65px;
            }
            .title{
                font-weight: 500;
                font-size: 20px;
                line-height: 40px;
            }
            .subtitle{
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
<img src="<?= core_url('img/icons/server.svg') ?>" alt="" class="icon">
<span class="title">درحال بروزرسانی زیرساخت هستیم</span>
<span class="subtitle">لطفا چند دقیقه دیگر مجددا تلاش کنید...</span>
<script>
    setTimeout(() => {
        window.location.reload();
    }, 60000);
</script>
</body>
</html>
