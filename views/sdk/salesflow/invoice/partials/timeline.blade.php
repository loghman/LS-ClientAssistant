<div class="timeline">
    @if(count($invoice['payments']) > 0)
        @php($touchActive = false)
        @foreach($invoice['payments'] as $payment)
            @include('sdk.salesflow.invoice.partials.payment-item', ['touchActive' => $touchActive])
            @php($touchActive = $payment['status']['name'] !== 'PAID')
        @endforeach
    @endif
</div>