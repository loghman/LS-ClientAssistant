@if(strlen($introVideo) > 0)
    <div class="video cover-section">
        <video controls>
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
        @if(isset($product['banner_url']['main']['url']))
            <div class="overlay">
                <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}">
                <i class="i-play-circle-fill"></i>
                <span class="title">{{ $product['title'] }}</span>
            </div>
        @endif
    </div>
@else
    @if(isset($product['banner_url']['main']['url']))
        <div class="cover-section">
            <div class="overlay">
                <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}" class="thumbnail">
                <span class="title">{{ $product['title'] }}</span>
            </div>
        </div>
    @endif
@endif
