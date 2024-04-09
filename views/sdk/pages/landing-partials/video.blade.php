@if(strlen($introVideo) > 0)
    <div class="video">
        <video controls>
            <source src="{{ $introVideo }}" type="video/mp4"/>
        </video>
        <div class="cover">
            <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}">
            <i class="i-target"></i>
            پخش ویدیو
        </div>
    </div>
@else
    <img src="{{ $product['banner_url']['main']['url'] }}" alt="{{ $product['title'] }}" class="thumbnail">
@endif