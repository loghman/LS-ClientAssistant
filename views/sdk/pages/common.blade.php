@extends('sdk._common.layouts.base')
@section('title', $page['title'])
@push('head')
@endpush
@section('body-class', '')
@section('header-class', 'square center min-h-fit--md pb-5 pb-lg-0')
@section('header')
@endsection
@section('base-content-class', '')
@section('content')
<div class="container over-header my-4">
        <h1><?= $page['title'] ?></h1>
        <div class="row gx-lg gx-md--lg">
            <div class="col-xxxl-12 col-xxl-8-5 col-xl-8">
                <div class="row g page-content">
                    {!! planetContentFilter($page['content']) !!}
                </div>
            </div>
        </div>
    </div>
    <style>
        header.square {
            min-height: 300px !important;
        }
        h1{
            margin: -190px 0 100px 0;
            text-align: center;
        }
        img{
            max-width: 100%;
        }
        @media (min-width:900px){
            .page-content{
                padding: 0 15%;
            }
        }
        .page-content *{
            line-height: 32px !important;
        }
        .page-content ul{
            margin: 20px 50px 10px 10px !important;
            display: block !important;
        }
        .page-content ul li{
            list-style-type: circle;
            display: list-item !important; 
        }
    </style>
@endsection

@section('modals')@endsection
@section('footer')
    @include('_common.scripts.highlight')
@endsection
