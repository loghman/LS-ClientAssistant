@php
    $isDiv = $invoice['is_expired']
        || empty($invoice['checked_at'])
        || $invoice['status']['name'] === 'CANCELED'
        || $payment['status']['name'] === 'PAID'
        || $touchActive
@endphp

<{{ $isDiv ? 'div' : 'a href='. $payment['payment_link'] }} class="item {{ $payment['status']['name'] === 'PAID' ? 'success' : '' }}">
    <span class="t-text">
        @if($payment['is_installment'])
            <span class="bold">قسط {{ number_to_letter_persian($loop->iteration) }}</span>
        @else
            <span class="bold">پرداخت آنلاین</span>
        @endif
        @if(! empty($payment['due_date']))
            <span class="date">({{ $payment['due_date']['diff_for_human'] }} تا سررسید  ، {{ $payment['due_date']['jalali']['day'] }} {{ $payment['due_date']['jalali']['month_name'] }})</span>
        @endif
    </span>
    <div class="row">
        <span class="t-text bold">{{ $payment['amount']['readable'] }} تومان</span>
        @if($payment['status']['name'] === 'PAID')
            <span class="d-none-responsive">|</span>
            <span class="t-text bold text-success">{{ $payment['status']['to_persian'] }}</span>
        @else
            <span class="btn {{ $isDiv ? 'gray' : '' }}" {{ $isDiv ? 'disabled=disabled' : '' }}>
              پرداخت
              <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </span>
        @endif
    </div>
</{{ $isDiv ? 'div' : 'a' }}>
