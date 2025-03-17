@if($invoice['status']['name'] !== 'PAID')
    @if(empty($invoice['checked_at']) || $invoice['status']['name'] === 'CANCELED')
        <div class="alert danger">
            <div class="content">
                <h3 class="heading">پیش فاکتور شما تایید نشده است</h3>
                <p class="subtitle">پیش فاکتور شما در انتظار تایید بخش مالی می باشد، و پس از تایید قابل پرداخت خواهد بود
                    و از طریق پیامک به شما اطلاع رسانی می شود.</p>
            </div>
        </div>
    @elseif(request()->has('status') && (int) request('status') === 0)
        <div class="alert danger">
            <div class="content">
                <h3 class="heading">فرآیند‍ پرداخت ناموفق بود</h3>
                <p class="subtitle">در صورتی که مبلغی از حساب شما کسر شده, می توانید با پشتیبانی تماس بگیرید</p>
            </div>
        </div>
    @elseif((int) request('status') === 1)
        <div class="alert success">
            <div class="content">
                <h3 class="heading">
                    <i class="fa-solid fa-check text-success"></i>
                    @php($transactionId = collect($invoice['payments'])->where('status.name', '=', 'PAID')->last()['transaction_id'] ?? '')
                    <span>پرداخت شما با کدپیگیری<span style="opacity: .75"> {{ $transactionId }} </span>با موفقیت انجام شد</span>
                    <a href="{{ route('panel.course.list') }}" class="btn success">دوره‌های من</a>
                </h3>
            </div>
        </div>
    @endif
@endif