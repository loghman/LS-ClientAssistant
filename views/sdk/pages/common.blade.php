@extends('sdk._common.layouts.base')
@section('title', $page['title'])
@push('head')
@endpush
@section('body-class', '')
@section('header-class', 'square md center')

@section('header-props', "style=background-color:var(--secondary)")
@section('navbar_class', 'light')
@section('header')
@endsection
@section('base-content-class', 'lg')
@section('content')
    <div class="container">
        <div class="row gy gx justify-content-center">
            <div class="col-xxl-10">
                <div class="sticky-sidebar gap-md gap-sm--lg transparent over-header md">
                    <h1 class="page-title text-center text-white lh-1">{{ $page['title'] }}</h1>
                    <div class="card padding-md align-items-center text-center">
                        <div class="content d-block t-tags compact">
                            {!! $page['content'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')@endsection
@section('footer')
    @include('_common.scripts.highlight')
@endsection
