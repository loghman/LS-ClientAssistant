@extends('sdk._common.layouts.base')
@if(isset($seoMeta) && $seoMeta != '')
    @push('head')
        {!! $seoMeta !!}
    @endpush
@else
    @section('title', $article['title'])
@endif
@push('head')
@endpush
@section('body-class', '')
@section('header-class', 'square center min-h-fit--md pb-5 pb-lg-0')
@section('header')
@endsection
@section('base-content-class', '')
@section('content')
    <div class="container over-header my-4">
        <div class="row gx-lg gx-md--lg">
            <div class="col-xxxl-12 col-xxl-8-5 col-xl-8">
                <div class="row g">
                    {!! $page['content'] !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modals')@endsection
@section('footer')
    @include('_common.scripts.highlight')
@endsection
