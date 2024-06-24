@if(count($gateways) > 1)
    <div class="input-group sm">
        <label style="min-width: auto" for="gateway">درگاه</label>
        <select name="gateway" id="gateway"
                data-url_pattern="{{ route('payment.requestLink', ['cart' => $cart['id'], 'gateway' => '#gateway_id#']) }}"
                style="max-width: 100% !important;">
            @foreach($gateways as $gateway)
                @php($isSnap = isset($snapPay) && $gateway['id'] === $snapPay['id'])
                @if($isSnap && (empty($eligibleResponse['successful']) || $eligibleResponse['successful'] !== true))
                    @continue
                @endif
                <option {{ $defaultGateway['id'] === $gateway['id'] ? 'selected' : '' }} data-target="{{ $gateway['id'] }}"
                        value="{{ $gateway['id'] }}">{{ $isSnap ? $eligibleResponse['response']['title_message'] : $gateway['name_fa'] }}</option>
            @endforeach
        </select>
    </div>
    @if(!empty($eligibleResponse) && isset($snapPay))
        <div class="gateways-description">
            <p class="sm fs-13 d-none" id="gateway-{{ $snapPay['id'] }}">{{ $eligibleResponse['response']['description'] }}</p>
        </div>
    @endif
@endif

<a href="{{ route('payment.requestLink', ['cart' => $cart['id'], 'gateway' => $defaultGateway['id']]) }}"
   class="btn w-100" id="payment-btn">پرداخت و تکمیل ثبت نام</a>

<script>
$(function () {
    $('#gateway').on('change', function () {
        let paymentUrlPattern = $(this).data('url_pattern'),
            gatewayId = $(this).val(),
            target = $(this).find('option:selected').data('target');

        $('#payment-btn').attr('href', paymentUrlPattern.replace('#gateway_id#', gatewayId));

        $('.gateways-description p').each(function () {
            $(this).addClass('d-none');
        });

        $('#gateway-' + target).removeClass('d-none');
    });
});
</script>