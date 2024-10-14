<div class="info">
    <div class="full ms-auto">
        @if($product['mainTeacherFaculty'] != null)
            <img src="{{ get_media_url($product['mainTeacherFaculty']['avatar']) }}" alt="{{ $product['mainTeacherFaculty']['full_name'] }}" class="avatar">
{{--            <img src="{{ $product['mainTeacherFaculty']['avatar_url']['small']['url'] }}" alt="{{ $product['mainTeacherFaculty']['full_name'] }}" class="avatar">--}}
            <div class="text">
                <small class="subtitle">مدرس دوره</small>
                <span class="title sm">{{ $product['mainTeacherFaculty']['full_name'] }}</span>
            </div>
        @endif
    </div>
    @if($productDuration!=0)
        <div>
            <span class="title ltr">{{ to_persian_num($productDuration) }}</span>
            <small class="subtitle">ساعت</small>
        </div>
    @endif
    @if($product['item_count']>0)
        <div>
            <span class="title">{{ to_persian_num($product['item_count']) }}</span>
            <small class="subtitle">جلسه</small>
        </div>
    @endif
</div>