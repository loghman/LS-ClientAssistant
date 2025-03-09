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
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#148ef3">
    <meta name="apple-mobile-web-app-title" content="{{setting('brand_name_en')}}">
    <meta name="application-name" content="{{setting('brand_name_en')}}">
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

        /*!
 * Bootstrap Grid v5.2.0-beta1 (https://getbootstrap.com/)
 * Copyright 2011-2022 The Bootstrap Authors
 * Copyright 2011-2022 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 */
        .container,
        .container-fluid,
        .container-xxl,
        .container-xl,
        .container-lg,
        .container-md,
        .container-sm {
            --bs-gutter-x: 24px;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container-sm,
            .container {
                max-width: 540px;
            }
        }
        @media (min-width: 768px) {
            .container-md,
            .container-sm,
            .container {
                max-width: 720px;
            }
        }
        @media (min-width: 992px) {
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 960px;
            }
        }
        @media (min-width: 1200px) {
            .container-xl,
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 1140px;
            }
        }
        @media (min-width: 1400px) {
            .container-xxl,
            .container-xl,
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 1320px;
            }
        }
        @media (min-width: 1750px) {
            .container-xxxl,
            .container-xxl,
            .container-xl,
            .container-lg,
            .container-md,
            .container-sm,
            .container {
                max-width: 1600px;
            }
        }
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-0.5 * var(--bs-gutter-x));
            margin-left: calc(-0.5 * var(--bs-gutter-x));
        }

        .row > * {
            box-sizing: border-box;
            flex-shrink: 0;
            width: 100%;
            max-width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-top: var(--bs-gutter-y);
        }

        .row {
            --bs-gutter-x: var(--base-gutter);
            gap: var(--base-gutter) 0;
        }

        .row-lg {
            --bs-gutter-x: calc(var(--base-gutter) * 2);
            gap: calc(var(--base-gutter) * 2) 0;
            margin-top: calc(var(--base-gutter) * 2);
            margin-bottom: calc(var(--base-gutter) * 2);
        }

        .row-fix {
            position: relative;
            right: calc(var(--base-gutter) / 2 * -1);
            width: calc(100% + var(--base-gutter));
            gap: var(--base-gutter) 0;
            margin-right: 0;
            margin-left: 0;
            align-items: stretch;
        }
        .row-fix > * {
            --bs-gutter-x: var(--base-gutter);
        }
        .row-fix > * > * {
            width: 100% !important;
            min-width: 100% !important;
        }

        .row-fix-m {
            margin-right: 0;
            margin-left: 0;
            padding-right: var(--bs-gutter-x);
            padding-left: var(--bs-gutter-x);
        }

        .col {
            flex: 1 0 0%;
        }

        .row-cols-auto > * {
            flex: 0 0 auto;
            width: auto;
        }

        .row-cols-1 > * {
            flex: 0 0 auto;
            width: 100%;
        }

        .row-cols-2 > * {
            flex: 0 0 auto;
            width: 50%;
        }

        .row-cols-3 > * {
            flex: 0 0 auto;
            width: 33.3333333333%;
        }

        .row-cols-4 > * {
            flex: 0 0 auto;
            width: 25%;
        }

        .row-cols-5 > * {
            flex: 0 0 auto;
            width: 20%;
        }

        .row-cols-6 > * {
            flex: 0 0 auto;
            width: 16.6666666667%;
        }

        .col-auto {
            flex: 0 0 auto;
            width: auto;
        }

        .col-1 {
            flex: 0 0 auto;
            width: 8.33333333%;
        }

        .col-2 {
            flex: 0 0 auto;
            width: 16.66666667%;
        }

        .col-2-5 {
            flex: 0 0 auto;
            width: 20.83333333%;
        }

        .col-3 {
            flex: 0 0 auto;
            width: 25%;
        }

        .col-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }

        .col-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .col-7 {
            flex: 0 0 auto;
            width: 58.33333333%;
        }

        .col-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }

        .col-9 {
            flex: 0 0 auto;
            width: 75%;
        }

        .col-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }

        .col-11 {
            flex: 0 0 auto;
            width: 91.66666667%;
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .offset-1 {
            margin-left: 8.33333333%;
        }

        .offset-2 {
            margin-left: 16.66666667%;
        }

        .offset-3 {
            margin-left: 25%;
        }

        .offset-4 {
            margin-left: 33.33333333%;
        }

        .offset-5 {
            margin-left: 41.66666667%;
        }

        .offset-6 {
            margin-left: 50%;
        }

        .offset-7 {
            margin-left: 58.33333333%;
        }

        .offset-8 {
            margin-left: 66.66666667%;
        }

        .offset-9 {
            margin-left: 75%;
        }

        .offset-10 {
            margin-left: 83.33333333%;
        }

        .offset-11 {
            margin-left: 91.66666667%;
        }

        .g-0,
        .gx-0 {
            --bs-gutter-x: 0;
        }

        .g-0,
        .gy-0 {
            --bs-gutter-y: 0;
        }

        .g-1,
        .gx-1 {
            --bs-gutter-x: 0.25rem;
        }

        .g-1,
        .gy-1 {
            --bs-gutter-y: 0.25rem;
        }

        .g-2,
        .gx-2 {
            --bs-gutter-x: 0.5rem;
        }

        .g-2,
        .gy-2 {
            --bs-gutter-y: 0.5rem;
        }

        .g-3,
        .gx-3 {
            --bs-gutter-x: 1rem;
        }

        .g-3,
        .gy-3 {
            --bs-gutter-y: 1rem;
        }

        .g-4,
        .gx-4 {
            --bs-gutter-x: 1.5rem;
        }

        .g-4,
        .gy-4 {
            --bs-gutter-y: 1.5rem;
        }

        .g-5,
        .gx-5 {
            --bs-gutter-x: 3rem;
        }

        .g-5,
        .gy-5 {
            --bs-gutter-y: 3rem;
        }

        @media (min-width: 576px) {
            .col-sm {
                flex: 1 0 0%;
            }
            .row-cols-sm-auto > * {
                flex: 0 0 auto;
                width: auto;
            }
            .row-cols-sm-1 > * {
                flex: 0 0 auto;
                width: 100%;
            }
            .row-cols-sm-2 > * {
                flex: 0 0 auto;
                width: 50%;
            }
            .row-cols-sm-3 > * {
                flex: 0 0 auto;
                width: 33.3333333333%;
            }
            .row-cols-sm-4 > * {
                flex: 0 0 auto;
                width: 25%;
            }
            .row-cols-sm-5 > * {
                flex: 0 0 auto;
                width: 20%;
            }
            .row-cols-sm-6 > * {
                flex: 0 0 auto;
                width: 16.6666666667%;
            }
            .col-sm-auto {
                flex: 0 0 auto;
                width: auto;
            }
            .col-sm-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-sm-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-sm-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-sm-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-sm-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-sm-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-sm-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-sm-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-sm-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-sm-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-sm-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-sm-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-sm-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-sm-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .offset-sm-0 {
                margin-left: 0;
            }
            .offset-sm-1 {
                margin-left: 8.33333333%;
            }
            .offset-sm-2 {
                margin-left: 16.66666667%;
            }
            .offset-sm-3 {
                margin-left: 25%;
            }
            .offset-sm-4 {
                margin-left: 33.33333333%;
            }
            .offset-sm-5 {
                margin-left: 41.66666667%;
            }
            .offset-sm-6 {
                margin-left: 50%;
            }
            .offset-sm-7 {
                margin-left: 58.33333333%;
            }
            .offset-sm-8 {
                margin-left: 66.66666667%;
            }
            .offset-sm-9 {
                margin-left: 75%;
            }
            .offset-sm-10 {
                margin-left: 83.33333333%;
            }
            .offset-sm-11 {
                margin-left: 91.66666667%;
            }
            .g-sm-0,
            .gx-sm-0 {
                --bs-gutter-x: 0;
            }
            .g-sm-0,
            .gy-sm-0 {
                --bs-gutter-y: 0;
            }
            .g-sm-1,
            .gx-sm-1 {
                --bs-gutter-x: 0.25rem;
            }
            .g-sm-1,
            .gy-sm-1 {
                --bs-gutter-y: 0.25rem;
            }
            .g-sm-2,
            .gx-sm-2 {
                --bs-gutter-x: 0.5rem;
            }
            .g-sm-2,
            .gy-sm-2 {
                --bs-gutter-y: 0.5rem;
            }
            .g-sm-3,
            .gx-sm-3 {
                --bs-gutter-x: 1rem;
            }
            .g-sm-3,
            .gy-sm-3 {
                --bs-gutter-y: 1rem;
            }
            .g-sm-4,
            .gx-sm-4 {
                --bs-gutter-x: 1.5rem;
            }
            .g-sm-4,
            .gy-sm-4 {
                --bs-gutter-y: 1.5rem;
            }
            .g-sm-5,
            .gx-sm-5 {
                --bs-gutter-x: 3rem;
            }
            .g-sm-5,
            .gy-sm-5 {
                --bs-gutter-y: 3rem;
            }
        }
        @media (min-width: 768px) {
            .col-md {
                flex: 1 0 0%;
            }
            .row-cols-md-auto > * {
                flex: 0 0 auto;
                width: auto;
            }
            .row-cols-md-1 > * {
                flex: 0 0 auto;
                width: 100%;
            }
            .row-cols-md-2 > * {
                flex: 0 0 auto;
                width: 50%;
            }
            .row-cols-md-3 > * {
                flex: 0 0 auto;
                width: 33.3333333333%;
            }
            .row-cols-md-4 > * {
                flex: 0 0 auto;
                width: 25%;
            }
            .row-cols-md-5 > * {
                flex: 0 0 auto;
                width: 20%;
            }
            .row-cols-md-6 > * {
                flex: 0 0 auto;
                width: 16.6666666667%;
            }
            .col-md-auto {
                flex: 0 0 auto;
                width: auto;
            }
            .col-md-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-md-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-md-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-md-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-md-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-md-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-md-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-md-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-md-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-md-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-md-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-md-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-md-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-md-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .offset-md-0 {
                margin-left: 0;
            }
            .offset-md-1 {
                margin-left: 8.33333333%;
            }
            .offset-md-2 {
                margin-left: 16.66666667%;
            }
            .offset-md-3 {
                margin-left: 25%;
            }
            .offset-md-4 {
                margin-left: 33.33333333%;
            }
            .offset-md-5 {
                margin-left: 41.66666667%;
            }
            .offset-md-6 {
                margin-left: 50%;
            }
            .offset-md-7 {
                margin-left: 58.33333333%;
            }
            .offset-md-8 {
                margin-left: 66.66666667%;
            }
            .offset-md-9 {
                margin-left: 75%;
            }
            .offset-md-10 {
                margin-left: 83.33333333%;
            }
            .offset-md-11 {
                margin-left: 91.66666667%;
            }
            .g-md-0,
            .gx-md-0 {
                --bs-gutter-x: 0;
            }
            .g-md-0,
            .gy-md-0 {
                --bs-gutter-y: 0;
            }
            .g-md-1,
            .gx-md-1 {
                --bs-gutter-x: 0.25rem;
            }
            .g-md-1,
            .gy-md-1 {
                --bs-gutter-y: 0.25rem;
            }
            .g-md-2,
            .gx-md-2 {
                --bs-gutter-x: 0.5rem;
            }
            .g-md-2,
            .gy-md-2 {
                --bs-gutter-y: 0.5rem;
            }
            .g-md-3,
            .gx-md-3 {
                --bs-gutter-x: 1rem;
            }
            .g-md-3,
            .gy-md-3 {
                --bs-gutter-y: 1rem;
            }
            .g-md-4,
            .gx-md-4 {
                --bs-gutter-x: 1.5rem;
            }
            .g-md-4,
            .gy-md-4 {
                --bs-gutter-y: 1.5rem;
            }
            .g-md-5,
            .gx-md-5 {
                --bs-gutter-x: 3rem;
            }
            .g-md-5,
            .gy-md-5 {
                --bs-gutter-y: 3rem;
            }
        }
        @media (min-width: 992px) {
            .col-lg {
                flex: 1 0 0%;
            }
            .row-cols-lg-auto > * {
                flex: 0 0 auto;
                width: auto;
            }
            .row-cols-lg-1 > * {
                flex: 0 0 auto;
                width: 100%;
            }
            .row-cols-lg-2 > * {
                flex: 0 0 auto;
                width: 50%;
            }
            .row-cols-lg-3 > * {
                flex: 0 0 auto;
                width: 33.3333333333%;
            }
            .row-cols-lg-4 > * {
                flex: 0 0 auto;
                width: 25%;
            }
            .row-cols-lg-5 > * {
                flex: 0 0 auto;
                width: 20%;
            }
            .row-cols-lg-6 > * {
                flex: 0 0 auto;
                width: 16.6666666667%;
            }
            .col-lg-auto {
                flex: 0 0 auto;
                width: auto;
            }
            .col-lg-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-lg-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-lg-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-lg-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-lg-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-lg-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-lg-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-lg-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-lg-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-lg-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-lg-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-lg-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-lg-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-lg-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .offset-lg-0 {
                margin-left: 0;
            }
            .offset-lg-1 {
                margin-left: 8.33333333%;
            }
            .offset-lg-2 {
                margin-left: 16.66666667%;
            }
            .offset-lg-3 {
                margin-left: 25%;
            }
            .offset-lg-4 {
                margin-left: 33.33333333%;
            }
            .offset-lg-5 {
                margin-left: 41.66666667%;
            }
            .offset-lg-6 {
                margin-left: 50%;
            }
            .offset-lg-7 {
                margin-left: 58.33333333%;
            }
            .offset-lg-8 {
                margin-left: 66.66666667%;
            }
            .offset-lg-9 {
                margin-left: 75%;
            }
            .offset-lg-10 {
                margin-left: 83.33333333%;
            }
            .offset-lg-11 {
                margin-left: 91.66666667%;
            }
            .g-lg-0,
            .gx-lg-0 {
                --bs-gutter-x: 0;
            }
            .g-lg-0,
            .gy-lg-0 {
                --bs-gutter-y: 0;
            }
            .g-lg-1,
            .gx-lg-1 {
                --bs-gutter-x: 0.25rem;
            }
            .g-lg-1,
            .gy-lg-1 {
                --bs-gutter-y: 0.25rem;
            }
            .g-lg-2,
            .gx-lg-2 {
                --bs-gutter-x: 0.5rem;
            }
            .g-lg-2,
            .gy-lg-2 {
                --bs-gutter-y: 0.5rem;
            }
            .g-lg-3,
            .gx-lg-3 {
                --bs-gutter-x: 1rem;
            }
            .g-lg-3,
            .gy-lg-3 {
                --bs-gutter-y: 1rem;
            }
            .g-lg-4,
            .gx-lg-4 {
                --bs-gutter-x: 1.5rem;
            }
            .g-lg-4,
            .gy-lg-4 {
                --bs-gutter-y: 1.5rem;
            }
            .g-lg-5,
            .gx-lg-5 {
                --bs-gutter-x: 3rem;
            }
            .g-lg-5,
            .gy-lg-5 {
                --bs-gutter-y: 3rem;
            }
        }
        @media (min-width: 1200px) {
            .col-xl {
                flex: 1 0 0%;
            }
            .row-cols-xl-auto > * {
                flex: 0 0 auto;
                width: auto;
            }
            .row-cols-xl-1 > * {
                flex: 0 0 auto;
                width: 100%;
            }
            .row-cols-xl-2 > * {
                flex: 0 0 auto;
                width: 50%;
            }
            .row-cols-xl-3 > * {
                flex: 0 0 auto;
                width: 33.3333333333%;
            }
            .row-cols-xl-4 > * {
                flex: 0 0 auto;
                width: 25%;
            }
            .row-cols-xl-5 > * {
                flex: 0 0 auto;
                width: 20%;
            }
            .row-cols-xl-6 > * {
                flex: 0 0 auto;
                width: 16.6666666667%;
            }
            .col-xl-auto {
                flex: 0 0 auto;
                width: auto;
            }
            .col-xl-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-xl-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-xl-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-xl-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-xl-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-xl-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-xl-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-xl-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-xl-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-xl-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-xl-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-xl-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-xl-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-xl-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .offset-xl-0 {
                margin-left: 0;
            }
            .offset-xl-1 {
                margin-left: 8.33333333%;
            }
            .offset-xl-2 {
                margin-left: 16.66666667%;
            }
            .offset-xl-3 {
                margin-left: 25%;
            }
            .offset-xl-4 {
                margin-left: 33.33333333%;
            }
            .offset-xl-5 {
                margin-left: 41.66666667%;
            }
            .offset-xl-6 {
                margin-left: 50%;
            }
            .offset-xl-7 {
                margin-left: 58.33333333%;
            }
            .offset-xl-8 {
                margin-left: 66.66666667%;
            }
            .offset-xl-9 {
                margin-left: 75%;
            }
            .offset-xl-10 {
                margin-left: 83.33333333%;
            }
            .offset-xl-11 {
                margin-left: 91.66666667%;
            }
            .g-xl-0,
            .gx-xl-0 {
                --bs-gutter-x: 0;
            }
            .g-xl-0,
            .gy-xl-0 {
                --bs-gutter-y: 0;
            }
            .g-xl-1,
            .gx-xl-1 {
                --bs-gutter-x: 0.25rem;
            }
            .g-xl-1,
            .gy-xl-1 {
                --bs-gutter-y: 0.25rem;
            }
            .g-xl-2,
            .gx-xl-2 {
                --bs-gutter-x: 0.5rem;
            }
            .g-xl-2,
            .gy-xl-2 {
                --bs-gutter-y: 0.5rem;
            }
            .g-xl-3,
            .gx-xl-3 {
                --bs-gutter-x: 1rem;
            }
            .g-xl-3,
            .gy-xl-3 {
                --bs-gutter-y: 1rem;
            }
            .g-xl-4,
            .gx-xl-4 {
                --bs-gutter-x: 1.5rem;
            }
            .g-xl-4,
            .gy-xl-4 {
                --bs-gutter-y: 1.5rem;
            }
            .g-xl-5,
            .gx-xl-5 {
                --bs-gutter-x: 3rem;
            }
            .g-xl-5,
            .gy-xl-5 {
                --bs-gutter-y: 3rem;
            }
        }
        @media (min-width: 1400px) {
            .col-xxl {
                flex: 1 0 0%;
            }
            .row-cols-xxl-auto > * {
                flex: 0 0 auto;
                width: auto;
            }
            .row-cols-xxl-1 > * {
                flex: 0 0 auto;
                width: 100%;
            }
            .row-cols-xxl-2 > * {
                flex: 0 0 auto;
                width: 50%;
            }
            .row-cols-xxl-3 > * {
                flex: 0 0 auto;
                width: 33.3333333333%;
            }
            .row-cols-xxl-4 > * {
                flex: 0 0 auto;
                width: 25%;
            }
            .row-cols-xxl-5 > * {
                flex: 0 0 auto;
                width: 20%;
            }
            .row-cols-xxl-6 > * {
                flex: 0 0 auto;
                width: 16.6666666667%;
            }
            .col-xxl-auto {
                flex: 0 0 auto;
                width: auto;
            }
            .col-xxl-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-xxl-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-xxl-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-xxl-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-xxl-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-xxl-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-xxl-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-xxl-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-xxl-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-xxl-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-xxl-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-xxl-9-5 {
                flex: 0 0 auto;
                width: 79.16666666%;
            }
            .col-xxl-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-xxl-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-xxl-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .offset-xxl-0 {
                margin-left: 0;
            }
            .offset-xxl-1 {
                margin-left: 8.33333333%;
            }
            .offset-xxl-2 {
                margin-left: 16.66666667%;
            }
            .offset-xxl-3 {
                margin-left: 25%;
            }
            .offset-xxl-4 {
                margin-left: 33.33333333%;
            }
            .offset-xxl-5 {
                margin-left: 41.66666667%;
            }
            .offset-xxl-6 {
                margin-left: 50%;
            }
            .offset-xxl-7 {
                margin-left: 58.33333333%;
            }
            .offset-xxl-8 {
                margin-left: 66.66666667%;
            }
            .offset-xxl-9 {
                margin-left: 75%;
            }
            .offset-xxl-10 {
                margin-left: 83.33333333%;
            }
            .offset-xxl-11 {
                margin-left: 91.66666667%;
            }
            .g-xxl-0,
            .gx-xxl-0 {
                --bs-gutter-x: 0;
            }
            .g-xxl-0,
            .gy-xxl-0 {
                --bs-gutter-y: 0;
            }
            .g-xxl-1,
            .gx-xxl-1 {
                --bs-gutter-x: 0.25rem;
            }
            .g-xxl-1,
            .gy-xxl-1 {
                --bs-gutter-y: 0.25rem;
            }
            .g-xxl-2,
            .gx-xxl-2 {
                --bs-gutter-x: 0.5rem;
            }
            .g-xxl-2,
            .gy-xxl-2 {
                --bs-gutter-y: 0.5rem;
            }
            .g-xxl-3,
            .gx-xxl-3 {
                --bs-gutter-x: 1rem;
            }
            .g-xxl-3,
            .gy-xxl-3 {
                --bs-gutter-y: 1rem;
            }
            .g-xxl-4,
            .gx-xxl-4 {
                --bs-gutter-x: 1.5rem;
            }
            .g-xxl-4,
            .gy-xxl-4 {
                --bs-gutter-y: 1.5rem;
            }
            .g-xxl-5,
            .gx-xxl-5 {
                --bs-gutter-x: 3rem;
            }
            .g-xxl-5,
            .gy-xxl-5 {
                --bs-gutter-y: 3rem;
            }
        }
        @media (min-width: 1750px) {
            .col-xxxl {
                flex: 1 0 0%;
            }
            .col-xxxl-1 {
                flex: 0 0 auto;
                width: 8.33333333%;
            }
            .col-xxxl-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-xxxl-2-5 {
                flex: 0 0 auto;
                width: 20.83333333%;
            }
            .col-xxxl-3 {
                flex: 0 0 auto;
                width: 25%;
            }
            .col-xxxl-3-5 {
                flex: 0 0 auto;
                width: 29.166666666%;
            }
            .col-xxxl-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-xxxl-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }
            .col-xxxl-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .col-xxxl-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }
            .col-xxxl-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }
            .col-xxxl-9 {
                flex: 0 0 auto;
                width: 75%;
            }
            .col-xxxl-10 {
                flex: 0 0 auto;
                width: 83.33333333%;
            }
            .col-xxxl-11 {
                flex: 0 0 auto;
                width: 91.66666667%;
            }
            .col-xxxl-12 {
                flex: 0 0 auto;
                width: 100%;
            }
        }
        .d-inline {
            display: inline !important;
        }

        .d-inline-block {
            display: inline-block !important;
        }

        .d-block {
            display: block !important;
        }

        .d-grid {
            display: grid !important;
        }

        .d-table {
            display: table !important;
        }

        .d-table-row {
            display: table-row !important;
        }

        .d-table-cell {
            display: table-cell !important;
        }

        .d-flex {
            display: flex !important;
        }

        .d-inline-flex {
            display: inline-flex !important;
        }

        .d-none {
            display: none !important;
        }

        .flex-fill {
            flex: 1 1 auto !important;
        }

        .flex-row {
            flex-direction: row !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .flex-row-reverse {
            flex-direction: row-reverse !important;
        }

        .flex-column-reverse {
            flex-direction: column-reverse !important;
        }

        .flex-grow-0 {
            flex-grow: 0 !important;
        }

        .flex-grow-1 {
            flex-grow: 1 !important;
        }

        .flex-shrink-0 {
            flex-shrink: 0 !important;
        }

        .flex-shrink-1 {
            flex-shrink: 1 !important;
        }

        .flex-wrap {
            flex-wrap: wrap !important;
        }

        .flex-nowrap {
            flex-wrap: nowrap !important;
        }

        .flex-wrap-reverse {
            flex-wrap: wrap-reverse !important;
        }

        .justify-content-start {
            justify-content: flex-start !important;
        }

        .justify-content-end {
            justify-content: flex-end !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .justify-content-around {
            justify-content: space-around !important;
        }

        .justify-content-evenly {
            justify-content: space-evenly !important;
        }

        .align-items-start {
            align-items: flex-start !important;
        }

        .align-items-end {
            align-items: flex-end !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .align-items-baseline {
            align-items: baseline !important;
        }

        .align-items-stretch {
            align-items: stretch !important;
        }

        .align-content-start {
            align-content: flex-start !important;
        }

        .align-content-end {
            align-content: flex-end !important;
        }

        .align-content-center {
            align-content: center !important;
        }

        .align-content-between {
            align-content: space-between !important;
        }

        .align-content-around {
            align-content: space-around !important;
        }

        .align-content-stretch {
            align-content: stretch !important;
        }

        .align-self-auto {
            align-self: auto !important;
        }

        .align-self-start {
            align-self: flex-start !important;
        }

        .align-self-end {
            align-self: flex-end !important;
        }

        .align-self-center {
            align-self: center !important;
        }

        .align-self-baseline {
            align-self: baseline !important;
        }

        .align-self-stretch {
            align-self: stretch !important;
        }

        .order-first {
            order: -1 !important;
        }

        .order-0 {
            order: 0 !important;
        }

        .order-1 {
            order: 1 !important;
        }

        .order-2 {
            order: 2 !important;
        }

        .order-3 {
            order: 3 !important;
        }

        .order-4 {
            order: 4 !important;
        }

        .order-5 {
            order: 5 !important;
        }

        .order-last {
            order: 6 !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .m-1 {
            margin: 0.25rem !important;
        }

        .m-2 {
            margin: 0.5rem !important;
        }

        .m-3 {
            margin: 1rem !important;
        }

        .m-4 {
            margin: 1.5rem !important;
        }

        .m-5 {
            margin: 3rem !important;
        }

        .m-auto {
            margin: auto !important;
        }

        .mx-0 {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }

        .mx-1 {
            margin-right: 0.25rem !important;
            margin-left: 0.25rem !important;
        }

        .mx-2 {
            margin-right: 0.5rem !important;
            margin-left: 0.5rem !important;
        }

        .mx-3 {
            margin-right: 1rem !important;
            margin-left: 1rem !important;
        }

        .mx-4 {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
        }

        .mx-5 {
            margin-right: 3rem !important;
            margin-left: 3rem !important;
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important;
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .my-1 {
            margin-top: 0.25rem !important;
            margin-bottom: 0.25rem !important;
        }

        .my-2 {
            margin-top: 0.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        .my-3 {
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .my-auto {
            margin-top: auto !important;
            margin-bottom: auto !important;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mt-1 {
            margin-top: 0.25rem !important;
        }

        .mt-2 {
            margin-top: 0.5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .mt-auto {
            margin-top: auto !important;
        }

        .me-0 {
            margin-right: 0 !important;
        }

        .me-1 {
            margin-right: 0.25rem !important;
        }

        .me-2 {
            margin-right: 0.5rem !important;
        }

        .me-3 {
            margin-right: 1rem !important;
        }

        .me-4 {
            margin-right: 1.5rem !important;
        }

        .me-5 {
            margin-right: 3rem !important;
        }

        .me-auto {
            margin-right: auto !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .mb-auto {
            margin-bottom: auto !important;
        }

        .ms-0 {
            margin-left: 0 !important;
        }

        .ms-1 {
            margin-left: 0.25rem !important;
        }

        .ms-2 {
            margin-left: 0.5rem !important;
        }

        .ms-3 {
            margin-left: 1rem !important;
        }

        .ms-4 {
            margin-left: 1.5rem !important;
        }

        .ms-5 {
            margin-left: 3rem !important;
        }

        .ms-auto {
            margin-left: auto !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .p-1 {
            padding: 0.25rem !important;
        }

        .p-2 {
            padding: 0.5rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .p-5 {
            padding: 3rem !important;
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .px-1 {
            padding-right: 0.25rem !important;
            padding-left: 0.25rem !important;
        }

        .px-2 {
            padding-right: 0.5rem !important;
            padding-left: 0.5rem !important;
        }

        .px-3 {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .px-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important;
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .py-1 {
            padding-top: 0.25rem !important;
            padding-bottom: 0.25rem !important;
        }

        .py-2 {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }

        .py-3 {
            padding-top: 1rem !important;
            padding-bottom: 1rem !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pt-1 {
            padding-top: 0.25rem !important;
        }

        .pt-2 {
            padding-top: 0.5rem !important;
        }

        .pt-3 {
            padding-top: 1rem !important;
        }

        .pt-4 {
            padding-top: 1.5rem !important;
        }

        .pt-5 {
            padding-top: 3rem !important;
        }

        .pe-0 {
            padding-right: 0 !important;
        }

        .pe-1 {
            padding-right: 0.25rem !important;
        }

        .pe-2 {
            padding-right: 0.5rem !important;
        }

        .pe-3 {
            padding-right: 1rem !important;
        }

        .pe-4 {
            padding-right: 1.5rem !important;
        }

        .pe-5 {
            padding-right: 3rem !important;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .pb-1 {
            padding-bottom: 0.25rem !important;
        }

        .pb-2 {
            padding-bottom: 0.5rem !important;
        }

        .pb-3 {
            padding-bottom: 1rem !important;
        }

        .pb-4 {
            padding-bottom: 1.5rem !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }

        .ps-0 {
            padding-left: 0 !important;
        }

        .ps-1 {
            padding-left: 0.25rem !important;
        }

        .ps-2 {
            padding-left: 0.5rem !important;
        }

        .ps-3 {
            padding-left: 1rem !important;
        }

        .ps-4 {
            padding-left: 1.5rem !important;
        }

        .ps-5 {
            padding-left: 3rem !important;
        }

        @media (min-width: 576px) {
            .d-sm-inline {
                display: inline !important;
            }
            .d-sm-inline-block {
                display: inline-block !important;
            }
            .d-sm-block {
                display: block !important;
            }
            .d-sm-grid {
                display: grid !important;
            }
            .d-sm-table {
                display: table !important;
            }
            .d-sm-table-row {
                display: table-row !important;
            }
            .d-sm-table-cell {
                display: table-cell !important;
            }
            .d-sm-flex {
                display: flex !important;
            }
            .d-sm-inline-flex {
                display: inline-flex !important;
            }
            .d-sm-none {
                display: none !important;
            }
            .flex-sm-fill {
                flex: 1 1 auto !important;
            }
            .flex-sm-row {
                flex-direction: row !important;
            }
            .flex-sm-column {
                flex-direction: column !important;
            }
            .flex-sm-row-reverse {
                flex-direction: row-reverse !important;
            }
            .flex-sm-column-reverse {
                flex-direction: column-reverse !important;
            }
            .flex-sm-grow-0 {
                flex-grow: 0 !important;
            }
            .flex-sm-grow-1 {
                flex-grow: 1 !important;
            }
            .flex-sm-shrink-0 {
                flex-shrink: 0 !important;
            }
            .flex-sm-shrink-1 {
                flex-shrink: 1 !important;
            }
            .flex-sm-wrap {
                flex-wrap: wrap !important;
            }
            .flex-sm-nowrap {
                flex-wrap: nowrap !important;
            }
            .flex-sm-wrap-reverse {
                flex-wrap: wrap-reverse !important;
            }
            .justify-content-sm-start {
                justify-content: flex-start !important;
            }
            .justify-content-sm-end {
                justify-content: flex-end !important;
            }
            .justify-content-sm-center {
                justify-content: center !important;
            }
            .justify-content-sm-between {
                justify-content: space-between !important;
            }
            .justify-content-sm-around {
                justify-content: space-around !important;
            }
            .justify-content-sm-evenly {
                justify-content: space-evenly !important;
            }
            .align-items-sm-start {
                align-items: flex-start !important;
            }
            .align-items-sm-end {
                align-items: flex-end !important;
            }
            .align-items-sm-center {
                align-items: center !important;
            }
            .align-items-sm-baseline {
                align-items: baseline !important;
            }
            .align-items-sm-stretch {
                align-items: stretch !important;
            }
            .align-content-sm-start {
                align-content: flex-start !important;
            }
            .align-content-sm-end {
                align-content: flex-end !important;
            }
            .align-content-sm-center {
                align-content: center !important;
            }
            .align-content-sm-between {
                align-content: space-between !important;
            }
            .align-content-sm-around {
                align-content: space-around !important;
            }
            .align-content-sm-stretch {
                align-content: stretch !important;
            }
            .align-self-sm-auto {
                align-self: auto !important;
            }
            .align-self-sm-start {
                align-self: flex-start !important;
            }
            .align-self-sm-end {
                align-self: flex-end !important;
            }
            .align-self-sm-center {
                align-self: center !important;
            }
            .align-self-sm-baseline {
                align-self: baseline !important;
            }
            .align-self-sm-stretch {
                align-self: stretch !important;
            }
            .order-sm-first {
                order: -1 !important;
            }
            .order-sm-0 {
                order: 0 !important;
            }
            .order-sm-1 {
                order: 1 !important;
            }
            .order-sm-2 {
                order: 2 !important;
            }
            .order-sm-3 {
                order: 3 !important;
            }
            .order-sm-4 {
                order: 4 !important;
            }
            .order-sm-5 {
                order: 5 !important;
            }
            .order-sm-last {
                order: 6 !important;
            }
            .m-sm-0 {
                margin: 0 !important;
            }
            .m-sm-1 {
                margin: 0.25rem !important;
            }
            .m-sm-2 {
                margin: 0.5rem !important;
            }
            .m-sm-3 {
                margin: 1rem !important;
            }
            .m-sm-4 {
                margin: 1.5rem !important;
            }
            .m-sm-5 {
                margin: 3rem !important;
            }
            .m-sm-auto {
                margin: auto !important;
            }
            .mx-sm-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-sm-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-sm-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-sm-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-sm-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-sm-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-sm-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-sm-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-sm-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-sm-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-sm-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-sm-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-sm-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-sm-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-sm-0 {
                margin-top: 0 !important;
            }
            .mt-sm-1 {
                margin-top: 0.25rem !important;
            }
            .mt-sm-2 {
                margin-top: 0.5rem !important;
            }
            .mt-sm-3 {
                margin-top: 1rem !important;
            }
            .mt-sm-4 {
                margin-top: 1.5rem !important;
            }
            .mt-sm-5 {
                margin-top: 3rem !important;
            }
            .mt-sm-auto {
                margin-top: auto !important;
            }
            .me-sm-0 {
                margin-right: 0 !important;
            }
            .me-sm-1 {
                margin-right: 0.25rem !important;
            }
            .me-sm-2 {
                margin-right: 0.5rem !important;
            }
            .me-sm-3 {
                margin-right: 1rem !important;
            }
            .me-sm-4 {
                margin-right: 1.5rem !important;
            }
            .me-sm-5 {
                margin-right: 3rem !important;
            }
            .me-sm-auto {
                margin-right: auto !important;
            }
            .mb-sm-0 {
                margin-bottom: 0 !important;
            }
            .mb-sm-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-sm-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-sm-3 {
                margin-bottom: 1rem !important;
            }
            .mb-sm-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-sm-5 {
                margin-bottom: 3rem !important;
            }
            .mb-sm-auto {
                margin-bottom: auto !important;
            }
            .ms-sm-0 {
                margin-left: 0 !important;
            }
            .ms-sm-1 {
                margin-left: 0.25rem !important;
            }
            .ms-sm-2 {
                margin-left: 0.5rem !important;
            }
            .ms-sm-3 {
                margin-left: 1rem !important;
            }
            .ms-sm-4 {
                margin-left: 1.5rem !important;
            }
            .ms-sm-5 {
                margin-left: 3rem !important;
            }
            .ms-sm-auto {
                margin-left: auto !important;
            }
            .p-sm-0 {
                padding: 0 !important;
            }
            .p-sm-1 {
                padding: 0.25rem !important;
            }
            .p-sm-2 {
                padding: 0.5rem !important;
            }
            .p-sm-3 {
                padding: 1rem !important;
            }
            .p-sm-4 {
                padding: 1.5rem !important;
            }
            .p-sm-5 {
                padding: 3rem !important;
            }
            .px-sm-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-sm-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-sm-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-sm-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-sm-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-sm-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-sm-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-sm-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-sm-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-sm-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-sm-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-sm-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-sm-0 {
                padding-top: 0 !important;
            }
            .pt-sm-1 {
                padding-top: 0.25rem !important;
            }
            .pt-sm-2 {
                padding-top: 0.5rem !important;
            }
            .pt-sm-3 {
                padding-top: 1rem !important;
            }
            .pt-sm-4 {
                padding-top: 1.5rem !important;
            }
            .pt-sm-5 {
                padding-top: 3rem !important;
            }
            .pe-sm-0 {
                padding-right: 0 !important;
            }
            .pe-sm-1 {
                padding-right: 0.25rem !important;
            }
            .pe-sm-2 {
                padding-right: 0.5rem !important;
            }
            .pe-sm-3 {
                padding-right: 1rem !important;
            }
            .pe-sm-4 {
                padding-right: 1.5rem !important;
            }
            .pe-sm-5 {
                padding-right: 3rem !important;
            }
            .pb-sm-0 {
                padding-bottom: 0 !important;
            }
            .pb-sm-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-sm-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-sm-3 {
                padding-bottom: 1rem !important;
            }
            .pb-sm-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-sm-5 {
                padding-bottom: 3rem !important;
            }
            .ps-sm-0 {
                padding-left: 0 !important;
            }
            .ps-sm-1 {
                padding-left: 0.25rem !important;
            }
            .ps-sm-2 {
                padding-left: 0.5rem !important;
            }
            .ps-sm-3 {
                padding-left: 1rem !important;
            }
            .ps-sm-4 {
                padding-left: 1.5rem !important;
            }
            .ps-sm-5 {
                padding-left: 3rem !important;
            }
        }
        @media (min-width: 768px) {
            .d-md-inline {
                display: inline !important;
            }
            .d-md-inline-block {
                display: inline-block !important;
            }
            .d-md-block {
                display: block !important;
            }
            .d-md-grid {
                display: grid !important;
            }
            .d-md-table {
                display: table !important;
            }
            .d-md-table-row {
                display: table-row !important;
            }
            .d-md-table-cell {
                display: table-cell !important;
            }
            .d-md-flex {
                display: flex !important;
            }
            .d-md-inline-flex {
                display: inline-flex !important;
            }
            .d-md-none {
                display: none !important;
            }
            .flex-md-fill {
                flex: 1 1 auto !important;
            }
            .flex-md-row {
                flex-direction: row !important;
            }
            .flex-md-column {
                flex-direction: column !important;
            }
            .flex-md-row-reverse {
                flex-direction: row-reverse !important;
            }
            .flex-md-column-reverse {
                flex-direction: column-reverse !important;
            }
            .flex-md-grow-0 {
                flex-grow: 0 !important;
            }
            .flex-md-grow-1 {
                flex-grow: 1 !important;
            }
            .flex-md-shrink-0 {
                flex-shrink: 0 !important;
            }
            .flex-md-shrink-1 {
                flex-shrink: 1 !important;
            }
            .flex-md-wrap {
                flex-wrap: wrap !important;
            }
            .flex-md-nowrap {
                flex-wrap: nowrap !important;
            }
            .flex-md-wrap-reverse {
                flex-wrap: wrap-reverse !important;
            }
            .justify-content-md-start {
                justify-content: flex-start !important;
            }
            .justify-content-md-end {
                justify-content: flex-end !important;
            }
            .justify-content-md-center {
                justify-content: center !important;
            }
            .justify-content-md-between {
                justify-content: space-between !important;
            }
            .justify-content-md-around {
                justify-content: space-around !important;
            }
            .justify-content-md-evenly {
                justify-content: space-evenly !important;
            }
            .align-items-md-start {
                align-items: flex-start !important;
            }
            .align-items-md-end {
                align-items: flex-end !important;
            }
            .align-items-md-center {
                align-items: center !important;
            }
            .align-items-md-baseline {
                align-items: baseline !important;
            }
            .align-items-md-stretch {
                align-items: stretch !important;
            }
            .align-content-md-start {
                align-content: flex-start !important;
            }
            .align-content-md-end {
                align-content: flex-end !important;
            }
            .align-content-md-center {
                align-content: center !important;
            }
            .align-content-md-between {
                align-content: space-between !important;
            }
            .align-content-md-around {
                align-content: space-around !important;
            }
            .align-content-md-stretch {
                align-content: stretch !important;
            }
            .align-self-md-auto {
                align-self: auto !important;
            }
            .align-self-md-start {
                align-self: flex-start !important;
            }
            .align-self-md-end {
                align-self: flex-end !important;
            }
            .align-self-md-center {
                align-self: center !important;
            }
            .align-self-md-baseline {
                align-self: baseline !important;
            }
            .align-self-md-stretch {
                align-self: stretch !important;
            }
            .order-md-first {
                order: -1 !important;
            }
            .order-md-0 {
                order: 0 !important;
            }
            .order-md-1 {
                order: 1 !important;
            }
            .order-md-2 {
                order: 2 !important;
            }
            .order-md-3 {
                order: 3 !important;
            }
            .order-md-4 {
                order: 4 !important;
            }
            .order-md-5 {
                order: 5 !important;
            }
            .order-md-last {
                order: 6 !important;
            }
            .m-md-0 {
                margin: 0 !important;
            }
            .m-md-1 {
                margin: 0.25rem !important;
            }
            .m-md-2 {
                margin: 0.5rem !important;
            }
            .m-md-3 {
                margin: 1rem !important;
            }
            .m-md-4 {
                margin: 1.5rem !important;
            }
            .m-md-5 {
                margin: 3rem !important;
            }
            .m-md-auto {
                margin: auto !important;
            }
            .mx-md-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-md-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-md-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-md-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-md-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-md-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-md-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-md-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-md-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-md-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-md-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-md-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-md-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-md-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-md-0 {
                margin-top: 0 !important;
            }
            .mt-md-1 {
                margin-top: 0.25rem !important;
            }
            .mt-md-2 {
                margin-top: 0.5rem !important;
            }
            .mt-md-3 {
                margin-top: 1rem !important;
            }
            .mt-md-4 {
                margin-top: 1.5rem !important;
            }
            .mt-md-5 {
                margin-top: 3rem !important;
            }
            .mt-md-auto {
                margin-top: auto !important;
            }
            .me-md-0 {
                margin-right: 0 !important;
            }
            .me-md-1 {
                margin-right: 0.25rem !important;
            }
            .me-md-2 {
                margin-right: 0.5rem !important;
            }
            .me-md-3 {
                margin-right: 1rem !important;
            }
            .me-md-4 {
                margin-right: 1.5rem !important;
            }
            .me-md-5 {
                margin-right: 3rem !important;
            }
            .me-md-auto {
                margin-right: auto !important;
            }
            .mb-md-0 {
                margin-bottom: 0 !important;
            }
            .mb-md-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-md-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-md-3 {
                margin-bottom: 1rem !important;
            }
            .mb-md-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-md-5 {
                margin-bottom: 3rem !important;
            }
            .mb-md-auto {
                margin-bottom: auto !important;
            }
            .ms-md-0 {
                margin-left: 0 !important;
            }
            .ms-md-1 {
                margin-left: 0.25rem !important;
            }
            .ms-md-2 {
                margin-left: 0.5rem !important;
            }
            .ms-md-3 {
                margin-left: 1rem !important;
            }
            .ms-md-4 {
                margin-left: 1.5rem !important;
            }
            .ms-md-5 {
                margin-left: 3rem !important;
            }
            .ms-md-auto {
                margin-left: auto !important;
            }
            .p-md-0 {
                padding: 0 !important;
            }
            .p-md-1 {
                padding: 0.25rem !important;
            }
            .p-md-2 {
                padding: 0.5rem !important;
            }
            .p-md-3 {
                padding: 1rem !important;
            }
            .p-md-4 {
                padding: 1.5rem !important;
            }
            .p-md-5 {
                padding: 3rem !important;
            }
            .px-md-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-md-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-md-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-md-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-md-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-md-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-md-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-md-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-md-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-md-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-md-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-md-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-md-0 {
                padding-top: 0 !important;
            }
            .pt-md-1 {
                padding-top: 0.25rem !important;
            }
            .pt-md-2 {
                padding-top: 0.5rem !important;
            }
            .pt-md-3 {
                padding-top: 1rem !important;
            }
            .pt-md-4 {
                padding-top: 1.5rem !important;
            }
            .pt-md-5 {
                padding-top: 3rem !important;
            }
            .pe-md-0 {
                padding-right: 0 !important;
            }
            .pe-md-1 {
                padding-right: 0.25rem !important;
            }
            .pe-md-2 {
                padding-right: 0.5rem !important;
            }
            .pe-md-3 {
                padding-right: 1rem !important;
            }
            .pe-md-4 {
                padding-right: 1.5rem !important;
            }
            .pe-md-5 {
                padding-right: 3rem !important;
            }
            .pb-md-0 {
                padding-bottom: 0 !important;
            }
            .pb-md-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-md-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-md-3 {
                padding-bottom: 1rem !important;
            }
            .pb-md-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-md-5 {
                padding-bottom: 3rem !important;
            }
            .ps-md-0 {
                padding-left: 0 !important;
            }
            .ps-md-1 {
                padding-left: 0.25rem !important;
            }
            .ps-md-2 {
                padding-left: 0.5rem !important;
            }
            .ps-md-3 {
                padding-left: 1rem !important;
            }
            .ps-md-4 {
                padding-left: 1.5rem !important;
            }
            .ps-md-5 {
                padding-left: 3rem !important;
            }
        }
        @media (min-width: 992px) {
            .d-lg-inline {
                display: inline !important;
            }
            .d-lg-inline-block {
                display: inline-block !important;
            }
            .d-lg-block {
                display: block !important;
            }
            .d-lg-grid {
                display: grid !important;
            }
            .d-lg-table {
                display: table !important;
            }
            .d-lg-table-row {
                display: table-row !important;
            }
            .d-lg-table-cell {
                display: table-cell !important;
            }
            .d-lg-flex {
                display: flex !important;
            }
            .d-lg-inline-flex {
                display: inline-flex !important;
            }
            .d-lg-none {
                display: none !important;
            }
            .flex-lg-fill {
                flex: 1 1 auto !important;
            }
            .flex-lg-row {
                flex-direction: row !important;
            }
            .flex-lg-column {
                flex-direction: column !important;
            }
            .flex-lg-row-reverse {
                flex-direction: row-reverse !important;
            }
            .flex-lg-column-reverse {
                flex-direction: column-reverse !important;
            }
            .flex-lg-grow-0 {
                flex-grow: 0 !important;
            }
            .flex-lg-grow-1 {
                flex-grow: 1 !important;
            }
            .flex-lg-shrink-0 {
                flex-shrink: 0 !important;
            }
            .flex-lg-shrink-1 {
                flex-shrink: 1 !important;
            }
            .flex-lg-wrap {
                flex-wrap: wrap !important;
            }
            .flex-lg-nowrap {
                flex-wrap: nowrap !important;
            }
            .flex-lg-wrap-reverse {
                flex-wrap: wrap-reverse !important;
            }
            .justify-content-lg-start {
                justify-content: flex-start !important;
            }
            .justify-content-lg-end {
                justify-content: flex-end !important;
            }
            .justify-content-lg-center {
                justify-content: center !important;
            }
            .justify-content-lg-between {
                justify-content: space-between !important;
            }
            .justify-content-lg-around {
                justify-content: space-around !important;
            }
            .justify-content-lg-evenly {
                justify-content: space-evenly !important;
            }
            .align-items-lg-start {
                align-items: flex-start !important;
            }
            .align-items-lg-end {
                align-items: flex-end !important;
            }
            .align-items-lg-center {
                align-items: center !important;
            }
            .align-items-lg-baseline {
                align-items: baseline !important;
            }
            .align-items-lg-stretch {
                align-items: stretch !important;
            }
            .align-content-lg-start {
                align-content: flex-start !important;
            }
            .align-content-lg-end {
                align-content: flex-end !important;
            }
            .align-content-lg-center {
                align-content: center !important;
            }
            .align-content-lg-between {
                align-content: space-between !important;
            }
            .align-content-lg-around {
                align-content: space-around !important;
            }
            .align-content-lg-stretch {
                align-content: stretch !important;
            }
            .align-self-lg-auto {
                align-self: auto !important;
            }
            .align-self-lg-start {
                align-self: flex-start !important;
            }
            .align-self-lg-end {
                align-self: flex-end !important;
            }
            .align-self-lg-center {
                align-self: center !important;
            }
            .align-self-lg-baseline {
                align-self: baseline !important;
            }
            .align-self-lg-stretch {
                align-self: stretch !important;
            }
            .order-lg-first {
                order: -1 !important;
            }
            .order-lg-0 {
                order: 0 !important;
            }
            .order-lg-1 {
                order: 1 !important;
            }
            .order-lg-2 {
                order: 2 !important;
            }
            .order-lg-3 {
                order: 3 !important;
            }
            .order-lg-4 {
                order: 4 !important;
            }
            .order-lg-5 {
                order: 5 !important;
            }
            .order-lg-last {
                order: 6 !important;
            }
            .m-lg-0 {
                margin: 0 !important;
            }
            .m-lg-1 {
                margin: 0.25rem !important;
            }
            .m-lg-2 {
                margin: 0.5rem !important;
            }
            .m-lg-3 {
                margin: 1rem !important;
            }
            .m-lg-4 {
                margin: 1.5rem !important;
            }
            .m-lg-5 {
                margin: 3rem !important;
            }
            .m-lg-auto {
                margin: auto !important;
            }
            .mx-lg-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-lg-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-lg-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-lg-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-lg-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-lg-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-lg-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-lg-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-lg-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-lg-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-lg-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-lg-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-lg-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-lg-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-lg-0 {
                margin-top: 0 !important;
            }
            .mt-lg-1 {
                margin-top: 0.25rem !important;
            }
            .mt-lg-2 {
                margin-top: 0.5rem !important;
            }
            .mt-lg-3 {
                margin-top: 1rem !important;
            }
            .mt-lg-4 {
                margin-top: 1.5rem !important;
            }
            .mt-lg-5 {
                margin-top: 3rem !important;
            }
            .mt-lg-auto {
                margin-top: auto !important;
            }
            .me-lg-0 {
                margin-right: 0 !important;
            }
            .me-lg-1 {
                margin-right: 0.25rem !important;
            }
            .me-lg-2 {
                margin-right: 0.5rem !important;
            }
            .me-lg-3 {
                margin-right: 1rem !important;
            }
            .me-lg-4 {
                margin-right: 1.5rem !important;
            }
            .me-lg-5 {
                margin-right: 3rem !important;
            }
            .me-lg-auto {
                margin-right: auto !important;
            }
            .mb-lg-0 {
                margin-bottom: 0 !important;
            }
            .mb-lg-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-lg-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-lg-3 {
                margin-bottom: 1rem !important;
            }
            .mb-lg-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-lg-5 {
                margin-bottom: 3rem !important;
            }
            .mb-lg-auto {
                margin-bottom: auto !important;
            }
            .ms-lg-0 {
                margin-left: 0 !important;
            }
            .ms-lg-1 {
                margin-left: 0.25rem !important;
            }
            .ms-lg-2 {
                margin-left: 0.5rem !important;
            }
            .ms-lg-3 {
                margin-left: 1rem !important;
            }
            .ms-lg-4 {
                margin-left: 1.5rem !important;
            }
            .ms-lg-5 {
                margin-left: 3rem !important;
            }
            .ms-lg-auto {
                margin-left: auto !important;
            }
            .p-lg-0 {
                padding: 0 !important;
            }
            .p-lg-1 {
                padding: 0.25rem !important;
            }
            .p-lg-2 {
                padding: 0.5rem !important;
            }
            .p-lg-3 {
                padding: 1rem !important;
            }
            .p-lg-4 {
                padding: 1.5rem !important;
            }
            .p-lg-5 {
                padding: 3rem !important;
            }
            .px-lg-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-lg-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-lg-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-lg-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-lg-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-lg-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-lg-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-lg-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-lg-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-lg-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-lg-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-lg-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-lg-0 {
                padding-top: 0 !important;
            }
            .pt-lg-1 {
                padding-top: 0.25rem !important;
            }
            .pt-lg-2 {
                padding-top: 0.5rem !important;
            }
            .pt-lg-3 {
                padding-top: 1rem !important;
            }
            .pt-lg-4 {
                padding-top: 1.5rem !important;
            }
            .pt-lg-5 {
                padding-top: 3rem !important;
            }
            .pe-lg-0 {
                padding-right: 0 !important;
            }
            .pe-lg-1 {
                padding-right: 0.25rem !important;
            }
            .pe-lg-2 {
                padding-right: 0.5rem !important;
            }
            .pe-lg-3 {
                padding-right: 1rem !important;
            }
            .pe-lg-4 {
                padding-right: 1.5rem !important;
            }
            .pe-lg-5 {
                padding-right: 3rem !important;
            }
            .pb-lg-0 {
                padding-bottom: 0 !important;
            }
            .pb-lg-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-lg-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-lg-3 {
                padding-bottom: 1rem !important;
            }
            .pb-lg-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-lg-5 {
                padding-bottom: 3rem !important;
            }
            .ps-lg-0 {
                padding-left: 0 !important;
            }
            .ps-lg-1 {
                padding-left: 0.25rem !important;
            }
            .ps-lg-2 {
                padding-left: 0.5rem !important;
            }
            .ps-lg-3 {
                padding-left: 1rem !important;
            }
            .ps-lg-4 {
                padding-left: 1.5rem !important;
            }
            .ps-lg-5 {
                padding-left: 3rem !important;
            }
        }
        @media (min-width: 1200px) {
            .d-xl-inline {
                display: inline !important;
            }
            .d-xl-inline-block {
                display: inline-block !important;
            }
            .d-xl-block {
                display: block !important;
            }
            .d-xl-grid {
                display: grid !important;
            }
            .d-xl-table {
                display: table !important;
            }
            .d-xl-table-row {
                display: table-row !important;
            }
            .d-xl-table-cell {
                display: table-cell !important;
            }
            .d-xl-flex {
                display: flex !important;
            }
            .d-xl-inline-flex {
                display: inline-flex !important;
            }
            .d-xl-none {
                display: none !important;
            }
            .flex-xl-fill {
                flex: 1 1 auto !important;
            }
            .flex-xl-row {
                flex-direction: row !important;
            }
            .flex-xl-column {
                flex-direction: column !important;
            }
            .flex-xl-row-reverse {
                flex-direction: row-reverse !important;
            }
            .flex-xl-column-reverse {
                flex-direction: column-reverse !important;
            }
            .flex-xl-grow-0 {
                flex-grow: 0 !important;
            }
            .flex-xl-grow-1 {
                flex-grow: 1 !important;
            }
            .flex-xl-shrink-0 {
                flex-shrink: 0 !important;
            }
            .flex-xl-shrink-1 {
                flex-shrink: 1 !important;
            }
            .flex-xl-wrap {
                flex-wrap: wrap !important;
            }
            .flex-xl-nowrap {
                flex-wrap: nowrap !important;
            }
            .flex-xl-wrap-reverse {
                flex-wrap: wrap-reverse !important;
            }
            .justify-content-xl-start {
                justify-content: flex-start !important;
            }
            .justify-content-xl-end {
                justify-content: flex-end !important;
            }
            .justify-content-xl-center {
                justify-content: center !important;
            }
            .justify-content-xl-between {
                justify-content: space-between !important;
            }
            .justify-content-xl-around {
                justify-content: space-around !important;
            }
            .justify-content-xl-evenly {
                justify-content: space-evenly !important;
            }
            .align-items-xl-start {
                align-items: flex-start !important;
            }
            .align-items-xl-end {
                align-items: flex-end !important;
            }
            .align-items-xl-center {
                align-items: center !important;
            }
            .align-items-xl-baseline {
                align-items: baseline !important;
            }
            .align-items-xl-stretch {
                align-items: stretch !important;
            }
            .align-content-xl-start {
                align-content: flex-start !important;
            }
            .align-content-xl-end {
                align-content: flex-end !important;
            }
            .align-content-xl-center {
                align-content: center !important;
            }
            .align-content-xl-between {
                align-content: space-between !important;
            }
            .align-content-xl-around {
                align-content: space-around !important;
            }
            .align-content-xl-stretch {
                align-content: stretch !important;
            }
            .align-self-xl-auto {
                align-self: auto !important;
            }
            .align-self-xl-start {
                align-self: flex-start !important;
            }
            .align-self-xl-end {
                align-self: flex-end !important;
            }
            .align-self-xl-center {
                align-self: center !important;
            }
            .align-self-xl-baseline {
                align-self: baseline !important;
            }
            .align-self-xl-stretch {
                align-self: stretch !important;
            }
            .order-xl-first {
                order: -1 !important;
            }
            .order-xl-0 {
                order: 0 !important;
            }
            .order-xl-1 {
                order: 1 !important;
            }
            .order-xl-2 {
                order: 2 !important;
            }
            .order-xl-3 {
                order: 3 !important;
            }
            .order-xl-4 {
                order: 4 !important;
            }
            .order-xl-5 {
                order: 5 !important;
            }
            .order-xl-last {
                order: 6 !important;
            }
            .m-xl-0 {
                margin: 0 !important;
            }
            .m-xl-1 {
                margin: 0.25rem !important;
            }
            .m-xl-2 {
                margin: 0.5rem !important;
            }
            .m-xl-3 {
                margin: 1rem !important;
            }
            .m-xl-4 {
                margin: 1.5rem !important;
            }
            .m-xl-5 {
                margin: 3rem !important;
            }
            .m-xl-auto {
                margin: auto !important;
            }
            .mx-xl-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-xl-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-xl-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-xl-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-xl-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-xl-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-xl-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-xl-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-xl-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-xl-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-xl-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-xl-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-xl-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-xl-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-xl-0 {
                margin-top: 0 !important;
            }
            .mt-xl-1 {
                margin-top: 0.25rem !important;
            }
            .mt-xl-2 {
                margin-top: 0.5rem !important;
            }
            .mt-xl-3 {
                margin-top: 1rem !important;
            }
            .mt-xl-4 {
                margin-top: 1.5rem !important;
            }
            .mt-xl-5 {
                margin-top: 3rem !important;
            }
            .mt-xl-auto {
                margin-top: auto !important;
            }
            .me-xl-0 {
                margin-right: 0 !important;
            }
            .me-xl-1 {
                margin-right: 0.25rem !important;
            }
            .me-xl-2 {
                margin-right: 0.5rem !important;
            }
            .me-xl-3 {
                margin-right: 1rem !important;
            }
            .me-xl-4 {
                margin-right: 1.5rem !important;
            }
            .me-xl-5 {
                margin-right: 3rem !important;
            }
            .me-xl-auto {
                margin-right: auto !important;
            }
            .mb-xl-0 {
                margin-bottom: 0 !important;
            }
            .mb-xl-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-xl-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-xl-3 {
                margin-bottom: 1rem !important;
            }
            .mb-xl-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-xl-5 {
                margin-bottom: 3rem !important;
            }
            .mb-xl-auto {
                margin-bottom: auto !important;
            }
            .ms-xl-0 {
                margin-left: 0 !important;
            }
            .ms-xl-1 {
                margin-left: 0.25rem !important;
            }
            .ms-xl-2 {
                margin-left: 0.5rem !important;
            }
            .ms-xl-3 {
                margin-left: 1rem !important;
            }
            .ms-xl-4 {
                margin-left: 1.5rem !important;
            }
            .ms-xl-5 {
                margin-left: 3rem !important;
            }
            .ms-xl-auto {
                margin-left: auto !important;
            }
            .p-xl-0 {
                padding: 0 !important;
            }
            .p-xl-1 {
                padding: 0.25rem !important;
            }
            .p-xl-2 {
                padding: 0.5rem !important;
            }
            .p-xl-3 {
                padding: 1rem !important;
            }
            .p-xl-4 {
                padding: 1.5rem !important;
            }
            .p-xl-5 {
                padding: 3rem !important;
            }
            .px-xl-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-xl-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-xl-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-xl-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-xl-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-xl-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-xl-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-xl-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-xl-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-xl-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-xl-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-xl-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-xl-0 {
                padding-top: 0 !important;
            }
            .pt-xl-1 {
                padding-top: 0.25rem !important;
            }
            .pt-xl-2 {
                padding-top: 0.5rem !important;
            }
            .pt-xl-3 {
                padding-top: 1rem !important;
            }
            .pt-xl-4 {
                padding-top: 1.5rem !important;
            }
            .pt-xl-5 {
                padding-top: 3rem !important;
            }
            .pe-xl-0 {
                padding-right: 0 !important;
            }
            .pe-xl-1 {
                padding-right: 0.25rem !important;
            }
            .pe-xl-2 {
                padding-right: 0.5rem !important;
            }
            .pe-xl-3 {
                padding-right: 1rem !important;
            }
            .pe-xl-4 {
                padding-right: 1.5rem !important;
            }
            .pe-xl-5 {
                padding-right: 3rem !important;
            }
            .pb-xl-0 {
                padding-bottom: 0 !important;
            }
            .pb-xl-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-xl-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-xl-3 {
                padding-bottom: 1rem !important;
            }
            .pb-xl-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-xl-5 {
                padding-bottom: 3rem !important;
            }
            .ps-xl-0 {
                padding-left: 0 !important;
            }
            .ps-xl-1 {
                padding-left: 0.25rem !important;
            }
            .ps-xl-2 {
                padding-left: 0.5rem !important;
            }
            .ps-xl-3 {
                padding-left: 1rem !important;
            }
            .ps-xl-4 {
                padding-left: 1.5rem !important;
            }
            .ps-xl-5 {
                padding-left: 3rem !important;
            }
        }
        @media (min-width: 1400px) {
            .d-xxl-inline {
                display: inline !important;
            }
            .d-xxl-inline-block {
                display: inline-block !important;
            }
            .d-xxl-block {
                display: block !important;
            }
            .d-xxl-grid {
                display: grid !important;
            }
            .d-xxl-table {
                display: table !important;
            }
            .d-xxl-table-row {
                display: table-row !important;
            }
            .d-xxl-table-cell {
                display: table-cell !important;
            }
            .d-xxl-flex {
                display: flex !important;
            }
            .d-xxl-inline-flex {
                display: inline-flex !important;
            }
            .d-xxl-none {
                display: none !important;
            }
            .flex-xxl-fill {
                flex: 1 1 auto !important;
            }
            .flex-xxl-row {
                flex-direction: row !important;
            }
            .flex-xxl-column {
                flex-direction: column !important;
            }
            .flex-xxl-row-reverse {
                flex-direction: row-reverse !important;
            }
            .flex-xxl-column-reverse {
                flex-direction: column-reverse !important;
            }
            .flex-xxl-grow-0 {
                flex-grow: 0 !important;
            }
            .flex-xxl-grow-1 {
                flex-grow: 1 !important;
            }
            .flex-xxl-shrink-0 {
                flex-shrink: 0 !important;
            }
            .flex-xxl-shrink-1 {
                flex-shrink: 1 !important;
            }
            .flex-xxl-wrap {
                flex-wrap: wrap !important;
            }
            .flex-xxl-nowrap {
                flex-wrap: nowrap !important;
            }
            .flex-xxl-wrap-reverse {
                flex-wrap: wrap-reverse !important;
            }
            .justify-content-xxl-start {
                justify-content: flex-start !important;
            }
            .justify-content-xxl-end {
                justify-content: flex-end !important;
            }
            .justify-content-xxl-center {
                justify-content: center !important;
            }
            .justify-content-xxl-between {
                justify-content: space-between !important;
            }
            .justify-content-xxl-around {
                justify-content: space-around !important;
            }
            .justify-content-xxl-evenly {
                justify-content: space-evenly !important;
            }
            .align-items-xxl-start {
                align-items: flex-start !important;
            }
            .align-items-xxl-end {
                align-items: flex-end !important;
            }
            .align-items-xxl-center {
                align-items: center !important;
            }
            .align-items-xxl-baseline {
                align-items: baseline !important;
            }
            .align-items-xxl-stretch {
                align-items: stretch !important;
            }
            .align-content-xxl-start {
                align-content: flex-start !important;
            }
            .align-content-xxl-end {
                align-content: flex-end !important;
            }
            .align-content-xxl-center {
                align-content: center !important;
            }
            .align-content-xxl-between {
                align-content: space-between !important;
            }
            .align-content-xxl-around {
                align-content: space-around !important;
            }
            .align-content-xxl-stretch {
                align-content: stretch !important;
            }
            .align-self-xxl-auto {
                align-self: auto !important;
            }
            .align-self-xxl-start {
                align-self: flex-start !important;
            }
            .align-self-xxl-end {
                align-self: flex-end !important;
            }
            .align-self-xxl-center {
                align-self: center !important;
            }
            .align-self-xxl-baseline {
                align-self: baseline !important;
            }
            .align-self-xxl-stretch {
                align-self: stretch !important;
            }
            .order-xxl-first {
                order: -1 !important;
            }
            .order-xxl-0 {
                order: 0 !important;
            }
            .order-xxl-1 {
                order: 1 !important;
            }
            .order-xxl-2 {
                order: 2 !important;
            }
            .order-xxl-3 {
                order: 3 !important;
            }
            .order-xxl-4 {
                order: 4 !important;
            }
            .order-xxl-5 {
                order: 5 !important;
            }
            .order-xxl-last {
                order: 6 !important;
            }
            .m-xxl-0 {
                margin: 0 !important;
            }
            .m-xxl-1 {
                margin: 0.25rem !important;
            }
            .m-xxl-2 {
                margin: 0.5rem !important;
            }
            .m-xxl-3 {
                margin: 1rem !important;
            }
            .m-xxl-4 {
                margin: 1.5rem !important;
            }
            .m-xxl-5 {
                margin: 3rem !important;
            }
            .m-xxl-auto {
                margin: auto !important;
            }
            .mx-xxl-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-xxl-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-xxl-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-xxl-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-xxl-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-xxl-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-xxl-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-xxl-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-xxl-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-xxl-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-xxl-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-xxl-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-xxl-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-xxl-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-xxl-0 {
                margin-top: 0 !important;
            }
            .mt-xxl-1 {
                margin-top: 0.25rem !important;
            }
            .mt-xxl-2 {
                margin-top: 0.5rem !important;
            }
            .mt-xxl-3 {
                margin-top: 1rem !important;
            }
            .mt-xxl-4 {
                margin-top: 1.5rem !important;
            }
            .mt-xxl-5 {
                margin-top: 3rem !important;
            }
            .mt-xxl-auto {
                margin-top: auto !important;
            }
            .me-xxl-0 {
                margin-right: 0 !important;
            }
            .me-xxl-1 {
                margin-right: 0.25rem !important;
            }
            .me-xxl-2 {
                margin-right: 0.5rem !important;
            }
            .me-xxl-3 {
                margin-right: 1rem !important;
            }
            .me-xxl-4 {
                margin-right: 1.5rem !important;
            }
            .me-xxl-5 {
                margin-right: 3rem !important;
            }
            .me-xxl-auto {
                margin-right: auto !important;
            }
            .mb-xxl-0 {
                margin-bottom: 0 !important;
            }
            .mb-xxl-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-xxl-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-xxl-3 {
                margin-bottom: 1rem !important;
            }
            .mb-xxl-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-xxl-5 {
                margin-bottom: 3rem !important;
            }
            .mb-xxl-auto {
                margin-bottom: auto !important;
            }
            .ms-xxl-0 {
                margin-left: 0 !important;
            }
            .ms-xxl-1 {
                margin-left: 0.25rem !important;
            }
            .ms-xxl-2 {
                margin-left: 0.5rem !important;
            }
            .ms-xxl-3 {
                margin-left: 1rem !important;
            }
            .ms-xxl-4 {
                margin-left: 1.5rem !important;
            }
            .ms-xxl-5 {
                margin-left: 3rem !important;
            }
            .ms-xxl-auto {
                margin-left: auto !important;
            }
            .p-xxl-0 {
                padding: 0 !important;
            }
            .p-xxl-1 {
                padding: 0.25rem !important;
            }
            .p-xxl-2 {
                padding: 0.5rem !important;
            }
            .p-xxl-3 {
                padding: 1rem !important;
            }
            .p-xxl-4 {
                padding: 1.5rem !important;
            }
            .p-xxl-5 {
                padding: 3rem !important;
            }
            .px-xxl-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-xxl-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-xxl-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-xxl-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-xxl-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-xxl-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-xxl-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-xxl-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-xxl-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-xxl-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-xxl-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-xxl-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-xxl-0 {
                padding-top: 0 !important;
            }
            .pt-xxl-1 {
                padding-top: 0.25rem !important;
            }
            .pt-xxl-2 {
                padding-top: 0.5rem !important;
            }
            .pt-xxl-3 {
                padding-top: 1rem !important;
            }
            .pt-xxl-4 {
                padding-top: 1.5rem !important;
            }
            .pt-xxl-5 {
                padding-top: 3rem !important;
            }
            .pe-xxl-0 {
                padding-right: 0 !important;
            }
            .pe-xxl-1 {
                padding-right: 0.25rem !important;
            }
            .pe-xxl-2 {
                padding-right: 0.5rem !important;
            }
            .pe-xxl-3 {
                padding-right: 1rem !important;
            }
            .pe-xxl-4 {
                padding-right: 1.5rem !important;
            }
            .pe-xxl-5 {
                padding-right: 3rem !important;
            }
            .pb-xxl-0 {
                padding-bottom: 0 !important;
            }
            .pb-xxl-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-xxl-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-xxl-3 {
                padding-bottom: 1rem !important;
            }
            .pb-xxl-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-xxl-5 {
                padding-bottom: 3rem !important;
            }
            .ps-xxl-0 {
                padding-left: 0 !important;
            }
            .ps-xxl-1 {
                padding-left: 0.25rem !important;
            }
            .ps-xxl-2 {
                padding-left: 0.5rem !important;
            }
            .ps-xxl-3 {
                padding-left: 1rem !important;
            }
            .ps-xxl-4 {
                padding-left: 1.5rem !important;
            }
            .ps-xxl-5 {
                padding-left: 3rem !important;
            }
        }
        @media (min-width: 1750px) {
            .m-xxxl-0 {
                margin: 0 !important;
            }
            .m-xxxl-1 {
                margin: 0.25rem !important;
            }
            .m-xxxl-2 {
                margin: 0.5rem !important;
            }
            .m-xxxl-3 {
                margin: 1rem !important;
            }
            .m-xxxl-4 {
                margin: 1.5rem !important;
            }
            .m-xxxl-5 {
                margin: 3rem !important;
            }
            .m-xxxl-auto {
                margin: auto !important;
            }
            .mx-xxxl-0 {
                margin-right: 0 !important;
                margin-left: 0 !important;
            }
            .mx-xxxl-1 {
                margin-right: 0.25rem !important;
                margin-left: 0.25rem !important;
            }
            .mx-xxxl-2 {
                margin-right: 0.5rem !important;
                margin-left: 0.5rem !important;
            }
            .mx-xxxl-3 {
                margin-right: 1rem !important;
                margin-left: 1rem !important;
            }
            .mx-xxxl-4 {
                margin-right: 1.5rem !important;
                margin-left: 1.5rem !important;
            }
            .mx-xxxl-5 {
                margin-right: 3rem !important;
                margin-left: 3rem !important;
            }
            .mx-xxxl-auto {
                margin-right: auto !important;
                margin-left: auto !important;
            }
            .my-xxxl-0 {
                margin-top: 0 !important;
                margin-bottom: 0 !important;
            }
            .my-xxxl-1 {
                margin-top: 0.25rem !important;
                margin-bottom: 0.25rem !important;
            }
            .my-xxxl-2 {
                margin-top: 0.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            .my-xxxxl-3 {
                margin-top: 1rem !important;
                margin-bottom: 1rem !important;
            }
            .my-xxxl-4 {
                margin-top: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            .my-xxxl-5 {
                margin-top: 3rem !important;
                margin-bottom: 3rem !important;
            }
            .my-xxxl-auto {
                margin-top: auto !important;
                margin-bottom: auto !important;
            }
            .mt-xxxl-0 {
                margin-top: 0 !important;
            }
            .mt-xxxl-1 {
                margin-top: 0.25rem !important;
            }
            .mt-xxxl-2 {
                margin-top: 0.5rem !important;
            }
            .mt-xxxl-3 {
                margin-top: 1rem !important;
            }
            .mt-xxxl-4 {
                margin-top: 1.5rem !important;
            }
            .mt-xxxl-5 {
                margin-top: 3rem !important;
            }
            .mt-xxxl-auto {
                margin-top: auto !important;
            }
            .me-xxxl-0 {
                margin-right: 0 !important;
            }
            .me-xxxl-1 {
                margin-right: 0.25rem !important;
            }
            .me-xxxl-2 {
                margin-right: 0.5rem !important;
            }
            .me-xxxl-3 {
                margin-right: 1rem !important;
            }
            .me-xxxl-4 {
                margin-right: 1.5rem !important;
            }
            .me-xxxl-5 {
                margin-right: 3rem !important;
            }
            .me-xxxl-auto {
                margin-right: auto !important;
            }
            .mb-xxxl-0 {
                margin-bottom: 0 !important;
            }
            .mb-xxxl-1 {
                margin-bottom: 0.25rem !important;
            }
            .mb-xxxl-2 {
                margin-bottom: 0.5rem !important;
            }
            .mb-xxxl-3 {
                margin-bottom: 1rem !important;
            }
            .mb-xxxl-4 {
                margin-bottom: 1.5rem !important;
            }
            .mb-xxxl-5 {
                margin-bottom: 3rem !important;
            }
            .mb-xxxl-auto {
                margin-bottom: auto !important;
            }
            .ms-xxxl-0 {
                margin-left: 0 !important;
            }
            .ms-xxxl-1 {
                margin-left: 0.25rem !important;
            }
            .ms-xxxl-2 {
                margin-left: 0.5rem !important;
            }
            .ms-xxxl-3 {
                margin-left: 1rem !important;
            }
            .ms-xxxl-4 {
                margin-left: 1.5rem !important;
            }
            .ms-xxxl-5 {
                margin-left: 3rem !important;
            }
            .ms-xxxl-auto {
                margin-left: auto !important;
            }
            .p-xxxl-0 {
                padding: 0 !important;
            }
            .p-xxxl-1 {
                padding: 0.25rem !important;
            }
            .p-xxxl-2 {
                padding: 0.5rem !important;
            }
            .p-xxxl-3 {
                padding: 1rem !important;
            }
            .p-xxxl-4 {
                padding: 1.5rem !important;
            }
            .p-xxxl-5 {
                padding: 3rem !important;
            }
            .px-xxxl-0 {
                padding-right: 0 !important;
                padding-left: 0 !important;
            }
            .px-xxxl-1 {
                padding-right: 0.25rem !important;
                padding-left: 0.25rem !important;
            }
            .px-xxxl-2 {
                padding-right: 0.5rem !important;
                padding-left: 0.5rem !important;
            }
            .px-xxxl-3 {
                padding-right: 1rem !important;
                padding-left: 1rem !important;
            }
            .px-xxxl-4 {
                padding-right: 1.5rem !important;
                padding-left: 1.5rem !important;
            }
            .px-xxxl-5 {
                padding-right: 3rem !important;
                padding-left: 3rem !important;
            }
            .py-xxxl-0 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
            }
            .py-xxxl-1 {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            .py-xxxl-2 {
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }
            .py-xxxl-3 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }
            .py-xxxl-4 {
                padding-top: 1.5rem !important;
                padding-bottom: 1.5rem !important;
            }
            .py-xxxl-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .pt-xxxl-0 {
                padding-top: 0 !important;
            }
            .pt-xxxl-1 {
                padding-top: 0.25rem !important;
            }
            .pt-xxxl-2 {
                padding-top: 0.5rem !important;
            }
            .pt-xxxl-3 {
                padding-top: 1rem !important;
            }
            .pt-xxxl-4 {
                padding-top: 1.5rem !important;
            }
            .pt-xxxl-5 {
                padding-top: 3rem !important;
            }
            .pe-xxxl-0 {
                padding-right: 0 !important;
            }
            .pe-xxxl-1 {
                padding-right: 0.25rem !important;
            }
            .pe-xxxl-2 {
                padding-right: 0.5rem !important;
            }
            .pe-xxxl-3 {
                padding-right: 1rem !important;
            }
            .pe-xxxl-4 {
                padding-right: 1.5rem !important;
            }
            .pe-xxxl-5 {
                padding-right: 3rem !important;
            }
            .pb-xxxl-0 {
                padding-bottom: 0 !important;
            }
            .pb-xxxl-1 {
                padding-bottom: 0.25rem !important;
            }
            .pb-xxxl-2 {
                padding-bottom: 0.5rem !important;
            }
            .pb-xxxl-3 {
                padding-bottom: 1rem !important;
            }
            .pb-xxxl-4 {
                padding-bottom: 1.5rem !important;
            }
            .pb-xxxl-5 {
                padding-bottom: 3rem !important;
            }
            .ps-xxxl-0 {
                padding-left: 0 !important;
            }
            .ps-xxxl-1 {
                padding-left: 0.25rem !important;
            }
            .ps-xxxl-2 {
                padding-left: 0.5rem !important;
            }
            .ps-xxxl-3 {
                padding-left: 1rem !important;
            }
            .ps-xxxl-4 {
                padding-left: 1.5rem !important;
            }
            .ps-xxxl-5 {
                padding-left: 3rem !important;
            }
        }
        @media print {
            .d-print-inline {
                display: inline !important;
            }
            .d-print-inline-block {
                display: inline-block !important;
            }
            .d-print-block {
                display: block !important;
            }
            .d-print-grid {
                display: grid !important;
            }
            .d-print-table {
                display: table !important;
            }
            .d-print-table-row {
                display: table-row !important;
            }
            .d-print-table-cell {
                display: table-cell !important;
            }
            .d-print-flex {
                display: flex !important;
            }
            .d-print-inline-flex {
                display: inline-flex !important;
            }
            .d-print-none {
                display: none !important;
            }
        }

        :root {
            --base-font-family: "iranyekan", tahoma !important;
            --base-font-size: 15px;
            --base-font-weight: 400;
            --base-line-height: 40px;
            --base-color: var(--secondary);
            --base-bg: var(--primary-7);
            --base-gutter: 1rem;
            --base-gutter-lg: 0.75rem;
            --base-gutter-sm: 0.5rem;
            --base-radius: 8px;
            --btn-bg: var(--primary);
            --btn-bg-hover: white;
            --btn-bg-focus: var(--primary-5);
            --btn-color: white;
            --btn-color-hover: var(--primary);
            --btn-color-focus: var(--primary);
            --btn-border: var(--primary);
            --btn-border-hover: var(--primary);
            --btn-border-focus: var(--primary);
            --btn-radius: var(--base-radius);
            --btn-rounded-radius: 54px;
            --btn-gap: 12px;
            --btn-transition: "";
            --btn-padding-x: 30px;
            --btn-padding-y: 14px;
            --btn-padding: var(--btn-padding-y) var(--btn-padding-x);
            --btn-font-size: 17px;
            --btn-line-height: 24px;
            --btn-font-weight: 400;
            --btn-padding-lg: 12px 24px;
            --btn-font-size-lg: 17px;
            --btn-line-height-lg: 24px;
            --btn-font-weight-lg: 400;
            --btn-gap-lg: 12px;
            --btn-padding-x-sm: 24px;
            --btn-padding-y-sm: 10px;
            --btn-padding-sm: var(--btn-padding-y-sm) var(--btn-padding-x-sm);
            --btn-font-size-sm: 15px;
            --btn-line-height-sm: 22px;
            --btn-font-weight-sm: 400;
            --btn-gap-sm: 8px;
            --btn-padding-x-xs: 10px;
            --btn-padding-y-xs: 6px;
            --btn-padding-xs: var(--btn-padding-y-xs) var(--btn-padding-x-xs);
            --btn-font-size-xs: 12px;
            --btn-line-height-xs: 12px;
            --btn-font-weight-xs: 400;
            --btn-gap-xs: 4px;
            --btn-shadow: "";
            --btn-shadow-hover: "";
            --btn-shadow-focus: "";
            --btn-icon-font-size: 21px;
            --btn-icon-font-size-xs: 14px;
            --btn-icon-font-size-sm: 20px;
            --btn-icon-font-size-lg: 24px;
            --btn-circle-radius: 50%;
            --btn-circle-font-size: 24px;
            --btn-circle-font-size-xs: 20px;
            --btn-circle-font-size-sm: 20px;
            --btn-circle-font-size-lg: 30px;
            --btn-circle-size: 54px;
            --btn-circle-size-lg: 62px;
            --btn-circle-size-sm: 44px;
            --btn-circle-size-xs: 34px;
            --input-bg: var(--secondary-1);
            --input-padding-single: 24px;
            --input-padding: 0 var(--input-padding-single) !important;
            --input-radius: var(--base-radius);
            --input-rounded-radius: var(--input-height);
            --input-switch-radius: 12px;
            --input-border: var(--secondary-10);
            --input-clickable-border: var(--secondary-30);
            --input-theme-focus: var(--primary);
            --input-checked-bg: var(--primary);
            --input-group-child-border: var(--secondary-10);
            --input-group-label-bg: var(--secondary-2);
            --input-card-checked-bg: white;
            --input-card-checked-bg-hover: var(--secondary-2);
            --input-card-checked-bg-checked: var(--success);
            --input-height-stable: 54px;
            --input-height: var(--input-height-stable);
            --input-font-size-stable: 16px;
            --input-font-size: var(--input-font-size-stable);
            --input-line-height-stable: 40px;
            --input-line-height: var(--input-line-height-stable);
            --input-font-weight-stable: 500;
            --input-font-weight: var(--input-font-weight-stable);
            --textarea-line-height-stable: 35px;
            --textarea-line-height: var(--textarea-line-height-stable);
            --input-group-icon-size-stable: 24px;
            --input-group-icon-size: var(--input-group-icon-size-stable);
            --select-icon-position-y-stable: 18px;
            --select-icon-position-y: var(--select-icon-position-y-stable);
            --select-padding-start: 60px;
            --input-height-lg: 62px;
            --input-height-sm: 44px;
            --input-font-size-sm: 15px;
            --input-line-height-sm: 30px;
            --input-font-weight-sm: 400;
            --select-icon-position-y-sm: 13px;
            --primary: #428ded;
            --primary-1: #fdfeff;
            --primary-2: #fbfdff;
            --primary-3: #f9fcfe;
            --primary-5: #f6f9fe;
            --primary-7: #f2f7fe;
            --primary-10: #ecf4fd;
            --primary-15: #e3eefc;
            --primary-20: #d9e8fb;
            --primary-25: #d0e3fb;
            --primary-30: #c6ddfa;
            --primary-40: #b3d1f8;
            --primary-50: #a1c6f6;
            --primary-60: #8ebbf4;
            --primary-70: #7baff2;
            --primary-80: #68a4f1;
            --primary-90: #5598ef;
            --secondary: #2a3554;
            --secondary-1: #fdfdfd;
            --secondary-2: #fbfbfc;
            --secondary-3: #f9f9fa;
            --secondary-5: #f4f5f6;
            --secondary-7: #f0f1f3;
            --secondary-10: #eaebee;
            --secondary-15: #dfe1e5;
            --secondary-20: #d4d7dd;
            --secondary-25: #cacdd4;
            --secondary-30: #bfc2cc;
            --secondary-40: #aaaebb;
            --secondary-50: #959aaa;
            --secondary-60: #7f8698;
            --secondary-70: #6a7287;
            --secondary-80: #555d76;
            --secondary-90: #3f4965;
            --success: #1ece9a;
            --success-1: #fdfffe;
            --success-2: #fbfefd;
            --success-3: #f8fefc;
            --success-5: #f4fdfa;
            --success-7: #effcf8;
            --success-10: #e9faf5;
            --success-15: #ddf8f0;
            --success-20: #d2f5eb;
            --success-25: #c7f3e6;
            --success-30: #bcf0e1;
            --success-40: #a5ebd7;
            --success-50: #8fe7cd;
            --success-60: #78e2c2;
            --success-70: #62ddb8;
            --success-80: #4bd8ae;
            --success-90: #35d3a4;
            --warning: #ffbf38;
            --warning-1: #fffefd;
            --warning-2: #fffefb;
            --warning-3: #fffdf9;
            --warning-5: #fffcf5;
            --warning-7: #fffbf1;
            --warning-10: #fff9eb;
            --warning-15: #fff5e1;
            --warning-20: #fff2d7;
            --warning-25: #ffefcd;
            --warning-30: #ffecc3;
            --warning-40: #ffe5af;
            --warning-50: #ffdf9c;
            --warning-60: #ffd988;
            --warning-70: #ffd274;
            --warning-80: #ffcc60;
            --warning-90: #ffc54c;
            --danger: #fb5252;
            --danger-1: #fffdfd;
            --danger-2: #fffcfc;
            --danger-3: snow;
            --danger-5: #fff6f6;
            --danger-7: #fff3f3;
            --danger-10: #ffeeee;
            --danger-15: #fee5e5;
            --danger-20: #fedcdc;
            --danger-25: #fed4d4;
            --danger-30: #fecbcb;
            --danger-40: #fdbaba;
            --danger-50: #fda9a9;
            --danger-60: #fd9797;
            --danger-70: #fc8686;
            --danger-80: #fc7575;
            --danger-90: #fb6363;
            --white: #ffffff;
        }

        .row.m-to-p {
            margin-top: 0;
            padding-top: calc(-1 * var(--bs-gutter-y));
        }
        .row.m-to-p > * {
            margin-top: 0;
            padding-top: var(--bs-gutter-y);
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .border-primary {
            border: solid 1px var(--primary) !important;
        }

        .bg-primary-1 {
            background-color: var(--primary-1) !important;
        }

        .text-primary-1 {
            color: var(--primary-1) !important;
        }

        .bg-primary-2 {
            background-color: var(--primary-2) !important;
        }

        .text-primary-2 {
            color: var(--primary-2) !important;
        }

        .bg-primary-3 {
            background-color: var(--primary-3) !important;
        }

        .text-primary-3 {
            color: var(--primary-3) !important;
        }

        .bg-primary-5 {
            background-color: var(--primary-5) !important;
        }

        .text-primary-5 {
            color: var(--primary-5) !important;
        }

        .bg-primary-7 {
            background-color: var(--primary-7) !important;
        }

        .text-primary-7 {
            color: var(--primary-7) !important;
        }

        .bg-primary-10 {
            background-color: var(--primary-10) !important;
        }

        .text-primary-10 {
            color: var(--primary-10) !important;
        }

        .bg-primary-15 {
            background-color: var(--primary-15) !important;
        }

        .text-primary-15 {
            color: var(--primary-15) !important;
        }

        .bg-primary-20 {
            background-color: var(--primary-20) !important;
        }

        .text-primary-20 {
            color: var(--primary-20) !important;
        }

        .bg-primary-25 {
            background-color: var(--primary-25) !important;
        }

        .text-primary-25 {
            color: var(--primary-25) !important;
        }

        .bg-primary-30 {
            background-color: var(--primary-30) !important;
        }

        .text-primary-30 {
            color: var(--primary-30) !important;
        }

        .bg-primary-40 {
            background-color: var(--primary-40) !important;
        }

        .text-primary-40 {
            color: var(--primary-40) !important;
        }

        .bg-primary-50 {
            background-color: var(--primary-50) !important;
        }

        .text-primary-50 {
            color: var(--primary-50) !important;
        }

        .bg-primary-60 {
            background-color: var(--primary-60) !important;
        }

        .text-primary-60 {
            color: var(--primary-60) !important;
        }

        .bg-primary-70 {
            background-color: var(--primary-70) !important;
        }

        .text-primary-70 {
            color: var(--primary-70) !important;
        }

        .bg-primary-80 {
            background-color: var(--primary-80) !important;
        }

        .text-primary-80 {
            color: var(--primary-80) !important;
        }

        .bg-primary-90 {
            background-color: var(--primary-90) !important;
        }

        .text-primary-90 {
            color: var(--primary-90) !important;
        }

        .bg-secondary {
            background-color: var(--secondary) !important;
        }

        .text-secondary {
            color: var(--secondary) !important;
        }

        .border-secondary {
            border: solid 1px var(--secondary) !important;
        }

        .bg-secondary-1 {
            background-color: var(--secondary-1) !important;
        }

        .text-secondary-1 {
            color: var(--secondary-1) !important;
        }

        .bg-secondary-2 {
            background-color: var(--secondary-2) !important;
        }

        .text-secondary-2 {
            color: var(--secondary-2) !important;
        }

        .bg-secondary-3 {
            background-color: var(--secondary-3) !important;
        }

        .text-secondary-3 {
            color: var(--secondary-3) !important;
        }

        .bg-secondary-5 {
            background-color: var(--secondary-5) !important;
        }

        .text-secondary-5 {
            color: var(--secondary-5) !important;
        }

        .bg-secondary-7 {
            background-color: var(--secondary-7) !important;
        }

        .text-secondary-7 {
            color: var(--secondary-7) !important;
        }

        .bg-secondary-10 {
            background-color: var(--secondary-10) !important;
        }

        .text-secondary-10 {
            color: var(--secondary-10) !important;
        }

        .bg-secondary-15 {
            background-color: var(--secondary-15) !important;
        }

        .text-secondary-15 {
            color: var(--secondary-15) !important;
        }

        .bg-secondary-20 {
            background-color: var(--secondary-20) !important;
        }

        .text-secondary-20 {
            color: var(--secondary-20) !important;
        }

        .bg-secondary-25 {
            background-color: var(--secondary-25) !important;
        }

        .text-secondary-25 {
            color: var(--secondary-25) !important;
        }

        .bg-secondary-30 {
            background-color: var(--secondary-30) !important;
        }

        .text-secondary-30 {
            color: var(--secondary-30) !important;
        }

        .bg-secondary-40 {
            background-color: var(--secondary-40) !important;
        }

        .text-secondary-40 {
            color: var(--secondary-40) !important;
        }

        .bg-secondary-50 {
            background-color: var(--secondary-50) !important;
        }

        .text-secondary-50 {
            color: var(--secondary-50) !important;
        }

        .bg-secondary-60 {
            background-color: var(--secondary-60) !important;
        }

        .text-secondary-60 {
            color: var(--secondary-60) !important;
        }

        .bg-secondary-70 {
            background-color: var(--secondary-70) !important;
        }

        .text-secondary-70 {
            color: var(--secondary-70) !important;
        }

        .bg-secondary-80 {
            background-color: var(--secondary-80) !important;
        }

        .text-secondary-80 {
            color: var(--secondary-80) !important;
        }

        .bg-secondary-90 {
            background-color: var(--secondary-90) !important;
        }

        .text-secondary-90 {
            color: var(--secondary-90) !important;
        }

        .bg-success {
            background-color: var(--success) !important;
        }

        .text-success {
            color: var(--success) !important;
        }

        .border-success {
            border: solid 1px var(--success) !important;
        }

        .bg-success-1 {
            background-color: var(--success-1) !important;
        }

        .text-success-1 {
            color: var(--success-1) !important;
        }

        .bg-success-2 {
            background-color: var(--success-2) !important;
        }

        .text-success-2 {
            color: var(--success-2) !important;
        }

        .bg-success-3 {
            background-color: var(--success-3) !important;
        }

        .text-success-3 {
            color: var(--success-3) !important;
        }

        .bg-success-5 {
            background-color: var(--success-5) !important;
        }

        .text-success-5 {
            color: var(--success-5) !important;
        }

        .bg-success-7 {
            background-color: var(--success-7) !important;
        }

        .text-success-7 {
            color: var(--success-7) !important;
        }

        .bg-success-10 {
            background-color: var(--success-10) !important;
        }

        .text-success-10 {
            color: var(--success-10) !important;
        }

        .bg-success-15 {
            background-color: var(--success-15) !important;
        }

        .text-success-15 {
            color: var(--success-15) !important;
        }

        .bg-success-20 {
            background-color: var(--success-20) !important;
        }

        .text-success-20 {
            color: var(--success-20) !important;
        }

        .bg-success-25 {
            background-color: var(--success-25) !important;
        }

        .text-success-25 {
            color: var(--success-25) !important;
        }

        .bg-success-30 {
            background-color: var(--success-30) !important;
        }

        .text-success-30 {
            color: var(--success-30) !important;
        }

        .bg-success-40 {
            background-color: var(--success-40) !important;
        }

        .text-success-40 {
            color: var(--success-40) !important;
        }

        .bg-success-50 {
            background-color: var(--success-50) !important;
        }

        .text-success-50 {
            color: var(--success-50) !important;
        }

        .bg-success-60 {
            background-color: var(--success-60) !important;
        }

        .text-success-60 {
            color: var(--success-60) !important;
        }

        .bg-success-70 {
            background-color: var(--success-70) !important;
        }

        .text-success-70 {
            color: var(--success-70) !important;
        }

        .bg-success-80 {
            background-color: var(--success-80) !important;
        }

        .text-success-80 {
            color: var(--success-80) !important;
        }

        .bg-success-90 {
            background-color: var(--success-90) !important;
        }

        .text-success-90 {
            color: var(--success-90) !important;
        }

        .bg-warning {
            background-color: var(--warning) !important;
        }

        .text-warning {
            color: var(--warning) !important;
        }

        .border-warning {
            border: solid 1px var(--warning) !important;
        }

        .bg-warning-1 {
            background-color: var(--warning-1) !important;
        }

        .text-warning-1 {
            color: var(--warning-1) !important;
        }

        .bg-warning-2 {
            background-color: var(--warning-2) !important;
        }

        .text-warning-2 {
            color: var(--warning-2) !important;
        }

        .bg-warning-3 {
            background-color: var(--warning-3) !important;
        }

        .text-warning-3 {
            color: var(--warning-3) !important;
        }

        .bg-warning-5 {
            background-color: var(--warning-5) !important;
        }

        .text-warning-5 {
            color: var(--warning-5) !important;
        }

        .bg-warning-7 {
            background-color: var(--warning-7) !important;
        }

        .text-warning-7 {
            color: var(--warning-7) !important;
        }

        .bg-warning-10 {
            background-color: var(--warning-10) !important;
        }

        .text-warning-10 {
            color: var(--warning-10) !important;
        }

        .bg-warning-15 {
            background-color: var(--warning-15) !important;
        }

        .text-warning-15 {
            color: var(--warning-15) !important;
        }

        .bg-warning-20 {
            background-color: var(--warning-20) !important;
        }

        .text-warning-20 {
            color: var(--warning-20) !important;
        }

        .bg-warning-25 {
            background-color: var(--warning-25) !important;
        }

        .text-warning-25 {
            color: var(--warning-25) !important;
        }

        .bg-warning-30 {
            background-color: var(--warning-30) !important;
        }

        .text-warning-30 {
            color: var(--warning-30) !important;
        }

        .bg-warning-40 {
            background-color: var(--warning-40) !important;
        }

        .text-warning-40 {
            color: var(--warning-40) !important;
        }

        .bg-warning-50 {
            background-color: var(--warning-50) !important;
        }

        .text-warning-50 {
            color: var(--warning-50) !important;
        }

        .bg-warning-60 {
            background-color: var(--warning-60) !important;
        }

        .text-warning-60 {
            color: var(--warning-60) !important;
        }

        .bg-warning-70 {
            background-color: var(--warning-70) !important;
        }

        .text-warning-70 {
            color: var(--warning-70) !important;
        }

        .bg-warning-80 {
            background-color: var(--warning-80) !important;
        }

        .text-warning-80 {
            color: var(--warning-80) !important;
        }

        .bg-warning-90 {
            background-color: var(--warning-90) !important;
        }

        .text-warning-90 {
            color: var(--warning-90) !important;
        }

        .bg-danger {
            background-color: var(--danger) !important;
        }

        .text-danger {
            color: var(--danger) !important;
        }

        .border-danger {
            border: solid 1px var(--danger) !important;
        }

        .bg-danger-1 {
            background-color: var(--danger-1) !important;
        }

        .text-danger-1 {
            color: var(--danger-1) !important;
        }

        .bg-danger-2 {
            background-color: var(--danger-2) !important;
        }

        .text-danger-2 {
            color: var(--danger-2) !important;
        }

        .bg-danger-3 {
            background-color: var(--danger-3) !important;
        }

        .text-danger-3 {
            color: var(--danger-3) !important;
        }

        .bg-danger-5 {
            background-color: var(--danger-5) !important;
        }

        .text-danger-5 {
            color: var(--danger-5) !important;
        }

        .bg-danger-7 {
            background-color: var(--danger-7) !important;
        }

        .text-danger-7 {
            color: var(--danger-7) !important;
        }

        .bg-danger-10 {
            background-color: var(--danger-10) !important;
        }

        .text-danger-10 {
            color: var(--danger-10) !important;
        }

        .bg-danger-15 {
            background-color: var(--danger-15) !important;
        }

        .text-danger-15 {
            color: var(--danger-15) !important;
        }

        .bg-danger-20 {
            background-color: var(--danger-20) !important;
        }

        .text-danger-20 {
            color: var(--danger-20) !important;
        }

        .bg-danger-25 {
            background-color: var(--danger-25) !important;
        }

        .text-danger-25 {
            color: var(--danger-25) !important;
        }

        .bg-danger-30 {
            background-color: var(--danger-30) !important;
        }

        .text-danger-30 {
            color: var(--danger-30) !important;
        }

        .bg-danger-40 {
            background-color: var(--danger-40) !important;
        }

        .text-danger-40 {
            color: var(--danger-40) !important;
        }

        .bg-danger-50 {
            background-color: var(--danger-50) !important;
        }

        .text-danger-50 {
            color: var(--danger-50) !important;
        }

        .bg-danger-60 {
            background-color: var(--danger-60) !important;
        }

        .text-danger-60 {
            color: var(--danger-60) !important;
        }

        .bg-danger-70 {
            background-color: var(--danger-70) !important;
        }

        .text-danger-70 {
            color: var(--danger-70) !important;
        }

        .bg-danger-80 {
            background-color: var(--danger-80) !important;
        }

        .text-danger-80 {
            color: var(--danger-80) !important;
        }

        .bg-danger-90 {
            background-color: var(--danger-90) !important;
        }

        .text-danger-90 {
            color: var(--danger-90) !important;
        }

        .bg-white {
            background: white !important;
        }

        .bg-white-50 {
            background: rgba(255, 255, 255, 0.5) !important;
        }

        .text-white {
            color: white !important;
        }

        .text-inherit {
            color: inherit !important;
        }

        .bg-transparent {
            background: transparent !important;
        }

        .bg-white {
            background: white !important;
        }

        .text-completed {
            color: var(--success) !important;
        }

        .text-visited {
            color: var(--secondary-50) !important;
        }

        .text-played {
            color: var(--primary-70) !important;
        }

        .rtl {
            direction: rtl !important;
        }

        .ltr {
            direction: ltr !important;
            text-align: left !important;
        }

        .float-start {
            float: left !important;
        }

        .float-end {
            float: right !important;
        }

        .text-start {
            text-align: left !important;
        }

        .text-end {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-italic {
            font-style: italic !important;
        }

        .white-space-pre-line {
            white-space: pre-line !important;
        }

        .white-space-inherit {
            white-space: inherit !important;
        }

        .sticky-top {
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .no-after:after {
            display: none !important;
        }

        .no-before:before {
            display: none !important;
        }

        .position-absolute {
            position: absolute !important;
        }

        .position-relative {
            position: relative !important;
        }

        .position-sticky {
            position: sticky !important;
        }

        .position-fixed {
            position: fixed !important;
        }

        .start-0 {
            left: 0 !important;
        }

        .end-0 {
            right: 0 !important;
        }

        .top-0 {
            top: 0 !important;
        }

        .bottom-0 {
            bottom: 0 !important;
        }

        .w-0 {
            width: 0% !important;
        }

        .w-10 {
            width: 10% !important;
        }

        .w-20 {
            width: 20% !important;
        }

        .w-30 {
            width: 30% !important;
        }

        .w-40 {
            width: 40% !important;
        }

        .w-50 {
            width: 50% !important;
        }

        .w-60 {
            width: 60% !important;
        }

        .w-70 {
            width: 70% !important;
        }

        .w-80 {
            width: 80% !important;
        }

        .w-90 {
            width: 90% !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .w-25 {
            width: 25% !important;
        }

        .w-75 {
            width: 75% !important;
        }

        .min-w-40 {
            min-width: 40% !important;
        }

        .fw-100 {
            font-weight: 100 !important;
        }

        .fw-200 {
            font-weight: 200 !important;
        }

        .fw-300 {
            font-weight: 300 !important;
        }

        .fw-400 {
            font-weight: 400 !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .fw-600 {
            font-weight: 600 !important;
        }

        .fw-700 {
            font-weight: 700 !important;
        }

        .fw-800 {
            font-weight: 800 !important;
        }

        .fw-900 {
            font-weight: 900 !important;
        }

        .h-100 {
            height: 100% !important;
        }

        .min-h-fit {
            min-height: -moz-fit-content !important;
            min-height: fit-content !important;
        }

        .h-fit {
            height: -moz-fit-content !important;
            height: fit-content !important;
        }

        .w-inherit {
            width: inherit !important;
        }

        .min-w-fit {
            min-width: -moz-fit-content !important;
            min-width: fit-content !important;
        }

        .max-w-fit {
            max-width: -moz-fit-content !important;
            max-width: fit-content !important;
        }

        .max-w-100 {
            max-width: 100% !important;
        }

        .lh-1 {
            line-height: 1 !important;
        }

        .lh-2 {
            line-height: 2 !important;
        }

        .lh-2-5 {
            line-height: 2.5 !important;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .overflow-inherit {
            overflow: inherit !important;
        }

        .overflow-x-hidden {
            overflow-x: hidden !important;
        }

        .overflow-x-auto {
            overflow-x: auto !important;
        }

        .top-pos-1 {
            top: 1px !important;
        }

        .top-neg-1 {
            top: -1px !important;
        }

        .bottom-pos-1 {
            bottom: 1px !important;
        }

        .bottom-neg-1 {
            bottom: -1px !important;
        }

        .start-pos-1 {
            left: 1px !important;
        }

        .start-neg-1 {
            left: -1px !important;
        }

        .end-pos-1 {
            right: 1px !important;
        }

        .end-neg-1 {
            right: -1px !important;
        }

        .top-pos-2 {
            top: 2px !important;
        }

        .top-neg-2 {
            top: -2px !important;
        }

        .bottom-pos-2 {
            bottom: 2px !important;
        }

        .bottom-neg-2 {
            bottom: -2px !important;
        }

        .start-pos-2 {
            left: 2px !important;
        }

        .start-neg-2 {
            left: -2px !important;
        }

        .end-pos-2 {
            right: 2px !important;
        }

        .end-neg-2 {
            right: -2px !important;
        }

        .top-pos-3 {
            top: 3px !important;
        }

        .top-neg-3 {
            top: -3px !important;
        }

        .bottom-pos-3 {
            bottom: 3px !important;
        }

        .bottom-neg-3 {
            bottom: -3px !important;
        }

        .start-pos-3 {
            left: 3px !important;
        }

        .start-neg-3 {
            left: -3px !important;
        }

        .end-pos-3 {
            right: 3px !important;
        }

        .end-neg-3 {
            right: -3px !important;
        }

        .top-pos-4 {
            top: 4px !important;
        }

        .top-neg-4 {
            top: -4px !important;
        }

        .bottom-pos-4 {
            bottom: 4px !important;
        }

        .bottom-neg-4 {
            bottom: -4px !important;
        }

        .start-pos-4 {
            left: 4px !important;
        }

        .start-neg-4 {
            left: -4px !important;
        }

        .end-pos-4 {
            right: 4px !important;
        }

        .end-neg-4 {
            right: -4px !important;
        }

        .top-pos-5 {
            top: 5px !important;
        }

        .top-neg-5 {
            top: -5px !important;
        }

        .bottom-pos-5 {
            bottom: 5px !important;
        }

        .bottom-neg-5 {
            bottom: -5px !important;
        }

        .start-pos-5 {
            left: 5px !important;
        }

        .start-neg-5 {
            left: -5px !important;
        }

        .end-pos-5 {
            right: 5px !important;
        }

        .end-neg-5 {
            right: -5px !important;
        }

        .top-pos-6 {
            top: 6px !important;
        }

        .top-neg-6 {
            top: -6px !important;
        }

        .bottom-pos-6 {
            bottom: 6px !important;
        }

        .bottom-neg-6 {
            bottom: -6px !important;
        }

        .start-pos-6 {
            left: 6px !important;
        }

        .start-neg-6 {
            left: -6px !important;
        }

        .end-pos-6 {
            right: 6px !important;
        }

        .end-neg-6 {
            right: -6px !important;
        }

        .top-pos-7 {
            top: 7px !important;
        }

        .top-neg-7 {
            top: -7px !important;
        }

        .bottom-pos-7 {
            bottom: 7px !important;
        }

        .bottom-neg-7 {
            bottom: -7px !important;
        }

        .start-pos-7 {
            left: 7px !important;
        }

        .start-neg-7 {
            left: -7px !important;
        }

        .end-pos-7 {
            right: 7px !important;
        }

        .end-neg-7 {
            right: -7px !important;
        }

        .top-pos-8 {
            top: 8px !important;
        }

        .top-neg-8 {
            top: -8px !important;
        }

        .bottom-pos-8 {
            bottom: 8px !important;
        }

        .bottom-neg-8 {
            bottom: -8px !important;
        }

        .start-pos-8 {
            left: 8px !important;
        }

        .start-neg-8 {
            left: -8px !important;
        }

        .end-pos-8 {
            right: 8px !important;
        }

        .end-neg-8 {
            right: -8px !important;
        }

        .top-pos-9 {
            top: 9px !important;
        }

        .top-neg-9 {
            top: -9px !important;
        }

        .bottom-pos-9 {
            bottom: 9px !important;
        }

        .bottom-neg-9 {
            bottom: -9px !important;
        }

        .start-pos-9 {
            left: 9px !important;
        }

        .start-neg-9 {
            left: -9px !important;
        }

        .end-pos-9 {
            right: 9px !important;
        }

        .end-neg-9 {
            right: -9px !important;
        }

        .top-pos-10 {
            top: 10px !important;
        }

        .top-neg-10 {
            top: -10px !important;
        }

        .bottom-pos-10 {
            bottom: 10px !important;
        }

        .bottom-neg-10 {
            bottom: -10px !important;
        }

        .start-pos-10 {
            left: 10px !important;
        }

        .start-neg-10 {
            left: -10px !important;
        }

        .end-pos-10 {
            right: 10px !important;
        }

        .end-neg-10 {
            right: -10px !important;
        }

        .top-pos-11 {
            top: 11px !important;
        }

        .top-neg-11 {
            top: -11px !important;
        }

        .bottom-pos-11 {
            bottom: 11px !important;
        }

        .bottom-neg-11 {
            bottom: -11px !important;
        }

        .start-pos-11 {
            left: 11px !important;
        }

        .start-neg-11 {
            left: -11px !important;
        }

        .end-pos-11 {
            right: 11px !important;
        }

        .end-neg-11 {
            right: -11px !important;
        }

        .top-pos-12 {
            top: 12px !important;
        }

        .top-neg-12 {
            top: -12px !important;
        }

        .bottom-pos-12 {
            bottom: 12px !important;
        }

        .bottom-neg-12 {
            bottom: -12px !important;
        }

        .start-pos-12 {
            left: 12px !important;
        }

        .start-neg-12 {
            left: -12px !important;
        }

        .end-pos-12 {
            right: 12px !important;
        }

        .end-neg-12 {
            right: -12px !important;
        }

        .top-pos-13 {
            top: 13px !important;
        }

        .top-neg-13 {
            top: -13px !important;
        }

        .bottom-pos-13 {
            bottom: 13px !important;
        }

        .bottom-neg-13 {
            bottom: -13px !important;
        }

        .start-pos-13 {
            left: 13px !important;
        }

        .start-neg-13 {
            left: -13px !important;
        }

        .end-pos-13 {
            right: 13px !important;
        }

        .end-neg-13 {
            right: -13px !important;
        }

        .top-pos-14 {
            top: 14px !important;
        }

        .top-neg-14 {
            top: -14px !important;
        }

        .bottom-pos-14 {
            bottom: 14px !important;
        }

        .bottom-neg-14 {
            bottom: -14px !important;
        }

        .start-pos-14 {
            left: 14px !important;
        }

        .start-neg-14 {
            left: -14px !important;
        }

        .end-pos-14 {
            right: 14px !important;
        }

        .end-neg-14 {
            right: -14px !important;
        }

        .top-0 {
            top: 0 !important;
        }

        .bottom-0 {
            bottom: 0 !important;
        }

        .start-0 {
            left: 0 !important;
        }

        .end-0 {
            right: 0 !important;
        }

        .overflow-y-scroll {
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .overflow-y-scroll::-webkit-scrollbar {
            display: none;
        }

        .overflow-x-scroll {
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .overflow-x-scroll::-webkit-scrollbar {
            display: none;
        }

        .op-0 {
            opacity: 0 !important;
        }

        .op-10 {
            opacity: 0.1 !important;
        }

        .op-20 {
            opacity: 0.2 !important;
        }

        .op-30 {
            opacity: 0.3 !important;
        }

        .op-40 {
            opacity: 0.4 !important;
        }

        .op-50 {
            opacity: 0.5 !important;
        }

        .op-60 {
            opacity: 0.6 !important;
        }

        .op-70 {
            opacity: 0.7 !important;
        }

        .op-80 {
            opacity: 0.8 !important;
        }

        .op-90 {
            opacity: 0.9 !important;
        }

        .op-100 {
            opacity: 1 !important;
        }

        .fs-8 {
            font-size: 8px !important;
        }

        .fs-9 {
            font-size: 9px !important;
        }

        .fs-10 {
            font-size: 10px !important;
        }

        .fs-11 {
            font-size: 11px !important;
        }

        .fs-12 {
            font-size: 12px !important;
        }

        .fs-13 {
            font-size: 13px !important;
        }

        .fs-14 {
            font-size: 14px !important;
        }

        .fs-15 {
            font-size: 15px !important;
        }

        .fs-16 {
            font-size: 16px !important;
        }

        .fs-17 {
            font-size: 17px !important;
        }

        .fs-18 {
            font-size: 18px !important;
        }

        .fs-19 {
            font-size: 19px !important;
        }

        .fs-20 {
            font-size: 20px !important;
        }

        .fs-21 {
            font-size: 21px !important;
        }

        .fs-22 {
            font-size: 22px !important;
        }

        .fs-23 {
            font-size: 23px !important;
        }

        .fs-24 {
            font-size: 24px !important;
        }

        .fs-25 {
            font-size: 25px !important;
        }

        .fs-26 {
            font-size: 26px !important;
        }

        .fs-27 {
            font-size: 27px !important;
        }

        .fs-28 {
            font-size: 28px !important;
        }

        .fs-29 {
            font-size: 29px !important;
        }

        .fs-30 {
            font-size: 30px !important;
        }

        .fs-31 {
            font-size: 31px !important;
        }

        .fs-32 {
            font-size: 32px !important;
        }

        .fs-33 {
            font-size: 33px !important;
        }

        .fs-34 {
            font-size: 34px !important;
        }

        .fs-35 {
            font-size: 35px !important;
        }

        .fs-36 {
            font-size: 36px !important;
        }

        .fs-37 {
            font-size: 37px !important;
        }

        .fs-38 {
            font-size: 38px !important;
        }

        .fs-39 {
            font-size: 39px !important;
        }

        .fs-40 {
            font-size: 40px !important;
        }

        .fs-41 {
            font-size: 41px !important;
        }

        .fs-42 {
            font-size: 42px !important;
        }

        .me-neg-1 {
            margin-right: -1px !important;
        }

        .ms-neg-1 {
            margin-left: -1px !important;
        }

        .mt-neg-1 {
            margin-top: -1px !important;
        }

        .mb-neg-1 {
            margin-bottom: -1px !important;
        }

        .me-neg-2 {
            margin-right: -2px !important;
        }

        .ms-neg-2 {
            margin-left: -2px !important;
        }

        .mt-neg-2 {
            margin-top: -2px !important;
        }

        .mb-neg-2 {
            margin-bottom: -2px !important;
        }

        .me-neg-3 {
            margin-right: -3px !important;
        }

        .ms-neg-3 {
            margin-left: -3px !important;
        }

        .mt-neg-3 {
            margin-top: -3px !important;
        }

        .mb-neg-3 {
            margin-bottom: -3px !important;
        }

        .me-neg-4 {
            margin-right: -4px !important;
        }

        .ms-neg-4 {
            margin-left: -4px !important;
        }

        .mt-neg-4 {
            margin-top: -4px !important;
        }

        .mb-neg-4 {
            margin-bottom: -4px !important;
        }

        .me-neg-5 {
            margin-right: -5px !important;
        }

        .ms-neg-5 {
            margin-left: -5px !important;
        }

        .mt-neg-5 {
            margin-top: -5px !important;
        }

        .mb-neg-5 {
            margin-bottom: -5px !important;
        }

        .me-neg-6 {
            margin-right: -6px !important;
        }

        .ms-neg-6 {
            margin-left: -6px !important;
        }

        .mt-neg-6 {
            margin-top: -6px !important;
        }

        .mb-neg-6 {
            margin-bottom: -6px !important;
        }

        .me-neg-7 {
            margin-right: -7px !important;
        }

        .ms-neg-7 {
            margin-left: -7px !important;
        }

        .mt-neg-7 {
            margin-top: -7px !important;
        }

        .mb-neg-7 {
            margin-bottom: -7px !important;
        }

        .me-neg-8 {
            margin-right: -8px !important;
        }

        .ms-neg-8 {
            margin-left: -8px !important;
        }

        .mt-neg-8 {
            margin-top: -8px !important;
        }

        .mb-neg-8 {
            margin-bottom: -8px !important;
        }

        .me-neg-9 {
            margin-right: -9px !important;
        }

        .ms-neg-9 {
            margin-left: -9px !important;
        }

        .mt-neg-9 {
            margin-top: -9px !important;
        }

        .mb-neg-9 {
            margin-bottom: -9px !important;
        }

        .me-neg-10 {
            margin-right: -10px !important;
        }

        .ms-neg-10 {
            margin-left: -10px !important;
        }

        .mt-neg-10 {
            margin-top: -10px !important;
        }

        .mb-neg-10 {
            margin-bottom: -10px !important;
        }

        .me-neg-11 {
            margin-right: -11px !important;
        }

        .ms-neg-11 {
            margin-left: -11px !important;
        }

        .mt-neg-11 {
            margin-top: -11px !important;
        }

        .mb-neg-11 {
            margin-bottom: -11px !important;
        }

        .me-neg-12 {
            margin-right: -12px !important;
        }

        .ms-neg-12 {
            margin-left: -12px !important;
        }

        .mt-neg-12 {
            margin-top: -12px !important;
        }

        .mb-neg-12 {
            margin-bottom: -12px !important;
        }

        .me-neg-13 {
            margin-right: -13px !important;
        }

        .ms-neg-13 {
            margin-left: -13px !important;
        }

        .mt-neg-13 {
            margin-top: -13px !important;
        }

        .mb-neg-13 {
            margin-bottom: -13px !important;
        }

        .me-neg-14 {
            margin-right: -14px !important;
        }

        .ms-neg-14 {
            margin-left: -14px !important;
        }

        .mt-neg-14 {
            margin-top: -14px !important;
        }

        .mb-neg-14 {
            margin-bottom: -14px !important;
        }

        .me-neg-15 {
            margin-right: -15px !important;
        }

        .ms-neg-15 {
            margin-left: -15px !important;
        }

        .mt-neg-15 {
            margin-top: -15px !important;
        }

        .mb-neg-15 {
            margin-bottom: -15px !important;
        }

        .me-neg-16 {
            margin-right: -16px !important;
        }

        .ms-neg-16 {
            margin-left: -16px !important;
        }

        .mt-neg-16 {
            margin-top: -16px !important;
        }

        .mb-neg-16 {
            margin-bottom: -16px !important;
        }

        .me-neg-17 {
            margin-right: -17px !important;
        }

        .ms-neg-17 {
            margin-left: -17px !important;
        }

        .mt-neg-17 {
            margin-top: -17px !important;
        }

        .mb-neg-17 {
            margin-bottom: -17px !important;
        }

        .me-neg-18 {
            margin-right: -18px !important;
        }

        .ms-neg-18 {
            margin-left: -18px !important;
        }

        .mt-neg-18 {
            margin-top: -18px !important;
        }

        .mb-neg-18 {
            margin-bottom: -18px !important;
        }

        .me-neg-19 {
            margin-right: -19px !important;
        }

        .ms-neg-19 {
            margin-left: -19px !important;
        }

        .mt-neg-19 {
            margin-top: -19px !important;
        }

        .mb-neg-19 {
            margin-bottom: -19px !important;
        }

        .me-neg-20 {
            margin-right: -20px !important;
        }

        .ms-neg-20 {
            margin-left: -20px !important;
        }

        .mt-neg-20 {
            margin-top: -20px !important;
        }

        .mb-neg-20 {
            margin-bottom: -20px !important;
        }

        .me-neg-21 {
            margin-right: -21px !important;
        }

        .ms-neg-21 {
            margin-left: -21px !important;
        }

        .mt-neg-21 {
            margin-top: -21px !important;
        }

        .mb-neg-21 {
            margin-bottom: -21px !important;
        }

        .me-neg-22 {
            margin-right: -22px !important;
        }

        .ms-neg-22 {
            margin-left: -22px !important;
        }

        .mt-neg-22 {
            margin-top: -22px !important;
        }

        .mb-neg-22 {
            margin-bottom: -22px !important;
        }

        .me-neg-23 {
            margin-right: -23px !important;
        }

        .ms-neg-23 {
            margin-left: -23px !important;
        }

        .mt-neg-23 {
            margin-top: -23px !important;
        }

        .mb-neg-23 {
            margin-bottom: -23px !important;
        }

        .me-neg-24 {
            margin-right: -24px !important;
        }

        .ms-neg-24 {
            margin-left: -24px !important;
        }

        .mt-neg-24 {
            margin-top: -24px !important;
        }

        .mb-neg-24 {
            margin-bottom: -24px !important;
        }

        .me-neg-25 {
            margin-right: -25px !important;
        }

        .ms-neg-25 {
            margin-left: -25px !important;
        }

        .mt-neg-25 {
            margin-top: -25px !important;
        }

        .mb-neg-25 {
            margin-bottom: -25px !important;
        }

        .br-0 {
            border-radius: 0 !important;
        }

        .br-not-hover-0:not(:hover, :focus, .active) {
            border-radius: 0 !important;
        }

        .br-50 {
            border-radius: 50% !important;
        }

        .b {
            border: var(--border-style) 1px var(--border-color) !important;
        }

        .b-0 {
            border: 0 !important;
        }

        .bb {
            border-bottom: var(--border-style) 1px var(--border-color) !important;
        }

        .bb-0 {
            border-bottom: 0 !important;
        }

        .bt {
            border-top: var(--border-style) 1px var(--border-color) !important;
        }

        .bt-0 {
            border-top: 0 !important;
        }

        .bs {
            border-left: var(--border-style) 1px var(--border-color) !important;
        }

        .bs-0 {
            border-left: 0 !important;
        }

        .be {
            border-right: var(--border-style) 1px var(--border-color) !important;
        }

        .be-0 {
            border-right: 0 !important;
        }

        .b,
        .bb,
        .bt,
        .be,
        .bs {
            --border-style: solid;
            --border-color: var(--secondary-10);
        }
        .b.dashed,
        .bb.dashed,
        .bt.dashed,
        .be.dashed,
        .bs.dashed {
            --border-style: dashed;
        }
        .b.b-white,
        .bb.b-white,
        .bt.b-white,
        .be.b-white,
        .bs.b-white {
            --border-color: white !important;
        }
        .b.bw-2,
        .bb.bw-2,
        .bt.bw-2,
        .be.bw-2,
        .bs.bw-2 {
            border-width: 2px !important;
        }
        .b.bw-3,
        .bb.bw-3,
        .bt.bw-3,
        .be.bw-3,
        .bs.bw-3 {
            border-width: 3px !important;
        }
        .b.bw-4,
        .bb.bw-4,
        .bt.bw-4,
        .be.bw-4,
        .bs.bw-4 {
            border-width: 4px !important;
        }
        .b.bw-5,
        .bb.bw-5,
        .bt.bw-5,
        .be.bw-5,
        .bs.bw-5 {
            border-width: 5px !important;
        }
        .b.light,
        .bb.light,
        .bt.light,
        .be.light,
        .bs.light {
            --border-color: var(--secondary-5);
        }
        .b.b-transparent,
        .bb.b-transparent,
        .bt.b-transparent,
        .be.b-transparent,
        .bs.b-transparent {
            --border-color: rgba(255, 255, 255, 0.25) !important;
        }

        .base-radius {
            border-radius: var(--base-radius) !important;
        }
        .base-radius-md {
            border-radius: 13px !important;
        }

        .cursor-not-allowed {
            cursor: not-allowed !important;
        }

        .cursor-pointer,
        .tr-link {
            cursor: pointer !important;
        }

        :root {
            --gutter: 30px;
            --gutter-xxs: 10px;
            --gutter-xs: 14px;
            --gutter-sm: 34px;
            --gutter-md: 52px;
            --gutter-lg: 68px;
            --gutter-xl: 90px;
            --gutter-xxl: 140px;
        }

        .m-0 {
            margin: 0 !important;
        }

        .m {
            margin: var(--gutter) !important;
        }

        .m-xxs {
            margin: var(--gutter-xxs) !important;
        }

        .m-xs {
            margin: var(--gutter-xs) !important;
        }

        .m-sm {
            margin: var(--gutter-sm) !important;
        }

        .m-md {
            margin: var(--gutter-md) !important;
        }

        .m-lg {
            margin: var(--gutter-lg) !important;
        }

        .m-xl {
            margin: var(--gutter-xl) !important;
        }

        .m-xxl {
            margin: var(--gutter-xxl) !important;
        }

        .mx-0 {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .mx {
            margin-left: var(--gutter) !important;
            margin-right: var(--gutter) !important;
        }

        .mx-xxs {
            margin-left: var(--gutter-xxs) !important;
            margin-right: var(--gutter-xxs) !important;
        }

        .mx-xs {
            margin-left: var(--gutter-xs) !important;
            margin-right: var(--gutter-xs) !important;
        }

        .mx-sm {
            margin-left: var(--gutter-sm) !important;
            margin-right: var(--gutter-sm) !important;
        }

        .mx-md {
            margin-left: var(--gutter-md) !important;
            margin-right: var(--gutter-md) !important;
        }

        .mx-lg {
            margin-left: var(--gutter-lg) !important;
            margin-right: var(--gutter-lg) !important;
        }

        .mx-xl {
            margin-left: var(--gutter-xl) !important;
            margin-right: var(--gutter-xl) !important;
        }

        .mx-xxl {
            margin-left: var(--gutter-xxl) !important;
            margin-right: var(--gutter-xxl) !important;
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .my {
            margin-top: var(--gutter) !important;
            margin-bottom: var(--gutter) !important;
        }

        .my-xxs {
            margin-top: var(--gutter-xxs) !important;
            margin-bottom: var(--gutter-xxs) !important;
        }

        .my-xs {
            margin-top: var(--gutter-xs) !important;
            margin-bottom: var(--gutter-xs) !important;
        }

        .my-sm {
            margin-top: var(--gutter-sm) !important;
            margin-bottom: var(--gutter-sm) !important;
        }

        .my-md {
            margin-top: var(--gutter-md) !important;
            margin-bottom: var(--gutter-md) !important;
        }

        .my-lg {
            margin-top: var(--gutter-lg) !important;
            margin-bottom: var(--gutter-lg) !important;
        }

        .my-xl {
            margin-top: var(--gutter-xl) !important;
            margin-bottom: var(--gutter-xl) !important;
        }

        .my-xxl {
            margin-top: var(--gutter-xxl) !important;
            margin-bottom: var(--gutter-xxl) !important;
        }

        .ms-0 {
            margin-left: 0 !important;
        }

        .ms {
            margin-left: var(--gutter) !important;
        }

        .ms-xxs {
            margin-left: var(--gutter-xxs) !important;
        }

        .ms-xs {
            margin-left: var(--gutter-xs) !important;
        }

        .ms-sm {
            margin-left: var(--gutter-sm) !important;
        }

        .ms-md {
            margin-left: var(--gutter-md) !important;
        }

        .ms-lg {
            margin-left: var(--gutter-lg) !important;
        }

        .ms-xl {
            margin-left: var(--gutter-xl) !important;
        }

        .ms-xxl {
            margin-left: var(--gutter-xxl) !important;
        }

        .me-0 {
            margin-right: 0 !important;
        }

        .me {
            margin-right: var(--gutter) !important;
        }

        .me-xxs {
            margin-right: var(--gutter-xxs) !important;
        }

        .me-xs {
            margin-right: var(--gutter-xs) !important;
        }

        .me-sm {
            margin-right: var(--gutter-sm) !important;
        }

        .me-md {
            margin-right: var(--gutter-md) !important;
        }

        .me-lg {
            margin-right: var(--gutter-lg) !important;
        }

        .me-xl {
            margin-right: var(--gutter-xl) !important;
        }

        .me-xxl {
            margin-right: var(--gutter-xxl) !important;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mt {
            margin-top: var(--gutter) !important;
        }

        .mt-xxs {
            margin-top: var(--gutter-xxs) !important;
        }

        .mt-xs {
            margin-top: var(--gutter-xs) !important;
        }

        .mt-sm {
            margin-top: var(--gutter-sm) !important;
        }

        .mt-md {
            margin-top: var(--gutter-md) !important;
        }

        .mt-lg {
            margin-top: var(--gutter-lg) !important;
        }

        .mt-xl {
            margin-top: var(--gutter-xl) !important;
        }

        .mt-xxl {
            margin-top: var(--gutter-xxl) !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mb {
            margin-bottom: var(--gutter) !important;
        }

        .mb-xxs {
            margin-bottom: var(--gutter-xxs) !important;
        }

        .mb-xs {
            margin-bottom: var(--gutter-xs) !important;
        }

        .mb-sm {
            margin-bottom: var(--gutter-sm) !important;
        }

        .mb-md {
            margin-bottom: var(--gutter-md) !important;
        }

        .mb-lg {
            margin-bottom: var(--gutter-lg) !important;
        }

        .mb-xl {
            margin-bottom: var(--gutter-xl) !important;
        }

        .mb-xxl {
            margin-bottom: var(--gutter-xxl) !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .p {
            padding: var(--gutter) !important;
        }

        .p-xxs {
            padding: var(--gutter-xxs) !important;
        }

        .p-xs {
            padding: var(--gutter-xs) !important;
        }

        .p-sm {
            padding: var(--gutter-sm) !important;
        }

        .p-md {
            padding: var(--gutter-md) !important;
        }

        .p-lg {
            padding: var(--gutter-lg) !important;
        }

        .p-xl {
            padding: var(--gutter-xl) !important;
        }

        .p-xxl {
            padding: var(--gutter-xxl) !important;
        }

        .px-0 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .px {
            padding-left: var(--gutter) !important;
            padding-right: var(--gutter) !important;
        }

        .px-xxs {
            padding-left: var(--gutter-xxs) !important;
            padding-right: var(--gutter-xxs) !important;
        }

        .px-xs {
            padding-left: var(--gutter-xs) !important;
            padding-right: var(--gutter-xs) !important;
        }

        .px-sm {
            padding-left: var(--gutter-sm) !important;
            padding-right: var(--gutter-sm) !important;
        }

        .px-md {
            padding-left: var(--gutter-md) !important;
            padding-right: var(--gutter-md) !important;
        }

        .px-lg {
            padding-left: var(--gutter-lg) !important;
            padding-right: var(--gutter-lg) !important;
        }

        .px-xl {
            padding-left: var(--gutter-xl) !important;
            padding-right: var(--gutter-xl) !important;
        }

        .px-xxl {
            padding-left: var(--gutter-xxl) !important;
            padding-right: var(--gutter-xxl) !important;
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .py {
            padding-top: var(--gutter) !important;
            padding-bottom: var(--gutter) !important;
        }

        .py-xxs {
            padding-top: var(--gutter-xxs) !important;
            padding-bottom: var(--gutter-xxs) !important;
        }

        .py-xs {
            padding-top: var(--gutter-xs) !important;
            padding-bottom: var(--gutter-xs) !important;
        }

        .py-sm {
            padding-top: var(--gutter-sm) !important;
            padding-bottom: var(--gutter-sm) !important;
        }

        .py-md {
            padding-top: var(--gutter-md) !important;
            padding-bottom: var(--gutter-md) !important;
        }

        .py-lg {
            padding-top: var(--gutter-lg) !important;
            padding-bottom: var(--gutter-lg) !important;
        }

        .py-xl {
            padding-top: var(--gutter-xl) !important;
            padding-bottom: var(--gutter-xl) !important;
        }

        .py-xxl {
            padding-top: var(--gutter-xxl) !important;
            padding-bottom: var(--gutter-xxl) !important;
        }

        .ps-0 {
            padding-left: 0 !important;
        }

        .ps {
            padding-left: var(--gutter) !important;
        }

        .ps-xxs {
            padding-left: var(--gutter-xxs) !important;
        }

        .ps-xs {
            padding-left: var(--gutter-xs) !important;
        }

        .ps-sm {
            padding-left: var(--gutter-sm) !important;
        }

        .ps-md {
            padding-left: var(--gutter-md) !important;
        }

        .ps-lg {
            padding-left: var(--gutter-lg) !important;
        }

        .ps-xl {
            padding-left: var(--gutter-xl) !important;
        }

        .ps-xxl {
            padding-left: var(--gutter-xxl) !important;
        }

        .pe-0 {
            padding-right: 0 !important;
        }

        .pe {
            padding-right: var(--gutter) !important;
        }

        .pe-xxs {
            padding-right: var(--gutter-xxs) !important;
        }

        .pe-xs {
            padding-right: var(--gutter-xs) !important;
        }

        .pe-sm {
            padding-right: var(--gutter-sm) !important;
        }

        .pe-md {
            padding-right: var(--gutter-md) !important;
        }

        .pe-lg {
            padding-right: var(--gutter-lg) !important;
        }

        .pe-xl {
            padding-right: var(--gutter-xl) !important;
        }

        .pe-xxl {
            padding-right: var(--gutter-xxl) !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pt {
            padding-top: var(--gutter) !important;
        }

        .pt-xxs {
            padding-top: var(--gutter-xxs) !important;
        }

        .pt-xs {
            padding-top: var(--gutter-xs) !important;
        }

        .pt-sm {
            padding-top: var(--gutter-sm) !important;
        }

        .pt-md {
            padding-top: var(--gutter-md) !important;
        }

        .pt-lg {
            padding-top: var(--gutter-lg) !important;
        }

        .pt-xl {
            padding-top: var(--gutter-xl) !important;
        }

        .pt-xxl {
            padding-top: var(--gutter-xxl) !important;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .pb {
            padding-bottom: var(--gutter) !important;
        }

        .pb-xxs {
            padding-bottom: var(--gutter-xxs) !important;
        }

        .pb-xs {
            padding-bottom: var(--gutter-xs) !important;
        }

        .pb-sm {
            padding-bottom: var(--gutter-sm) !important;
        }

        .pb-md {
            padding-bottom: var(--gutter-md) !important;
        }

        .pb-lg {
            padding-bottom: var(--gutter-lg) !important;
        }

        .pb-xl {
            padding-bottom: var(--gutter-xl) !important;
        }

        .pb-xxl {
            padding-bottom: var(--gutter-xxl) !important;
        }

        .m-0-neg {
            margin: calc(0 * -1) !important;
        }

        .m-neg {
            margin: calc(var(--gutter) * -1) !important;
        }

        .m-xxs-neg {
            margin: calc(var(--gutter-xxs) * -1) !important;
        }

        .m-xs-neg {
            margin: calc(var(--gutter-xs) * -1) !important;
        }

        .m-sm-neg {
            margin: calc(var(--gutter-sm) * -1) !important;
        }

        .m-md-neg {
            margin: calc(var(--gutter-md) * -1) !important;
        }

        .m-lg-neg {
            margin: calc(var(--gutter-lg) * -1) !important;
        }

        .m-xl-neg {
            margin: calc(var(--gutter-xl) * -1) !important;
        }

        .m-xxl-neg {
            margin: calc(var(--gutter-xxl) * -1) !important;
        }

        .mx-0-neg {
            margin-left: calc(0 * -1) !important;
            margin-right: calc(0 * -1) !important;
        }

        .mx-neg {
            margin-left: calc(var(--gutter) * -1) !important;
            margin-right: calc(var(--gutter) * -1) !important;
        }

        .mx-xxs-neg {
            margin-left: calc(var(--gutter-xxs) * -1) !important;
            margin-right: calc(var(--gutter-xxs) * -1) !important;
        }

        .mx-xs-neg {
            margin-left: calc(var(--gutter-xs) * -1) !important;
            margin-right: calc(var(--gutter-xs) * -1) !important;
        }

        .mx-sm-neg {
            margin-left: calc(var(--gutter-sm) * -1) !important;
            margin-right: calc(var(--gutter-sm) * -1) !important;
        }

        .mx-md-neg {
            margin-left: calc(var(--gutter-md) * -1) !important;
            margin-right: calc(var(--gutter-md) * -1) !important;
        }

        .mx-lg-neg {
            margin-left: calc(var(--gutter-lg) * -1) !important;
            margin-right: calc(var(--gutter-lg) * -1) !important;
        }

        .mx-xl-neg {
            margin-left: calc(var(--gutter-xl) * -1) !important;
            margin-right: calc(var(--gutter-xl) * -1) !important;
        }

        .mx-xxl-neg {
            margin-left: calc(var(--gutter-xxl) * -1) !important;
            margin-right: calc(var(--gutter-xxl) * -1) !important;
        }

        .my-0-neg {
            margin-top: calc(0 * -1) !important;
            margin-bottom: calc(0 * -1) !important;
        }

        .my-neg {
            margin-top: calc(var(--gutter) * -1) !important;
            margin-bottom: calc(var(--gutter) * -1) !important;
        }

        .my-xxs-neg {
            margin-top: calc(var(--gutter-xxs) * -1) !important;
            margin-bottom: calc(var(--gutter-xxs) * -1) !important;
        }

        .my-xs-neg {
            margin-top: calc(var(--gutter-xs) * -1) !important;
            margin-bottom: calc(var(--gutter-xs) * -1) !important;
        }

        .my-sm-neg {
            margin-top: calc(var(--gutter-sm) * -1) !important;
            margin-bottom: calc(var(--gutter-sm) * -1) !important;
        }

        .my-md-neg {
            margin-top: calc(var(--gutter-md) * -1) !important;
            margin-bottom: calc(var(--gutter-md) * -1) !important;
        }

        .my-lg-neg {
            margin-top: calc(var(--gutter-lg) * -1) !important;
            margin-bottom: calc(var(--gutter-lg) * -1) !important;
        }

        .my-xl-neg {
            margin-top: calc(var(--gutter-xl) * -1) !important;
            margin-bottom: calc(var(--gutter-xl) * -1) !important;
        }

        .my-xxl-neg {
            margin-top: calc(var(--gutter-xxl) * -1) !important;
            margin-bottom: calc(var(--gutter-xxl) * -1) !important;
        }

        .ms-0-neg {
            margin-left: calc(0 * -1) !important;
        }

        .ms-neg {
            margin-left: calc(var(--gutter) * -1) !important;
        }

        .ms-xxs-neg {
            margin-left: calc(var(--gutter-xxs) * -1) !important;
        }

        .ms-xs-neg {
            margin-left: calc(var(--gutter-xs) * -1) !important;
        }

        .ms-sm-neg {
            margin-left: calc(var(--gutter-sm) * -1) !important;
        }

        .ms-md-neg {
            margin-left: calc(var(--gutter-md) * -1) !important;
        }

        .ms-lg-neg {
            margin-left: calc(var(--gutter-lg) * -1) !important;
        }

        .ms-xl-neg {
            margin-left: calc(var(--gutter-xl) * -1) !important;
        }

        .ms-xxl-neg {
            margin-left: calc(var(--gutter-xxl) * -1) !important;
        }

        .me-0-neg {
            margin-right: calc(0 * -1) !important;
        }

        .me-neg {
            margin-right: calc(var(--gutter) * -1) !important;
        }

        .me-xxs-neg {
            margin-right: calc(var(--gutter-xxs) * -1) !important;
        }

        .me-xs-neg {
            margin-right: calc(var(--gutter-xs) * -1) !important;
        }

        .me-sm-neg {
            margin-right: calc(var(--gutter-sm) * -1) !important;
        }

        .me-md-neg {
            margin-right: calc(var(--gutter-md) * -1) !important;
        }

        .me-lg-neg {
            margin-right: calc(var(--gutter-lg) * -1) !important;
        }

        .me-xl-neg {
            margin-right: calc(var(--gutter-xl) * -1) !important;
        }

        .me-xxl-neg {
            margin-right: calc(var(--gutter-xxl) * -1) !important;
        }

        .mt-0-neg {
            margin-top: calc(0 * -1) !important;
        }

        .mt-neg {
            margin-top: calc(var(--gutter) * -1) !important;
        }

        .mt-xxs-neg {
            margin-top: calc(var(--gutter-xxs) * -1) !important;
        }

        .mt-xs-neg {
            margin-top: calc(var(--gutter-xs) * -1) !important;
        }

        .mt-sm-neg {
            margin-top: calc(var(--gutter-sm) * -1) !important;
        }

        .mt-md-neg {
            margin-top: calc(var(--gutter-md) * -1) !important;
        }

        .mt-lg-neg {
            margin-top: calc(var(--gutter-lg) * -1) !important;
        }

        .mt-xl-neg {
            margin-top: calc(var(--gutter-xl) * -1) !important;
        }

        .mt-xxl-neg {
            margin-top: calc(var(--gutter-xxl) * -1) !important;
        }

        .mb-0-neg {
            margin-bottom: calc(0 * -1) !important;
        }

        .mb-neg {
            margin-bottom: calc(var(--gutter) * -1) !important;
        }

        .mb-xxs-neg {
            margin-bottom: calc(var(--gutter-xxs) * -1) !important;
        }

        .mb-xs-neg {
            margin-bottom: calc(var(--gutter-xs) * -1) !important;
        }

        .mb-sm-neg {
            margin-bottom: calc(var(--gutter-sm) * -1) !important;
        }

        .mb-md-neg {
            margin-bottom: calc(var(--gutter-md) * -1) !important;
        }

        .mb-lg-neg {
            margin-bottom: calc(var(--gutter-lg) * -1) !important;
        }

        .mb-xl-neg {
            margin-bottom: calc(var(--gutter-xl) * -1) !important;
        }

        .mb-xxl-neg {
            margin-bottom: calc(var(--gutter-xxl) * -1) !important;
        }

        .g-0 {
            --bs-gutter-x: 0;
            --bs-gutter-y: 0;
        }

        .gx-0 {
            --bs-gutter-x: 0;
        }

        .gy-0 {
            --bs-gutter-y: 0;
        }

        .gap-0 {
            gap: 0 !important;
        }

        .g {
            --bs-gutter-x: var(--gutter);
            --bs-gutter-y: var(--gutter);
        }

        .gx {
            --bs-gutter-x: var(--gutter);
        }

        .gy {
            --bs-gutter-y: var(--gutter);
        }

        .gap {
            gap: var(--gutter) !important;
        }

        .g-xxs {
            --bs-gutter-x: var(--gutter-xxs);
            --bs-gutter-y: var(--gutter-xxs);
        }

        .gx-xxs {
            --bs-gutter-x: var(--gutter-xxs);
        }

        .gy-xxs {
            --bs-gutter-y: var(--gutter-xxs);
        }

        .gap-xxs {
            gap: var(--gutter-xxs) !important;
        }

        .g-xs {
            --bs-gutter-x: var(--gutter-xs);
            --bs-gutter-y: var(--gutter-xs);
        }

        .gx-xs {
            --bs-gutter-x: var(--gutter-xs);
        }

        .gy-xs {
            --bs-gutter-y: var(--gutter-xs);
        }

        .gap-xs {
            gap: var(--gutter-xs) !important;
        }

        .g-sm {
            --bs-gutter-x: var(--gutter-sm);
            --bs-gutter-y: var(--gutter-sm);
        }

        .gx-sm {
            --bs-gutter-x: var(--gutter-sm);
        }

        .gy-sm {
            --bs-gutter-y: var(--gutter-sm);
        }

        .gap-sm {
            gap: var(--gutter-sm) !important;
        }

        .g-md {
            --bs-gutter-x: var(--gutter-md);
            --bs-gutter-y: var(--gutter-md);
        }

        .gx-md {
            --bs-gutter-x: var(--gutter-md);
        }

        .gy-md {
            --bs-gutter-y: var(--gutter-md);
        }

        .gap-md {
            gap: var(--gutter-md) !important;
        }

        .g-lg {
            --bs-gutter-x: var(--gutter-lg);
            --bs-gutter-y: var(--gutter-lg);
        }

        .gx-lg {
            --bs-gutter-x: var(--gutter-lg);
        }

        .gy-lg {
            --bs-gutter-y: var(--gutter-lg);
        }

        .gap-lg {
            gap: var(--gutter-lg) !important;
        }

        .g-xl {
            --bs-gutter-x: var(--gutter-xl);
            --bs-gutter-y: var(--gutter-xl);
        }

        .gx-xl {
            --bs-gutter-x: var(--gutter-xl);
        }

        .gy-xl {
            --bs-gutter-y: var(--gutter-xl);
        }

        .gap-xl {
            gap: var(--gutter-xl) !important;
        }

        .g-xxl {
            --bs-gutter-x: var(--gutter-xxl);
            --bs-gutter-y: var(--gutter-xxl);
        }

        .gx-xxl {
            --bs-gutter-x: var(--gutter-xxl);
        }

        .gy-xxl {
            --bs-gutter-y: var(--gutter-xxl);
        }

        .gap-xxl {
            gap: var(--gutter-xxl) !important;
        }

        .w-100 {
            width: 100% !important;
        }

        .w-fit {
            width: -moz-fit-content !important;
            width: fit-content !important;
        }

        .min-h-fit {
            min-height: -moz-fit-content !important;
            min-height: fit-content !important;
        }

        .d-none {
            display: none !important;
        }

        .d-none-after:after {
            display: none !important;
        }

        .d-flex {
            display: flex !important;
        }

        .op-0 {
            opacity: 0 !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .position-absolute {
            position: absolute !important;
        }

        .position-relative {
            position: relative !important;
        }

        .z-index-1 {
            z-index: 1 !important;
        }

        .top-0 {
            top: 0 !important;
        }

        .top {
            top: var(--gutter) !important;
        }

        .top-xxs {
            top: var(--gutter-xxs) !important;
        }

        .top-xs {
            top: var(--gutter-xs) !important;
        }

        .top-sm {
            top: var(--gutter-sm) !important;
        }

        .top-md {
            top: var(--gutter-md) !important;
        }

        .top-lg {
            top: var(--gutter-lg) !important;
        }

        .top-xl {
            top: var(--gutter-xl) !important;
        }

        .top-xxl {
            top: var(--gutter-xxl) !important;
        }

        .gap-0 {
            gap: 0 !important;
        }

        .gap-1 {
            gap: 0.25rem !important;
        }

        .gap-2 {
            gap: 0.5rem !important;
        }

        .gap-3 {
            gap: 1rem !important;
        }

        .gap-4 {
            gap: 1.5rem !important;
        }

        .gap-5 {
            gap: 3rem !important;
        }

        .z-index-1-neg {
            z-index: -1;
        }

        .z-index-10 {
            z-index: 10;
        }

        .form-logo {
            width: 140px;
            opacity: 0.15;
            height: auto;
        }

        .page-form {
            background-repeat: repeat-x !important;
        }
        .page-form .progressbar {
            display: flex;
            flex-direction: row-reverse;
            align-items: stretch;
            height: 5px;
            gap: 5px;
            margin-bottom: 20px;
        }
        .page-form .progressbar > div {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
        }
        .page-form .progressbar > div.active {
            flex: 1;
            background: rgba(255, 255, 255, 0.5);
        }
        .page-form .footer {
            display: block;
            flex-direction: row-reverse;
            align-items: stretch;
            height: 5px;
            gap: 5px;
            margin: 20px 0;
        }
        .page-form .footer #btn-next,
        .page-form .footer #btn-prev {
            padding: 5px 10px;
            min-width: 60px;
            margin: 0;
            float: right;
            direction: ltr;
            background: rgba(255, 255, 255, 0.1);
            border: 0;
            gap: 3px;
        }
        .page-form .footer #btn-next {
            border-radius: 0 5px 5px 0;
            margin-left: 1px;
            padding-left: 14px;
        }
        .page-form .footer #btn-prev {
            border-radius: 5px;
            padding-right: 20px;
        }
        .page-form .footer button.disable {
            display: none;
        }
        .page-form .footer button.rounded {
            border-radius: 5px !important;
        }
        .page-form .step {
            display: none;
        }
        .page-form .step.expanded {
            display: flex;
            flex-direction: column;
            gap: var(--gutter-xxs);
        }
        .page-form .qLabel {
            color: #ffffff;
            text-align: right;
            font-size: 20px;
            font-weight: 600 !important;
            margin-bottom: 20px;
        }
        .page-form .qOption {
            width: 100% !important;
            position: relative;
            color: var(--secondary);
            background: white;
            border-radius: var(--btn-radius);
            height: var(--input-height-sm);
            padding: var(--input-padding);
            font-size: var(--btn-font-size);
            line-height: var(--btn-line-height);
            font-weight: var(--btn-font-weight);
            width: -moz-fit-content;
            width: fit-content;
            max-width: 100%;
            display: inline-flex;
            align-items: center;
            gap: var(--btn-gap);
            vertical-align: middle;
            transition: all ease-in-out 0.15s;
            cursor: pointer;
        }
        .page-form .qOption input[type=checkbox],
        .page-form .qOption input[type=radio] {
            outline: solid 1px white;
            transition: all ease-in-out 0.15s;
        }
        .page-form .qOption:hover {
            color: var(--primary);
        }
        .page-form .qOption:hover input[type=checkbox],
        .page-form .qOption:hover input[type=radio] {
            border-color: var(--primary);
            outline-color: var(--primary);
        }
        @keyframes blinker {
            0% {
                background: rgb(255, 255, 255);
            }
            30% {
                background: rgba(255, 255, 255, 0.5);
            }
            100% {
                background: rgb(255, 255, 255);
            }
        }
        .page-form .m-submit {
            display: flex !important;
        }
        .page-form #msg {
            display: none;
            position: fixed;
            top: 10px;
            bottom: 10px;
            left: 10px;
            right: 10px;
            text-align: center;
            z-index: 999;
            font-size: 24px;
            padding: 10% 12%;
        }

        input,
        textarea,
        select,
        .input-group,
        .input-group > *,
        label {
            outline: none;
            border: none;
            font-weight: var(--input-font-weight);
            font-size: var(--input-font-size);
            line-height: var(--input-line-height);
        }

        input[type=password] {
            padding-top: 0 !important;
        }

        input.sm,
        textarea.sm,
        select.sm,
        .input-group.sm,
        .input-group.sm > *,
        label.sm {
            font-weight: var(--input-font-weight-sm);
            font-size: var(--input-font-size-sm);
        }

        select.sm,
        .input-group.sm select {
            background-position-y: var(--select-icon-position-y-sm);
        }

        .input,
        textarea,
        select,
        .input-group,
        input:not(input[type=radio], input[type=checkbox]) {
            width: 100%;
            border: solid 1px var(--input-border);
            border-radius: var(--input-radius);
            height: var(--input-height);
            background-color: var(--input-bg);
            color: var(--base-color);
            padding: var(--input-padding);
        }
        .input.rounded,
        textarea.rounded,
        select.rounded,
        .input-group.rounded,
        input:not(input[type=radio], input[type=checkbox]).rounded {
            --input-radius: calc(var(--input-rounded-radius) / 2);
        }
        .input.solid,
        textarea.solid,
        select.solid,
        .input-group.solid,
        input:not(input[type=radio], input[type=checkbox]).solid {
            border-width: 0;
            --input-border: transparent;
            --input-group-child-border: transparent;
        }
        .input.sm,
        textarea.sm,
        select.sm,
        .input-group.sm,
        input:not(input[type=radio], input[type=checkbox]).sm {
            height: var(--input-height-sm);
        }
        .input.sm button.circle,
        .input.sm .btn.circle,
        textarea.sm button.circle,
        textarea.sm .btn.circle,
        select.sm button.circle,
        select.sm .btn.circle,
        .input-group.sm button.circle,
        .input-group.sm .btn.circle,
        input:not(input[type=radio], input[type=checkbox]).sm button.circle,
        input:not(input[type=radio], input[type=checkbox]).sm .btn.circle {
            width: var(--input-height-sm);
            max-width: var(--input-height-sm) !important;
        }

        .input,
        .input-group,
        label {
            padding: 0;
            position: relative;
            display: inline-flex;
            align-items: center;
            outline: none;
        }

        .input {
            background-color: var(--input-bg);
            gap: 8px;
        }
        .input.textarea {
            height: inherit;
        }
        .input.textarea textarea {
            border: none !important;
            outline: none !important;
        }
        .input.textarea.rounded {
            --input-radius: calc(var(--input-rounded-radius) / 2.5);
        }
        .input > *:not([class^=btn-],
button,
.btn,
input[type=checkbox],
input[type=radio]) {
            max-width: 100%;
            text-align: right;
            flex-grow: 1;
            background: transparent;
            border: none !important;
        }
        .input > [class^=btn-],
        .input [class*=" btn-"],
        .input button,
        .input .btn {
            margin: 4px;
            height: calc(100% - 8px);
        }
        .input label {
            cursor: initial;
            position: absolute;
            top: 7px;
            right: calc(var(--input-padding-single) / 2);
            padding: 0 calc(var(--input-padding-single) / 2);
            width: -moz-fit-content;
            width: fit-content;
            transform-origin: bottom right;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .input label i,
        .input label .icon {
            font-size: 18px;
        }
        .input label:before {
            content: "";
            position: absolute;
            background-color: var(--input-bg);
            height: calc(75% + 2px);
            right: 0;
            left: 0;
            bottom: 0;
            z-index: -1;
        }
        .input.focus {
            border-color: var(--input-theme-focus);
            outline-color: var(--input-theme-focus);
        }
        .input.focus label {
            color: var(--input-theme-focus);
        }
        .input.focus label, .input.not_empty label {
            transform: scale(0.8) translateY(-32px);
        }
        .input.not_empty label {
            transition: none;
        }
        .input.ltr {
            direction: ltr !important;
            text-align: left !important;
        }
        .input.ltr label {
            right: inherit;
            left: 8px;
            transform-origin: left;
        }
        .input.ltr > * {
            direction: ltr !important;
            text-align: left !important;
        }
        .input input[type=color] {
            border: none !important;
            padding: 0 !important;
            border-radius: var(--input-radius) !important;
            overflow: hidden;
            height: 100% !important;
        }
        .input ::-moz-color-swatch {
            border-color: transparent;
        }
        .input input,
        .input select,
        .input textarea {
            background: transparent !important;
        }

        .input > *:not(label),
        .input-group > *:not([class^=btn-], [class*=" btn-"], .btn, button),
        textarea {
            padding: var(--input-padding);
            height: 100%;
            position: relative;
            z-index: 2;
        }

        input[type=checkbox], input[type=radio] {
            flex-shrink: 0 !important;
            flex-grow: 0 !important;
            padding: 0 !important;
            border-radius: var(--input-radius);
            width: 18px;
            height: 18px;
            background-color: white;
            background-repeat: no-repeat;
            background-position: center;
            border: solid 1px var(--input-clickable-border);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
        }
        input[type=checkbox]:checked, input[type=radio]:checked {
            background-color: var(--input-theme-focus);
            border-color: var(--input-theme-focus);
        }
        input[type=checkbox]:checked ~ i, input[type=radio]:checked ~ i {
            color: var(--input-theme-focus);
        }
        input[type=checkbox]:checked ~ .show-after-check, input[type=radio]:checked ~ .show-after-check {
            display: inherit;
        }
        input[type=checkbox].success:checked, input[type=radio].success:checked {
            background-color: var(--success) !important;
            border-color: var(--success) !important;
        }
        input[type=checkbox].lg, input[type=radio].lg {
            width: 22px;
            height: 22px;
        }
        input[type=checkbox] {
            background-image: url("https://up.7learn.com/1/img/icon/form/form_checkbox.svg") !important;
            background-size: 0;
        }
        input[type=checkbox]:checked {
            background-size: 100%;
        }
        input[type=radio] {
            border-radius: 50%;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_radio.svg") !important;
        }
        input.switch {
            height: 21px;
            width: 35px;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_switch.svg") !important;
            background-size: contain !important;
            border-radius: var(--input-switch-radius);
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            background-position: left center;
        }
        input.switch:checked {
            background-position: right center;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_switch_active.svg") !important;
        }

        label {
            gap: 14px;
            width: -moz-fit-content;
            width: fit-content;
            cursor: text;
        }
        label i {
            font-size: 20px;
        }
        label[for] {
            cursor: pointer;
        }
        label[for]:hover {
            color: var(--secondary-70);
        }
        label.checked-fill {
            cursor: pointer;
        }
        label.checked-fill:hover {
            opacity: 0.75;
        }
        label.checked-fill input:not(:checked) + .title {
            color: var(--secondary-60);
        }
        label.btn-input {
            position: relative;
            border: none;
        }
        label.btn-input > *:not(.bg, input) {
            position: relative;
            z-index: 1;
        }
        label.btn-input input {
            cursor: pointer;
            position: absolute !important;
            inset: 0 !important;
            width: 100% !important;
            height: 100% !important;
            border-radius: var(--input-radius) !important;
            background: none !important;
            border-color: transparent;
        }
        label.btn-input input:checked {
            border: solid 1px var(--success);
        }
        label.btn-input input:checked:before {
            border-radius: var(--input-radius) !important;
            position: absolute;
            content: "";
            inset: 0;
            width: 100%;
            height: 100%;
            background: white !important;
        }
        label.btn-input input:checked:after {
            position: absolute;
            content: "\e961";
            font-family: "sl-icon";
            color: var(--success);
            font-size: 12px;
            right: 2px;
            top: 2px;
            height: 12px;
            width: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        select {
            padding-left: var(--select-padding-start) !important;
            background-color: var(--input-bg);
            -moz-appearance: none;
            -webkit-appearance: none;
            background-repeat: no-repeat;
            background-size: 20px;
            background-position-x: 20px;
            background-position-y: var(--select-icon-position-y);
            appearance: none;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_select.svg");
        }

        textarea {
            line-height: var(--textarea-line-height);
            padding-top: calc(var(--input-padding-single) * 0.5) !important;
            padding-bottom: calc(var(--input-padding-single) * 0.5) !important;
        }

        .input-group {
            flex-wrap: wrap;
            align-items: stretch;
            background-color: var(--input-bg);
        }
        .input-group > * {
            background-color: var(--input-bg);
        }
        .input-group input[type=color] {
            padding: 0;
        }
        .input-group > *:not(.badge, [class^=badge-], [class*=" badge-"]) {
            border: none !important;
            border-left: solid 1px var(--input-group-child-border) !important;
            height: 100% !important;
            border-radius: 0 !important;
        }
        .input-group > *:not(.badge, [class^=badge-], [class*=" badge-"]):not(label, input[type=radio], input[type=checkbox]), .input-group > *:not(.badge, [class^=badge-], [class*=" badge-"]).full {
            flex: 1 1 auto;
            width: 1% !important;
            min-width: 0;
        }
        .input-group > *:not(.badge, [class^=badge-], [class*=" badge-"]).bs-0 {
            border-left: 0 !important;
        }
        .input-group > *:not(.badge, [class^=badge-], [class*=" badge-"]).full {
            max-width: inherit !important;
        }
        .input-group .badge,
        .input-group [class^=badge-],
        .input-group [class*=" badge-"] {
            height: calc(100% - 12px);
            margin: 6px;
        }
        .input-group > label:not([class^=btn-], [class*=" btn-"], button, .btn) {
            cursor: initial;
            min-width: 130px;
            background: var(--input-group-label-bg);
        }
        .input-group [class^=btn-],
        .input-group [class*=" btn-"],
        .input-group button,
        .input-group .btn,
        .input-group select {
            max-width: -moz-fit-content;
            max-width: fit-content;
        }
        .input-group > :first-child:not(.badge, [class^=badge-], [class*=" badge-"]) {
            border-radius: 0 var(--input-radius) var(--input-radius) 0 !important;
        }
        .input-group > :last-child:not(.badge, [class^=badge-], [class*=" badge-"]) {
            border-radius: var(--input-radius) 0 0 var(--input-radius) !important;
        }
        .input-group > :last-child {
            border-left: none !important;
        }
        .input-group > input[type=range] {
            padding: 0 !important;
            margin: var(--input-padding);
        }
        .input-group.primary {
            border-color: var(--primary-10) !important;
        }
        .input-group.primary > * {
            border-left-color: var(--primary-5) !important;
        }
        .input-group > i.icon {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: var(--input-group-icon-size);
        }

        input[type=range] {
            direction: ltr;
        }

        .input-group.ltr select,
        select.ltr {
            padding-left: var(--input-padding-single) !important;
            padding-right: 40px !important;
            background-position-x: calc(100% - 18px);
        }

        input.jump-next-input {
            font-size: 24px;
            letter-spacing: -3px;
            padding: 6px 0 0 0 !important;
            text-align: center !important;
        }
        input.jump-next-input::-moz-placeholder {
            font-weight: 200;
        }
        input.jump-next-input::placeholder {
            font-weight: 200;
        }

        .input-stable {
            --input-height: var(--input-height-stable);
            --input-font-size: var(--input-font-size-stable);
            --input-line-height: var(--input-line-height-stable);
            --input-font-weight: var(--input-font-weight-stable);
            --input-group-icon-size: var(--input-group-icon-size-stable);
            --textarea-line-height: var(--textarea-line-height-stable);
            --select-icon-position-y: var(--select-icon-position-y-stable);
        }

        .card-checked {
            --card-checked-theme: white;
            --card-checked-space: calc(var(--base-gutter) * 1.5);
            --card-checked-checkbox-space: 20px;
            position: relative;
            padding: var(--card-checked-space);
            padding-right: calc(var(--card-checked-space) + var(--card-checked-checkbox-space) * 2);
            display: flex;
            align-items: center;
            z-index: 1;
            overflow: hidden;
        }
        .card-checked input.hide {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            border-radius: 4px;
            cursor: pointer;
            background-image: none !important;
            border: solid 2px var(--card-checked-theme);
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            background: transparent;
        }
        .card-checked input.hide:before {
            content: "";
            position: absolute;
            right: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: var(--card-checked-theme);
            opacity: 0.1;
        }
        .card-checked input.hide:after {
            content: "";
            position: absolute;
            right: var(--card-checked-space);
            top: calc(50% - var(--card-checked-checkbox-space) / 2);
            border-radius: 4px;
            width: var(--card-checked-checkbox-space);
            height: var(--card-checked-checkbox-space);
            border: solid 1px var(--secondary-30);
            background-size: 0;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_checkbox_black.svg") !important;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            background-repeat: no-repeat;
            background-position: center;
        }
        .card-checked input.hide:hover {
            --card-checked-theme: var(--primary);
        }
        .card-checked input.hide:hover:after {
            border-color: var(--secondary);
            outline: solid 1px var(--secondary);
        }
        .card-checked input.hide:checked {
            --card-checked-theme: var(--success);
        }
        .card-checked input.hide:checked:after {
            background-size: 90%;
            border-color: var(--secondary);
        }
        .card-checked input.hide:not(:checked, :hover):before {
            opacity: 1;
        }
        .card-checked .text {
            font-size: 16px;
            line-height: 28px;
            font-weight: 500;
            width: calc(100% - 80px);
        }
        .card-checked.sm {
            --card-checked-checkbox-space: 16px;
            --card-checked-space: calc(var(--base-gutter) * 0.75);
        }
        .card-checked.sm .text {
            font-size: 15px;
            line-height: 26px;
        }

        .checkbox-demo {
            --card-checked-theme: white;
            --card-checked-space: calc(var(--base-gutter) * 1.5);
            --card-checked-checkbox-space: 20px;
            position: relative;
            border-radius: 4px;
            width: var(--card-checked-checkbox-space);
            height: var(--card-checked-checkbox-space);
            border: solid 1px var(--secondary-30);
            background-color: var(--card-checked-theme);
            background-size: 0;
            background-image: url("https://up.7learn.com/1/img/icon/form/form_checkbox.svg") !important;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            background-repeat: no-repeat;
            background-position: center;
            display: inline-flex;
        }
        .checkbox-demo.checked {
            --card-checked-theme: var(--secondary-30);
            background-size: 90%;
            border-color: var(--secondary-30);
        }
        .checkbox-demo.correct {
            --card-checked-theme: var(--success);
            background-size: 90%;
            border-color: var(--success);
        }
        .checkbox-demo.wrong {
            --card-checked-theme: var(--danger);
            border-color: var(--danger);
        }
        .checkbox-demo.sm {
            --card-checked-checkbox-space: 18px;
            --card-checked-space: calc(var(--base-gutter) * 0.55);
        }

        input.dark {
            --input-bg: rgba(255, 255, 255, 0.2);
            --input-border: rgba(255, 255, 255, 0.2);
            --base-color: white;
        }
        input.dark::-moz-placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        input.dark::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        button,
        .btn {
            position: relative;
            color: var(--btn-color);
            border: 1px solid var(--btn-border);
            background: var(--btn-bg);
            border-radius: var(--btn-radius);
            padding: var(--btn-padding);
            font-size: var(--btn-font-size);
            line-height: var(--btn-line-height);
            font-weight: var(--btn-font-weight);
            width: -moz-fit-content;
            width: fit-content;
            max-width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--btn-gap);
            vertical-align: middle;
            cursor: pointer;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            transition: var(--btn-transition);
        }
        button:hover,
        .btn:hover {
            color: var(--btn-color-hover) !important;
            background: var(--btn-bg-hover) !important;
            border-color: var(--btn-border-hover) !important;
            --spinner-color: var(--btn-color-hover) !important;
        }
        button:focus, button:active, button.active,
        .btn:focus,
        .btn:active,
        .btn.active {
            color: var(--btn-color-focus) !important;
            background: var(--btn-bg-focus) !important;
            border-color: var(--btn-border-focus) !important;
            --spinner-color: var(--btn-color-focus) !important;
        }
        button.transparent,
        .btn.transparent {
            --btn-bg: transparent !important;
            --btn-bg-hover: transparent !important;
            --btn-bg-focus: transparent !important;
            --btn-border: transparent !important;
            --btn-border-hover: transparent !important;
            --btn-border-focus: transparent !important;
            --btn-color: var(--secondary-60) !important;
        }
        button.transparent i,
        .btn.transparent i {
            color: var(--secondary-40);
        }
        button.transparent:hover i,
        .btn.transparent:hover i {
            color: var(--btn-color-hover);
        }
        button.transparent:focus i,
        .btn.transparent:focus i {
            color: var(--btn-color-focus);
        }
        button.transparent-primary,
        .btn.transparent-primary {
            --btn-bg: transparent !important;
            --btn-bg-hover: var(--primary) !important;
            --btn-bg-focus: var(--primary-70) !important;
            --btn-border: transparent !important;
            --btn-border-hover: var(--primary) !important;
            --btn-border-focus: var(--primary-70) !important;
            --btn-color: var(--primary) !important;
            --btn-color-hover: white !important;
            --btn-color-focus: white !important;
        }
        button i,
        button .icon,
        .btn i,
        .btn .icon {
            font-size: var(--btn-icon-font-size);
            width: var(--btn-icon-font-size);
            height: var(--btn-icon-font-size);
        }
        button.xs,
        .btn.xs {
            padding: var(--btn-padding-xs);
            font-size: var(--btn-font-size-xs);
            line-height: var(--btn-line-height-xs);
            font-weight: var(--btn-font-weight-xs);
            gap: var(--btn-gap-xs);
        }
        button.xs i,
        button.xs .icon,
        .btn.xs i,
        .btn.xs .icon {
            font-size: var(--btn-icon-font-size-xs);
            width: var(--btn-icon-font-size-xs);
            height: var(--btn-icon-font-size-xs);
        }
        button.sm,
        .btn.sm {
            padding: var(--btn-padding-sm);
            font-size: var(--btn-font-size-sm);
            line-height: var(--btn-line-height-sm);
            font-weight: var(--btn-font-weight-sm);
            gap: var(--btn-gap-sm);
        }
        button.sm i,
        button.sm .icon,
        .btn.sm i,
        .btn.sm .icon {
            font-size: var(--btn-icon-font-size-sm);
            width: var(--btn-icon-font-size-sm);
            height: var(--btn-icon-font-size-sm);
        }
        button.lg,
        .btn.lg {
            padding: var(--btn-padding-lg);
            font-size: var(--btn-font-size-lg);
            line-height: var(--btn-line-height-lg);
            font-weight: var(--btn-font-weight-lg);
            gap: var(--btn-gap-lg);
        }
        button.lg i,
        button.lg .icon,
        .btn.lg i,
        .btn.lg .icon {
            font-size: var(--btn-icon-font-size-lg);
            width: var(--btn-icon-font-size-lg);
            height: var(--btn-icon-font-size-lg);
        }
        button.circle, button.icon, button.square,
        .btn.circle,
        .btn.icon,
        .btn.square {
            width: var(--btn-circle-size);
            height: var(--btn-circle-size);
            padding: 0;
        }
        button.circle:not(.max-w-fit), button.icon:not(.max-w-fit), button.square:not(.max-w-fit),
        .btn.circle:not(.max-w-fit),
        .btn.icon:not(.max-w-fit),
        .btn.square:not(.max-w-fit) {
            max-width: var(--btn-circle-size) !important;
        }
        button.circle:not(.max-w-fit).xs, button.icon:not(.max-w-fit).xs, button.square:not(.max-w-fit).xs,
        .btn.circle:not(.max-w-fit).xs,
        .btn.icon:not(.max-w-fit).xs,
        .btn.square:not(.max-w-fit).xs {
            max-width: var(--btn-circle-size-xs) !important;
        }
        button.circle:not(.max-w-fit).sm, button.icon:not(.max-w-fit).sm, button.square:not(.max-w-fit).sm,
        .btn.circle:not(.max-w-fit).sm,
        .btn.icon:not(.max-w-fit).sm,
        .btn.square:not(.max-w-fit).sm {
            max-width: var(--btn-circle-size-sm) !important;
        }
        button.circle:not(.max-w-fit).lg, button.icon:not(.max-w-fit).lg, button.square:not(.max-w-fit).lg,
        .btn.circle:not(.max-w-fit).lg,
        .btn.icon:not(.max-w-fit).lg,
        .btn.square:not(.max-w-fit).lg {
            max-width: var(--btn-circle-size-lg) !important;
        }
        button.circle i, button.icon i, button.square i,
        .btn.circle i,
        .btn.icon i,
        .btn.square i {
            font-size: var(--btn-circle-font-size);
        }
        button.circle.xs, button.icon.xs, button.square.xs,
        .btn.circle.xs,
        .btn.icon.xs,
        .btn.square.xs {
            width: var(--btn-circle-size-xs);
            height: var(--btn-circle-size-xs);
        }
        button.circle.xs i, button.icon.xs i, button.square.xs i,
        .btn.circle.xs i,
        .btn.icon.xs i,
        .btn.square.xs i {
            font-size: var(--btn-circle-font-size-xs);
        }
        button.circle.sm, button.icon.sm, button.square.sm,
        .btn.circle.sm,
        .btn.icon.sm,
        .btn.square.sm {
            width: var(--btn-circle-size-sm);
            height: var(--btn-circle-size-sm);
        }
        button.circle.sm i, button.icon.sm i, button.square.sm i,
        .btn.circle.sm i,
        .btn.icon.sm i,
        .btn.square.sm i {
            font-size: var(--btn-circle-font-size-sm);
        }
        button.circle:not(.square, .like), button.icon:not(.square, .like), button.square:not(.square, .like),
        .btn.circle:not(.square, .like),
        .btn.icon:not(.square, .like),
        .btn.square:not(.square, .like) {
            border-radius: var(--btn-circle-radius);
        }
        button.icon.sm i,
        .btn.icon.sm i {
            font-size: var(--btn-circle-font-size);
        }
        button.rounded,
        .btn.rounded {
            border-radius: var(--btn-rounded-radius);
        }
        button.white,
        .btn.white {
            --btn-color: var(--secondary);
            --btn-bg: white;
            --btn-border: white;
        }
        button.white-glass,
        .btn.white-glass {
            --btn-color: var(--secondary);
            --btn-bg: rgba(255, 255, 255, 0.5);
            --btn-border: rgba(255, 255, 255, 0.5);
            --btn-color-hover: var(--secondary);
            --btn-bg-hover: rgba(255, 255, 255, 0.7);
            --btn-border-hover: var(--secondary);
            --btn-color-focus: var(--secondary);
            --btn-bg-focus: rgba(255, 255, 255, 1);
            --btn-border-focus: var(--secondary);
        }
        button.gray,
        .btn.gray {
            --btn-color: var(--secondary);
            --btn-bg: var(--secondary-7);
            --btn-border: var(--secondary-7);
        }
        button.light-gray,
        .btn.light-gray {
            --btn-color: var(--secondary-60);
            --btn-bg: var(--secondary-7);
            --btn-border: var(--secondary-7);
        }
        button.white-gray,
        .btn.white-gray {
            --btn-color: var(--secondary-60);
            --btn-bg: white;
            --btn-border: white;
        }
        button.light-primary,
        .btn.light-primary {
            --btn-color: var(--primary-60);
            --btn-bg: var(--primary-7);
            --btn-border: var(--primary-7);
        }
        button.primary,
        .btn.primary {
            --primary-btn-border: var(--primary);
            --primary-btn-color: white;
            --primary-btn-bg: var(--primary);
            --primary-btn-bg-hover: white;
            --primary-btn-bg-focus: var(--primary-5);
            --primary-btn-border-hover: var(--primary);
            --primary-btn-border-focus: var(--primary);
            --primary-btn-color-hover: var(--primary);
            --btn-bg: var(--primary-btn-bg);
            --btn-bg-hover: var(--primary-btn-bg-hover);
            --btn-bg-focus: var(--primary-btn-bg-focus);
            --btn-color: var(--primary-btn-color);
            --btn-color-hover: var(--primary-btn-color-hover);
            --btn-color-focus: var(--primary-btn-color-focus);
            --btn-border: var(--primary-btn-border);
            --btn-border-hover: var(--primary-btn-border-hover);
            --btn-border-focus: var(--primary-btn-border-focus);
        }
        button.outline-primary,
        .btn.outline-primary {
            --primary-btn-outline-bg: white;
            --primary-btn-outline-bg-hover: var(--primary);
            --primary-btn-outline-bg-focus: var(--primary-90);
            --primary-btn-outline-color: var(--primary);
            --primary-btn-outline-color-hover: white;
            --primary-btn-outline-color-focus: white;
            --primary-btn-outline-border: var(--primary);
            --primary-btn-outline-border-hover: var(--primary);
            --primary-btn-outline-border-focus: var(--primary);
            --btn-bg: var(--primary-btn-outline-bg);
            --btn-bg-hover: var(--primary-btn-outline-bg-hover);
            --btn-bg-focus: var(--primary-btn-outline-bg-focus);
            --btn-color: var(--primary-btn-outline-color);
            --btn-color-hover: var(--primary-btn-outline-color-hover);
            --btn-color-focus: var(--primary-btn-outline-color-focus);
            --btn-border: var(--primary-btn-outline-border);
            --btn-border-hover: var(--primary-btn-outline-border-hover);
            --btn-border-focus: var(--primary-btn-outline-border-focus);
        }
        button.secondary,
        .btn.secondary {
            --secondary-btn-border: var(--secondary);
            --secondary-btn-color: white;
            --secondary-btn-bg: var(--secondary);
            --secondary-btn-bg-hover: white;
            --secondary-btn-bg-focus: var(--secondary-5);
            --secondary-btn-border-hover: var(--secondary);
            --secondary-btn-border-focus: var(--secondary);
            --secondary-btn-color-hover: var(--secondary);
            --btn-bg: var(--secondary-btn-bg);
            --btn-bg-hover: var(--secondary-btn-bg-hover);
            --btn-bg-focus: var(--secondary-btn-bg-focus);
            --btn-color: var(--secondary-btn-color);
            --btn-color-hover: var(--secondary-btn-color-hover);
            --btn-color-focus: var(--secondary-btn-color-focus);
            --btn-border: var(--secondary-btn-border);
            --btn-border-hover: var(--secondary-btn-border-hover);
            --btn-border-focus: var(--secondary-btn-border-focus);
        }
        button.outline-secondary,
        .btn.outline-secondary {
            --secondary-btn-outline-bg: white;
            --secondary-btn-outline-bg-hover: var(--secondary);
            --secondary-btn-outline-bg-focus: var(--secondary-90);
            --secondary-btn-outline-color: var(--secondary);
            --secondary-btn-outline-color-hover: white;
            --secondary-btn-outline-color-focus: white;
            --secondary-btn-outline-border: var(--secondary);
            --secondary-btn-outline-border-hover: var(--secondary);
            --secondary-btn-outline-border-focus: var(--secondary);
            --btn-bg: var(--secondary-btn-outline-bg);
            --btn-bg-hover: var(--secondary-btn-outline-bg-hover);
            --btn-bg-focus: var(--secondary-btn-outline-bg-focus);
            --btn-color: var(--secondary-btn-outline-color);
            --btn-color-hover: var(--secondary-btn-outline-color-hover);
            --btn-color-focus: var(--secondary-btn-outline-color-focus);
            --btn-border: var(--secondary-btn-outline-border);
            --btn-border-hover: var(--secondary-btn-outline-border-hover);
            --btn-border-focus: var(--secondary-btn-outline-border-focus);
        }
        button.success,
        .btn.success {
            --success-btn-border: var(--success);
            --success-btn-color: white;
            --success-btn-bg: var(--success);
            --success-btn-bg-hover: white;
            --success-btn-bg-focus: var(--success-5);
            --success-btn-border-hover: var(--success);
            --success-btn-border-focus: var(--success);
            --success-btn-color-hover: var(--success);
            --btn-bg: var(--success-btn-bg);
            --btn-bg-hover: var(--success-btn-bg-hover);
            --btn-bg-focus: var(--success-btn-bg-focus);
            --btn-color: var(--success-btn-color);
            --btn-color-hover: var(--success-btn-color-hover);
            --btn-color-focus: var(--success-btn-color-focus);
            --btn-border: var(--success-btn-border);
            --btn-border-hover: var(--success-btn-border-hover);
            --btn-border-focus: var(--success-btn-border-focus);
        }
        button.outline-success,
        .btn.outline-success {
            --success-btn-outline-bg: white;
            --success-btn-outline-bg-hover: var(--success);
            --success-btn-outline-bg-focus: var(--success-90);
            --success-btn-outline-color: var(--success);
            --success-btn-outline-color-hover: white;
            --success-btn-outline-color-focus: white;
            --success-btn-outline-border: var(--success);
            --success-btn-outline-border-hover: var(--success);
            --success-btn-outline-border-focus: var(--success);
            --btn-bg: var(--success-btn-outline-bg);
            --btn-bg-hover: var(--success-btn-outline-bg-hover);
            --btn-bg-focus: var(--success-btn-outline-bg-focus);
            --btn-color: var(--success-btn-outline-color);
            --btn-color-hover: var(--success-btn-outline-color-hover);
            --btn-color-focus: var(--success-btn-outline-color-focus);
            --btn-border: var(--success-btn-outline-border);
            --btn-border-hover: var(--success-btn-outline-border-hover);
            --btn-border-focus: var(--success-btn-outline-border-focus);
        }
        button.warning,
        .btn.warning {
            --warning-btn-border: var(--warning);
            --warning-btn-color: var(--secondary);
            --warning-btn-bg: var(--warning);
            --warning-btn-bg-hover: white;
            --warning-btn-bg-focus: var(--warning-5);
            --warning-btn-border-hover: var(--warning);
            --warning-btn-border-focus: var(--warning);
            --warning-btn-color-hover: #3c4043;
            --btn-bg: var(--warning-btn-bg);
            --btn-bg-hover: var(--warning-btn-bg-hover);
            --btn-bg-focus: var(--warning-btn-bg-focus);
            --btn-color: var(--warning-btn-color);
            --btn-color-hover: var(--warning-btn-color-hover);
            --btn-color-focus: var(--warning-btn-color-focus);
            --btn-border: var(--warning-btn-border);
            --btn-border-hover: var(--warning-btn-border-hover);
            --btn-border-focus: var(--warning-btn-border-focus);
        }
        button.outline-warning,
        .btn.outline-warning {
            --warning-btn-outline-bg: white;
            --warning-btn-outline-bg-hover: var(--warning);
            --warning-btn-outline-bg-focus: var(--warning-90);
            --warning-btn-outline-color: var(--warning);
            --warning-btn-outline-color-hover: white;
            --warning-btn-outline-color-focus: white;
            --warning-btn-outline-border: var(--warning);
            --warning-btn-outline-border-hover: var(--warning);
            --warning-btn-outline-border-focus: var(--warning);
            --btn-bg: var(--warning-btn-outline-bg);
            --btn-bg-hover: var(--warning-btn-outline-bg-hover);
            --btn-bg-focus: var(--warning-btn-outline-bg-focus);
            --btn-color: var(--warning-btn-outline-color);
            --btn-color-hover: var(--warning-btn-outline-color-hover);
            --btn-color-focus: var(--warning-btn-outline-color-focus);
            --btn-border: var(--warning-btn-outline-border);
            --btn-border-hover: var(--warning-btn-outline-border-hover);
            --btn-border-focus: var(--warning-btn-outline-border-focus);
        }
        button.danger,
        .btn.danger {
            --danger-btn-border: var(--danger);
            --danger-btn-color: white;
            --danger-btn-bg: var(--danger);
            --danger-btn-bg-hover: white;
            --danger-btn-bg-focus: var(--danger-5);
            --danger-btn-border-hover: var(--danger);
            --danger-btn-border-focus: var(--danger);
            --danger-btn-color-hover: var(--danger);
            --btn-bg: var(--danger-btn-bg);
            --btn-bg-hover: var(--danger-btn-bg-hover);
            --btn-bg-focus: var(--danger-btn-bg-focus);
            --btn-color: var(--danger-btn-color);
            --btn-color-hover: var(--danger-btn-color-hover);
            --btn-color-focus: var(--danger-btn-color-focus);
            --btn-border: var(--danger-btn-border);
            --btn-border-hover: var(--danger-btn-border-hover);
            --btn-border-focus: var(--danger-btn-border-focus);
        }
        button.outline-danger,
        .btn.outline-danger {
            --danger-btn-outline-bg: white;
            --danger-btn-outline-bg-hover: var(--danger);
            --danger-btn-outline-bg-focus: var(--danger-90);
            --danger-btn-outline-color: var(--danger);
            --danger-btn-outline-color-hover: white;
            --danger-btn-outline-color-focus: white;
            --danger-btn-outline-border: var(--danger);
            --danger-btn-outline-border-hover: var(--danger);
            --danger-btn-outline-border-focus: var(--danger);
            --btn-bg: var(--danger-btn-outline-bg);
            --btn-bg-hover: var(--danger-btn-outline-bg-hover);
            --btn-bg-focus: var(--danger-btn-outline-bg-focus);
            --btn-color: var(--danger-btn-outline-color);
            --btn-color-hover: var(--danger-btn-outline-color-hover);
            --btn-color-focus: var(--danger-btn-outline-color-focus);
            --btn-border: var(--danger-btn-outline-border);
            --btn-border-hover: var(--danger-btn-outline-border-hover);
            --btn-border-focus: var(--danger-btn-outline-border-focus);
        }

        .card {
            display: flex;
            flex-direction: column;
            gap: var(--base-gutter);
            padding: 24px;
            border-radius: var(--base-radius);
            background: white;
        }
        .card > .header,
        .card > .footer {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: var(--base-gutter);
            width: 100%;
        }
        .card > .content {
            display: flex;
            flex-direction: column;
            gap: var(--base-gutter);
            width: 100%;
        }

        .spinner,
        [class^=spinner-],
        [class*=" spinner-"],
        .btn-submit:disabled,
        .btn-submit[disabled] {
            --spinner-size: 24px;
            --spinner-m-t: calc((var(--spinner-size) / 2) * -1);
            --spinner-p: 48px;
            --spinner-pos: 12px;
            --spinner-border: 3px;
            --spinner-color: white;
            position: relative !important;
        }
        .spinner:before,
        [class^=spinner-]:before,
        [class*=" spinner-"]:before,
        .btn-submit:disabled:before,
        .btn-submit[disabled]:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            margin-top: var(--spinner-m-t);
            width: var(--spinner-size);
            height: var(--spinner-size);
            border-radius: 50%;
            border: var(--spinner-border) solid transparent;
            border-top-color: var(--spinner-color);
            border-left-color: var(--spinner-color);
            border-bottom-color: var(--spinner-color);
            animation: spinner 0.45s linear infinite;
        }
        .spinner.sm,
        [class^=spinner-].sm,
        [class*=" spinner-"].sm,
        .btn-submit:disabled.sm,
        .btn-submit[disabled].sm {
            --spinner-size: 14px;
            --spinner-border: 2px;
            --spinner-p: 42px;
            --spinner-pos: 14px;
        }
        .spinner.lg,
        [class^=spinner-].lg,
        [class*=" spinner-"].lg,
        .btn-submit:disabled.lg,
        .btn-submit[disabled].lg {
            --spinner-size: 54px;
            --spinner-border: 4px;
            --spinner-p: 104px;
            --spinner-pos: 24px;
        }
        .spinner.secondary,
        [class^=spinner-].secondary,
        [class*=" spinner-"].secondary,
        .btn-submit:disabled.secondary,
        .btn-submit[disabled].secondary {
            --spinner-color: var(--secondary);
        }
        .spinner.gray,
        [class^=spinner-].gray,
        [class*=" spinner-"].gray,
        .btn-submit:disabled.gray,
        .btn-submit[disabled].gray {
            --spinner-color: var(--secondary-50);
        }
        .spinner.success,
        [class^=spinner-].success,
        [class*=" spinner-"].success,
        .btn-submit:disabled.success,
        .btn-submit[disabled].success {
            --spinner-color: var(--success);
        }

        .spinner {
            width: var(--spinner-size);
            height: var(--spinner-size);
        }

        .spinner-right {
            padding-right: var(--spinner-p) !important;
        }
        .spinner-right:before {
            right: var(--spinner-pos);
        }

        .spinner-left,
        .btn-submit:disabled,
        .btn-submit[disabled] {
            padding-left: var(--spinner-p) !important;
        }
        .spinner-left:before,
        .btn-submit:disabled:before,
        .btn-submit[disabled]:before {
            left: var(--spinner-pos);
        }

        .btn-submit:disabled i,
        .btn-submit[disabled] i {
            display: none;
        }

        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }
        [class^=toast-],
        [class*=" toast-"] {
            position: fixed;
            padding: 10px 28px;
            border-radius: 4px;
            background: var(--secondary);
            color: white;
            z-index: 1000000000000000000;
            line-height: 36px;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 0 44px rgba(0, 0, 0, 0.3), 0 0 15px rgba(0, 0, 0, 0.3);
            transition: all 0.15s;
            --toast-x: 20px;
            --toast-y: -100px;
        }
        [class^=toast-] i,
        [class*=" toast-"] i {
            font-size: 24px;
        }
        [class^=toast-].active,
        [class*=" toast-"].active {
            --toast-y: 40px;
        }
        [class^=toast-].success,
        [class*=" toast-"].success {
            background: var(--success);
            box-shadow: 0 0 44px var(--success-40);
        }
        [class^=toast-].danger,
        [class*=" toast-"].danger {
            background: var(--danger);
            box-shadow: 0 0 44px var(--danger-40);
        }
        [class^=toast-].warning,
        [class*=" toast-"].warning {
            background: var(--warning);
            box-shadow: 0 0 44px var(--warning-40);
        }
        [class^=toast-].lg,
        [class*=" toast-"].lg {
            padding: 14px 32px;
            line-height: 40px;
            font-size: 18px;
            font-weight: 600;
        }
        [class^=toast-].lg i,
        [class*=" toast-"].lg i {
            font-size: 30px;
        }

        .toast-top-right {
            right: var(--toast-x);
            top: var(--toast-y);
            margin-left: var(--toast-x);
        }
        .toast-top-left {
            left: var(--toast-x);
            top: var(--toast-y);
        }
        .toast-top {
            top: var(--toast-y);
            left: 50%;
            transform: translateX(-50%);
        }
        .toast-bottom-right {
            right: var(--toast-x);
            bottom: var(--toast-y);
        }
        .toast-bottom-left {
            left: var(--toast-x);
            bottom: var(--toast-y);
        }
        .toast-bottom {
            bottom: var(--toast-y);
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
@endsection

@section('body-class', 'bg-secondary page-form')
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