<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به فیلمیمومدرسه</title>
    <link rel="manifest" href="https://7learn.com/manifest.json">
    <link rel="stylesheet" href="https://up.7learn.com/1/css/yekan/font.css">
    <link rel="stylesheet" href="https://cdn.planet.bz/font-icon/font-awesome/6.6.0/css/all.min.css"/>
    <style>

        * {
            font-family: "iranyekan";
        }
        html,body{
            height: 100%;
        }
        body {
            /* background: #f8f8f8 !important; */
            background: linear-gradient(to bottom, #DDF2FF 0%,#ffffff 100%);
            background-repeat:repeat-x !important;
            text-align: center;
            direction: rtl;
            margin: 0;
        }

        .auth-box {
            width: 80%;
            max-width: 400px;
            margin: 100px auto;
            padding: 0 2px;
            text-align: right;
        }
        h2{
            font-size: 24px;
            font-weight: 900;
        }
        h2 i{
            font-size: 20px;
            color:#777;
            vertical-align: sub;
            margin-left: 7px;
        }
        h4{
            font-size: 14px;
            font-weight: 300;
        }

        .input-field, .button {
            width: calc(100% - 4px);
            padding: 15px 10px;
            margin: 10px 0 0 0;
            border:1px solid #f3f3f3;
            border-radius: 4px;
            font-size: 18px;
            font-weight: 500;
            color:#333;
            box-sizing: border-box;
            background-color: #ffffff;
        }
        .input-field:focus,.input-field:hover,.input-field:active {
            border:1px solid #777777;
            background-color: #ffffff;
            outline: 0;
        }
        .input-field {
            border: 1px solid #ccc;
            direction: ltr;
            text-align: center;
        }
        .button {
            background-color: #007bec;
            color: #fff;
            border: none;
            padding: 15px 10px;
            font-size: 18px;
            cursor: pointer;
        }
        .links {
            font-size: 14px;
            margin-top: 15px;
            line-height: 36px;
        }
        .links a {
            text-decoration: none;
            color: #666;
            display: block;
            margin: 5px 0;
        }
        .links i{
            margin-left: 3px;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="auth-box">
        <h2>
            <!-- <i class="fa-solid fa-chevron-right"></i><br> -->
            <!-- <a href="https://7Learn.com"></a> -->
            ورود به سایت
        </h2>
        <h4>برای ثبت‌نام/ورود شماره موبایل خود را وارد کنید:</h4>
        <input type="text" name="username" id="username" class="input-field" placeholder="موبایل / ایمیل / نام کاربری">
        <button class="button">ادامه</button>
        <div class="links">
            <a href="#"><i class="fa-solid fa-envelope-circle-check"></i> ورود با رمز یکبارمصرف</a>
            <a href="#"><i class="fa-solid fa-clock-rotate-left"></i> فراموشی رمز عبور</a>
        </div>
    </div>

</body>
</html>