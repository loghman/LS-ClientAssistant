<div class="info">
    <div class="full ms-auto">
        @if($product['mainTeacherFaculty'] != null)
            <img src="{{ get_media_url($product['mainTeacherFaculty']['avatar']) }}" alt="{{ $product['mainTeacherFaculty']['display_name'] }}" class="avatar">
{{--            <img src="{{ $product['mainTeacherFaculty']['avatar_url']['small']['url'] }}" alt="{{ $product['mainTeacherFaculty']['display_name'] }}" class="avatar">--}}
            <div class="text">
                <small class="subtitle">مدرس دوره</small>
                <span class="title sm">{{ $product['mainTeacherFaculty']['display_name'] }}</span>
            </div>
        @endif
    </div>
    @if($productDuration!=0)
        <div>
            <span class="title ltr">{{ to_persian_num($productDuration) }}</span>
            <small class="subtitle">ساعت</small>
        </div>
    @endif
    @if($product['published_items_except_chapter_and_heading_count']>0)
        <div>
            <span class="title">{{ to_persian_num($product['published_items_except_chapter_and_heading_count']) }}</span>
            <small class="subtitle">جلسه</small>
        </div>
    @endif
</div>