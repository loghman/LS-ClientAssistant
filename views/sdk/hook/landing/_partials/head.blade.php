<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @hasSection('title')
        <title>@yield('title')</title>
    @endif
    <link rel="stylesheet" href="{{ core_url('css/clients/hook/landing.css') }}?v=9">
    @stack('head')
</head>
<body>