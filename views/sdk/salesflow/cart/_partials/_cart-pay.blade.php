@if(count($gateways) > 1)

    <div id="gateway-container" class="d-flex flex-column gap-xs mt-sm"
         data-url_pattern="{{ route('payment.requestLink', ['cart' => $cart['id'], 'gateway' => '#gateway_id#']) }}">
        <span class="t-title-md pb-xxs">درگاه‌های پرداخت</span>
        <div class="d-flex align-items-start flex-wrap gap-xs">
            @foreach($gateways as $gateway)
                @php($isSnap = isset($snapPay) && $gateway['id'] === $snapPay['id'])
                @if($isSnap && (empty($eligibleResponse['successful']) || $eligibleResponse['successful'] !== true))
                    @continue
                @endif

                <label class="btn white-glass sm btn-input">
                    <input type="radio" name="gateway"
                           {{ $defaultGateway['id'] === $gateway['id'] ? 'checked' : '' }} value="{{ $gateway['id'] }}">
                    <img class="icon" src="{{ $gateway['thumbnail'] }}" alt="{{ $gateway['name_fa'] }}">
                    <span>{{ $isSnap ? $eligibleResponse['response']['title_message'] : $gateway['name_fa'] }}</span>
                </label>
            @endforeach
            @if(!empty($eligibleResponse) && isset($snapPay))
                <div class="gateway-info mt-neg-4 d-none" id="gateway-{{ $snapPay['id'] }}">
                    <ul class="list gap-0">
                        @foreach(explode('،', $eligibleResponse['response']['description']) as $detail)
                            <li>
                                <span class="t-subtitle"><i class="fs-15 si-check-circle text-success"></i> {{ $detail }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endif

<script>
    $(function () {
        $('input[type=radio][name=gateway]').on('change', function () {
            let container = $(this).closest('#gateway-container'),
                paymentUrlPattern = container.data('url_pattern'),
                gatewayId = $(this).val();

            $('#payment-btn').attr('href', paymentUrlPattern.replace('#gateway_id#', gatewayId));

            showGatewayDetails(gatewayId);

        });


        showGatewayDetails(
            $('input[type=radio][name=gateway][checked=checked]').val()
        );

        function showGatewayDetails(gatewayId) {
            let container = $('#gateway-container'),
                target = container.find('#gateway-' + gatewayId);

            container.find('.gateway-info').each(function () {
                $(this).addClass('d-none');
            });

            target.removeClass('d-none');
        }

    });
</script>