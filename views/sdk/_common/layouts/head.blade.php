<!doctype html>
<html dir="rtl" lang="fa">
<head>
    @include('_common.layouts.head')
    @if(get_current_theme() != null)
        {!! get_current_theme()['rendered_css'] !!}
    @endif
</head>