<div class="heading">
    <div class="row">
        <img class="avatar" src="{{ $invoice['user']['avatar_url'] }}" alt="{{ $invoice['user']['full_name'] }}"/>
        <div class="col">
            <span class="t-title">{{ $invoice['user']['full_name'] }}</span>
        </div>
    </div>
    @if($invoice['is_expired'])
        <span class="t-title text-red">منقضی شده</span>
    @elseif($invoice['is_installment'])
        <span class="t-title text-danger">اقساطی</span>
    @else
        <span class="t-title text-primary">نقدی</span>
    @endif
</div>