@php($campaign = \Ls\ClientAssistant\Utilities\Modules\Campaign::primaryCampaign()->get('data'))
@if(!empty($campaign))
    <a href="{{ $campaign['landing_url'] }}" class="promotion-banner d-flex" id="promotion-banner">
        <div class="container">
            <div class="row">
                <div class="col px-0--sm">
                    <div class="alert text-secondary bg-transparent px-0  text-center">
                        <span class="title text-white pe-xs d-flex align-items-center gap-sm gap-xs--lg flex-column flex-lg-row">
                            {!! $campaign['description'] !!}</span>
                        @include('sdk._common.components.countdown-box', [
                            'class'=>'sm',
                            'date' => $campaign['ends_at'],
                            'bg' => '#F29425'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </a>
@endif
