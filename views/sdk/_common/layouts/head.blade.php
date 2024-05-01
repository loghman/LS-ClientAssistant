{!! setting('top_of_head_script') !!}
@include('_common.layouts.head')
@php $theme = get_current_theme(); @endphp
@if($theme != null)
    {!! $theme['rendered_css'] !!}
@endif
{!! setting('bottom_of_head_script') !!}