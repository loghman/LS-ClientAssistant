<div id="tab-gifts" class="tab-content">
    <span class="t-title d-block text-center mb-2">
        <span style="color: #ddb664">{{ count($product['productGifts']) }} هدیه ویژه</span>
        به ارزش {{ $product['totalGiftsPrice']['human'] }}
    </span>
    <div class="gifts">
        @foreach($product['productGifts'] as $gift)
            <div class="card-action">
                <div class="gift"></div>
                <span class="content pb-0 justify-content-center">
                    <img loading="lazy" class="icon" src="{{ $gift['meta']['icon_multi_color']['small']['url'] ?? $gift['meta']['banner_url']['small']['url'] }}">
                    <span class="title">{{ $gift['title'] }}</span>
                    <small class="subtitle">{{ $gift['price']['human'] }}</small>
                </span>
            </div>
        @endforeach
    </div>
</div>