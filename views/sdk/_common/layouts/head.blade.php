{!! setting('top_of_head_script') !!}
@php $theme = get_current_theme(); @endphp
@if($theme != null)
    {!! $theme['rendered_css'] !!}
@endif
@include('_common.layouts.head')
{!! setting('bottom_of_head_script') !!}