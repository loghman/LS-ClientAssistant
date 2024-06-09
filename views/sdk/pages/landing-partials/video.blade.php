@if(strlen($introVideo) > 0)
    <div class="video cover-section">
        <video controls controlsList="nofullscreen noplaybackrate">
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
        @if(isset($product['banner_url']['main']['url']))
            <div class="overlay">
                <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}" class="thumbnail">
                <i class="i-play-circle-fill"></i>
                <span class="title">{{ $product['title'] }}</span>
            </div>
        @endif
    </div>
@else
    @if(isset($product['banner_url']['main']['url']))
        <div class="cover-section">
            <div class="aspect-16-9">
                <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}">
            </div>
            <div class="overlay">
{{--                <img src="" alt="" class="icon">--}}
                <span class="title">{{ $product['title'] }}</span>
            </div>
        </div>
    @endif
@endif
