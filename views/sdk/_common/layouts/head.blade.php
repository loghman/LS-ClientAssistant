{{ setting('top_of_head_script') }}
@if(get_current_theme() != null)
    {!! get_current_theme()['rendered_css'] !!}
@endif
@include('_common.layouts.head')
{{ setting('bottom_of_head_script') }}
