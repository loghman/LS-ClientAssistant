@php
    $shapeImage = '<svg class="bg" width="132" height="125" viewBox="0 0 132 125" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.44112 35.4639C9.17873 12.4846 30.7863 -3.38381 53.5318 0.88096L98.8715 9.38216C117.79 12.9295 131.5 29.4485 131.5 48.6971V78.0555C131.5 98.0708 116.706 115.005 96.8721 117.693L46.2039 124.56C20.2808 128.074 -1.98201 106.167 1.11265 80.1908L6.44112 35.4639Z" fill="url(#paint0_linear_55_219)"/>
                                    <defs>
                                        <linearGradient id="paint0_linear_55_219" x1="11.5" y1="113" x2="131.5" y2="-7" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="var(--primary-20)"/>
                                            <stop offset="1" stop-color="var(--primary-85)"/>
                                        </linearGradient>
                                    </defs>
                                </svg>';
    $shapeFooter = '<svg width="1440" height="659" viewBox="0 0 1440 659" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M1440 632.375V659H0V366.667L166.275 356.245C204.297 353.863 239.89 336.745 265.49 308.532L501.699 48.2034C539.41 6.64401 597.567 -9.68902 651.401 6.16318L1285.89 192.996C1362.76 215.633 1407.13 295.896 1385.4 373.034L1371.19 423.484C1360.58 461.164 1365.51 501.524 1384.88 535.544L1440 632.375Z" fill="var(--primary-5)"/>
    </svg>';
@endphp
@extends('sdk.hook.landing._partials.base')
@section('content')
    @include('sdk.hook.landing._partials.header')
    @include('sdk.hook.landing._partials.description')
    @include('sdk.hook.landing._partials.form')
@endsection