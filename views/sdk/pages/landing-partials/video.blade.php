@if(strlen($introVideo) > 0)
    <div class="video">
        <video controls>
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
    </div>
@else
    @if(isset($product['banner_url']['main']['url']))
        <div class="cover with-info">
            <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}" class="thumbnail">
            <div class="cover-info">
                <span class="title">{{ $product['title'] }}</span>
            </div>
        </div>
    @endif
@endif

<style>
    .with-info{
        position: relative;
    }
    .cover-info{
        position: absolute;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
