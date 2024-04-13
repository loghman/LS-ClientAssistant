@if(strlen($introVideo) > 0)
    <div class="video">
        <video controls>
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
        @if(isset($product['banner_url']['main']['url']))
            <div class="cover">
                <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}">
                <i class="i-target"></i>
                {{ $product['title'] }}
            </div>
        @endif
    </div>
@else
    @if(isset($product['banner_url']['main']['url']))
        <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}" class="thumbnail">
    @endif
@endif