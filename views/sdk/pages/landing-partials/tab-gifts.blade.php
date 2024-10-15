<div id="tab-gifts" class="tab-content">
    <span class="t-title d-block text-center mb-2">
        <span style="color: #ddb664">{{ count($product['productGifts']) }} هدیه ویژه</span>
        به ارزش {{ $product['total_gifts_price']['human'] }}
    </span>
    <div class="gifts">
        @foreach($product['productGifts'] as $gift)
            <div class="card-action">
                <div class="gift"></div>
                <span class="content pb-0 justify-content-center">
                    <img loading="lazy"
                         class="icon"
                         src="{{
                                    get_media_url(
                                    $gift['icon_multi_color'],
                                    get_media_url($gift['banner'], get_default_media(\Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum::BANNER), \Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum::SMALL_THUMBNAIL),
                                     \Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum::SMALL_THUMBNAIL
                                    )
                                 }}">
                    <span class="title">{{ $gift['title'] }}</span>
                    <small class="subtitle">{{ $gift['price']['human'] }}</small>
                </span>
            </div>
        @endforeach
    </div>
</div>