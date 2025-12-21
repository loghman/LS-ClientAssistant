@extends('sdk._common.layouts.foundation')

@section('heads')
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>جزئیات پرداخت</title>
    <link rel="manifest" href="https://7learn.com/manifest.json"/>
    <link rel="stylesheet" href="https://up.7learn.com/1/css/yekan/font.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <link rel="icon" href="{{ setting('favicon') }}">
    <style>
        :root {
            --gutter: 20px;
            --bullet-size: 30px;
            --bullet-size-half-negetive: calc(var(--bullet-size) / 2 * -1);
        }

        ul {
            list-style: none;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        * {
            font-family: "iranyekan";
            padding: 0;
            margin: 0;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100vh;
            overflow-x: hidden;
        }

        body {
            direction: rtl;
            margin: 0;
            padding: calc(var(--gutter) * 1.5);
            color: #1e293b;
            background-color: #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: calc(var(--gutter) * 1.5);
            -moz-font-feature-settings: "ss02";
            -webkit-font-feature-settings: "ss02";
            font-feature-settings: "ss02";
        }

        body > * {
            width: 100%;
        }

        .invoice {
            background-color: white;
            border-radius: 10px;
            opacity: 1;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 4px 6px -1px #0000001a, 0 2px 4px -2px #0000001a;
        }

        .invoice > .heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--gutter);
            padding: var(--gutter) calc(var(--gutter) * 2);
            position: relative;
        }

        .invoice > .heading:before,
        .invoice > .heading:after {
            position: absolute;
            content: "";
            width: var(--bullet-size);
            height: var(--bullet-size);
            border-radius: 50%;
            background-color: #f1f5f9;
        }

        .invoice > .heading:not(.last) {
            border-bottom: dotted 1px rgba(0, 0, 0, 0.1);
        }


        .invoice > .heading:not(.last):before,
        .invoice > .heading:not(.last):after {
            bottom: var(--bullet-size-half-negetive);
        }

        .invoice > .heading.last:before,
        .invoice > .heading.last:after {
            top: var(--bullet-size-half-negetive);
        }

        .invoice > .heading:before {
            right: var(--bullet-size-half-negetive);
        }

        .invoice > .heading:after {
            left: var(--bullet-size-half-negetive);
        }

        .row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .col {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .t-heading {
            font-size: 30px;
            font-weight: 700;
            line-height: 50px;
        }

        .t-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 30px;
        }

        .t-text,
        .btn,
        .badge {
            font-size: 16px;
            line-height: 32px;
        }

        .t-subtitle {
            font-size: 15px;
            font-weight: 300;
            line-height: 24px;
            color: #94a3b8;
        }

        .text-center {
            text-align: center;
        }

        .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
        }

        .list {
            display: flex;
            flex-direction: column;
            gap: calc(var(--gutter) / 2);
            padding: calc(var(--gutter) * 2);
        }

        .list .item .prc {
            min-width: 80px;
            display: inline-block;
            text-align: left;
            padding-left: 5px;
        }

        .list .item del {
            color: #cacaca;
        }

        .list .item {
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: var(--gutter);
        }

        .list .item.sum span {
            font-weight: 700;
        }


        .list .item:before {
            position: absolute;
            content: "";
            height: 1px;
            width: 100%;
            border-bottom: dashed 1px rgba(0, 0, 0, 0.1);
        }

        .list .item > * {
            background: white;
            position: relative;
            z-index: 1;
        }

        .list .item :first-child {
            padding-left: 14px;
        }

        .list .item :last-child {
            padding-right: 14px;
        }

        .list .item.last {
            margin-top: 12px;
            padding-top: 24px;
        }

        .timeline {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: calc(var(--gutter) * 2);
            padding-top: var(--gutter);
        }

        .timeline .item .date {
            font-size: 12px;
            display: inline-block;
            margin-right: 5px;
            color: #777;
        }

        .timeline .item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--gutter);
            border-radius: 5px;
            padding: calc(var(--gutter) * .75) var(--gutter) calc(var(--gutter) * .75) calc(var(--gutter) * .75);
            background-color: #f1f5f9;
            transition: all ease-in-out .15s;
        }

        .timeline .item.success {
            background-color: #ddf8f0;
        }

        .timeline a.item:hover {
            background-color: #e2e8f0;
        }

        .text-success {
            color: #1ECE9A;
        }

        .text-primary {
            color: #428DED;
        }

        .text-danger {
            color: #ffc107;
        }

        .text-red {
            color: #fb5252;
        }

        .btn {
            cursor: pointer;
        }

        .btn,
        .badge {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: calc(var(--gutter) / 4) var(--gutter);
            border-radius: 5px;
            background-color: #428DED;
            color: white;
            transition: all ease-in-out .15s;
        }

        .btn i,
        .badge i {
            font-size: 14px;
        }

        .btn.success,
        .badge.success {
            background-color: #1ECE9A;
        }


        .btn.gray,
        .badge.gray {
            background-color: #94a3b8;
        }

        a.btn:hover {
            opacity: .7;
        }

        .fw-normal {
            font-weight: 500;
        }

        .bold {
            font-weight: 600;
        }

        .progress {
            position: relative;
            height: 5px;
            border-radius: 5px;
            width: 100px;
            background-color: #e2e8f0;
            overflow: hidden;
            --w: 0;
        }

        .progress:before {
            position: absolute;
            content: "";
            width: var(--w);
            height: 100%;
            left: 0;
            background-color: #1ECE9A;
        }

        .brand-logo {
            width: 140px;
        }

        .capacity-full,
        .capacity-short {
            padding: 0 !important;
        }

        .btn[disabled=disabled] {
            cursor: not-allowed;
        }

        .alert {
            padding: calc(var(--gutter) * 2);
            padding-top: var(--gutter);
            padding-bottom: var(--gutter);
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }

        .alert.danger {
            background-color: #ffc107;
        }

        .alert.success {
            background-color: #ddf8f0;
        }

        .alert.success .heading {
            display: flex;
            align-items: center;
        }

        .alert.success .heading i {
            font-size: 24px;
            margin-left: 10px;
        }

        .alert.success .heading .btn {
            margin-right: auto;
            min-width: 100px;
        }

        .alert .subtitle {
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
        }

        @media (max-width: 575.99px) {
            :root {
                --bullet-size: 20px;
            }

            body {
                padding: calc(var(--gutter) * 1.5) calc(var(--gutter) * .5);
            }

            .invoice > .heading {
                padding: calc(var(--gutter) * .5) calc(var(--gutter) * 1.5);
            }

            .invoice > .heading.last {
                flex-direction: column;
                align-items: center;
                gap: calc(var(--gutter) * .35);
                padding: calc(var(--gutter) * .5) var(--gutter);
            }

            .capacity-full {
                display: none;
            }

            .list {
                padding: var(--gutter) calc(var(--gutter) * 1.5);
            }

            .list .item .prc, .list .item del {
                font-size: 14px;
            }

            .list .item .prc {
                min-width: 60px;
                padding-left: 0;
            }

            .timeline .item > * {
                width: 100%;
                justify-content: space-between;
            }

            .timeline {
                padding: calc(var(--gutter) * .5);
            }

            .timeline .item {
                flex-direction: column;
                gap: calc(var(--gutter) * .35);
                padding: calc(var(--gutter) * .5) calc(var(--gutter) * .75);
            }


            .avatar {
                width: 38px;
                height: 38px;
            }

            .t-title {
                font-size: 18px;
                font-weight: 600;
            }

            .t-heading {
                font-size: 24px;
                line-height: 30px;
            }

            .btn,
            .badge {
                gap: 5px;
                padding: calc(var(--gutter) / 8) calc(var(--gutter) / 2);
            }

            .brand-logo {
                width: 120px;
            }

            .d-none-responsive {
                display: none;
            }

            .alert.success .heading span {
                font-size: 14px;
            }
        }

        @media (max-width: 767px) {
            .alert {
                padding-left: 12px;
                padding-right: 12px;
            }

            .alert.success .heading .btn {
                font-size: 14px;
                padding: 10px 5px;
                justify-content: center;
            }
        }


        @media (min-width: 576px) {
            .capacity-short {
                display: none;
            }
        }
    </style>
@endsection

@section('body')
    <h1 class="t-heading text-center">فاکتور پرداخت</h1>
    @include('sdk.salesflow.invoice.partials.notices')
    <div class="invoice">
        @include('sdk.salesflow.invoice.partials.heading')
        @include('sdk.salesflow.invoice.partials.list')
        @include('sdk.salesflow.invoice.partials.timeline')
        @include('sdk.salesflow.invoice.partials.footer')
    </div>
    <img src="{{ setting('png_logo_url') }}" alt="{{ setting('brand_name_fa') }}" class=brand-logo>
@endsection