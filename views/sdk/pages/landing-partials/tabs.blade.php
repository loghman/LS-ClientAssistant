<ul class="tabs">
    <li class="active" data-target="#tab-headers">
        <i class="i-check-lists-square-2"></i>
        <span>سرفصل</span>
    </li>
    @if($product['description'])
        <li data-target="#tab-description">
            <i class="i-align-right-2"></i>
            <span>توضیحات</span>
        </li>
    @endif
    @if(count($product['productGifts']) > 0)
        <li data-target="#tab-gifts">
            <i class="i-gift"></i>
            <span>هدیه</span>
        </li>
    @endif
</ul>