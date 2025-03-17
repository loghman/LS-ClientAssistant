<div class="heading last">
    @if($invoice['is_installment'])
        @if($invoice['paid_progress_percent'] != 100)
            @if($invoice['installment_paid_count'] > 0)
                <span class="t-text bold">{{ $invoice['installment_paid_count'] }} از {{ count($invoice['payments']) }} قسط پرداخت شده</span>
            @else
                <span class="t-text bold">تاکنون قسطی پرداخت نشده</span>
            @endif
            @if($invoice['installment_paid_count'] > 0)
                <div class="row">
                    <div class="progress" style="--w: {{ $invoice['paid_progress_percent'] }}%"></div>
                    <span class="t-text bold">{{ $invoice['paid_progress_percent'] }}درصد</span>
                </div>
            @endif
        @else
            <div class="text-success bold">تسویه شده</div>
        @endif
    @else
        @if($invoice['status']['name'] === 'PAID')
            <div class="text-success bold">تسویه شده</div>
        @else
            <span class="t-text bold">پرداخت نشده</span>
        @endif
    @endif
</div>