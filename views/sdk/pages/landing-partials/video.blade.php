@if(strlen($introVideo) > 0)
    <div class="video cover-section">
        <video controls>
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
        @if(get_media_url($product['banner']) !== '')
            <div class="overlay">
                <img src="{{ get_media_url($product['banner']) }}" alt="{{ $product['title'] }}" class="thumbnail">
                <i class="i-play-circle-fill"></i>
                <span class="title">{{ $product['title'] }}</span>
            </div>
        @endif
    </div>
@else
    @if(get_media_url($product['banner']) !== '')
        <div class="cover-section">
            <div class="aspect-16-9">
                <img src="{{ get_media_url($product['banner']) }}" alt="{{ $product['title'] }}">
            </div>
            <div class="overlay">
                <span class="title">{{ $product['title'] }}</span>
            </div>
        </div>
    @endif
@endif
