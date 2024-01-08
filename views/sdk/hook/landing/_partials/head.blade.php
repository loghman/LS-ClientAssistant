<!doctype html>
<html dir="rtl" lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title')</title>
    @endif
    <link rel="stylesheet" href="{{ core_asset('resources/assets/css/clients/hook/landing.scss') }}">
    @stack('head')
</head>
<body class="ls-client-hook-body">