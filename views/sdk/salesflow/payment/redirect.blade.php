<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'در حال انتقال' }}</title>
    <style>
        @font-face {
            font-family: iransans;
            src: url(https://cdn.planet.bz/font/iransans/1.0.0/IRANSansWeb.woff);
        }
        body *{
            font-family: iransans,tahoma;
            text-align: center;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            direction: rtl;
            color: #ffffff;
            background: #272727 url(https://up.7learn.com/1/bg/bgt-70.png) !important;
            background-repeat: repeat-x !important;
        }

        #loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #4CAF50;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 10px auto;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .gobtn:hover {
            background-color: #499F50;
        }
        .gobtn {
            background-color: #333;
            color: white;
            padding: 10px 32px;
            margin: 30px auto;
            text-align: center;
            display: block;
            font-size: 20px;
            cursor: pointer;
            border-radius: 8px;
            border: none;
        }

        .red {
            color: #c01919;
        }

        .green {
            color: #4CAF50;
        }
    </style>
</head>
<body>
<div>
    <h3 style="font-size: 25px;" class="{{ $isSuccess ? 'green' : 'red' }}">{{ $message }}</h3>
    <p>در صورت منتقل نشدن روی دکمه زیر کلیک کنید ...</p>
    <button class="gobtn" onclick="submitForm()">کلیک کنید</button>
    <div id="loader"></div>
</div>

<form method="{{ $nextInstruction['method'] }}" action="{{ $nextInstruction['url'] }}" id="redirect-form">
    <input type="hidden" name="status" value="{{ $isSuccess ? 1 : 0 }}">
    @if(! empty($nextInstruction['payload']))
        @foreach($nextInstruction['payload'] as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    @endif
</form>

<script>
    function submitForm() {
        document.getElementById('redirect-form').submit()
    }

    window.setTimeout("submitForm()", 2000);
</script>

</body>
</html>
