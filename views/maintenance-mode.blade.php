<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>درحال بروزرسانی زیرساخت هستیم، لطفا چند دقیقه دیگر مجددا تلاش کنید...</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
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
            src: url('<?= core_url(' css/fonts/iransans/iransansxv.woff') ?>') format('woff-variations'),
                url('<?= core_url(' css/fonts/iransans/iransansxv.woff') ?>') format('woff');
            font-weight: 100 900;
            font-display: fallback;
        }

        .icon {
            width: 150px;
            margin-bottom: 40px;
        }

        .title {
            color: white;
            font-weight: 600;
            font-size: 32px;
            line-height: 44px;
        }

        .subtitle {
            color: white;
            font-weight: 300;
            font-size: 22px;
            line-height: 34px;
            opacity: .4;
        }

        @media (max-width: 1599.98px) {
            body {
                gap: 24px;
            }

            .icon {
                width: 100px;
                margin-bottom: 20px;
            }

            .title {
                font-size: 27px;
            }

            .subtitle {
                font-size: 19px;
            }
        }

        @media (max-width: 575.98px) {
            body {
                gap: 10px;
            }

            .icon {
                width: 65px;
            }

            .title {
                font-weight: 500;
                font-size: 20px;
                line-height: 40px;
            }

            .subtitle {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

    <svg width="150" height="150" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.5"
            d="M66.667 566.667C66.667 503.813 66.667 472.387 86.1933 452.86C105.719 433.334 137.146 433.333 200 433.333H600C662.854 433.333 694.28 433.334 713.807 452.86C733.334 472.387 733.334 503.813 733.334 566.667C733.334 629.52 733.334 660.947 713.807 680.473C694.28 700 662.854 700 600 700H200C137.146 700 105.719 700 86.1933 680.473C66.667 660.947 66.667 629.52 66.667 566.667Z"
            stroke="white" stroke-width="50" />
        <path opacity="0.5"
            d="M66.667 200C66.667 137.146 66.667 105.719 86.1933 86.1928C105.719 66.6665 137.146 66.6665 200 66.6665H600C662.854 66.6665 694.28 66.6665 713.807 86.1928C733.334 105.719 733.334 137.146 733.334 200C733.334 262.854 733.334 294.281 713.807 313.807C694.28 333.333 662.854 333.333 600 333.333H200C137.146 333.333 105.719 333.333 86.1933 313.807C66.667 294.281 66.667 262.854 66.667 200Z"
            stroke="white" stroke-width="50" />
        <path d="M450 200H600" stroke="white" stroke-width="50" stroke-linecap="round" />
        <path d="M200 233.333V166.667" stroke="white" stroke-width="50" stroke-linecap="round" />
        <path d="M300 233.333V166.667" stroke="white" stroke-width="50" stroke-linecap="round" />
        <path d="M450 566.667H600" stroke="white" stroke-width="50" stroke-linecap="round" />
        <path d="M200 600V533.333" stroke="white" stroke-width="50" stroke-linecap="round" />
        <path d="M300 600V533.333" stroke="white" stroke-width="50" stroke-linecap="round" />
    </svg>
    <span class="title">درحال بروزرسانی زیرساخت هستیم</span>
    <span class="subtitle">لطفا چند دقیقه دیگر مجددا تلاش کنید...</span>
    <script>
        setTimeout(() => {
        window.location.reload();
    }, 60000);
    </script>
</body>

</html>