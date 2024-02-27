<!doctype html>
<html dir="rtl" lang="fa">
<head>
    {{ setting('top_of_head_script') }}
    @include('_common.layouts.head')
    @if(get_current_theme() != null)
        {!! get_current_theme()['rendered_css'] !!}
    @endif
    {{ setting('bottom_of_head_script') }}
</head>