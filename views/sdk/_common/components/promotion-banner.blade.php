@php($campaign = \Ls\ClientAssistant\Utilities\Modules\Campaign::primaryCampaign()->get('data'))
@if(!empty($campaign))
    <a href="{{ $campaign['landing_url'] }}" class="promotion-banner d-flex" id="promotion-banner"
       style=" background: rgb(85,85,85);background: radial-gradient(circle, rgba(85,85,85,1) 0%, rgba(24,24,24,1) 100%);">
        <div class="container">
            <div class="row">
                <div class="col px-0--sm">
                    <div class="alert text-secondary bg-transparent px-0 justify-content-center text-center">
                        <span class="title text-white pe-xs d-flex align-items-center gap-sm gap-xs--lg flex-column flex-lg-row">
{{--                            <img class="icon md w-inherit" src="{{ asset_url('img/icons/blackfriday.svg') }}"--}}
                            {{--                                 alt="{{ $campaign['title'] }}">--}}
                            {!! $campaign['description'] !!}</span>

                        @include('sdk._common.components.countdown-box', [
                            'class'=>'sm mx-auto me-lg-auto ms-lg-0',
                            'date' => $campaign['ends_at'],
                            'bg' => '#F29425'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </a>
@endif
