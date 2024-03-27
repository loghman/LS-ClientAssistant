<div id="tab-headers" class="tab-content active">
    <div class="info">
        <div class="full ms-auto">
            @if($product['mainTeacherFaculty'] != null)
                <img src="{{ $product['mainTeacherFaculty']['avatar_url']['small']['url'] }}" alt="{{ $product['mainTeacherFaculty']['display_name'] }}" class="avatar">
                <div class="text">
                    <small class="subtitle">مدرس دوره</small>
                    <span class="title sm">{{ $product['mainTeacherFaculty']['display_name'] }}</span>
                </div>
            @endif
        </div>
        <div>
            <span class="title">{{ count($chapters) }}</span>
            <small class="subtitle">سرفصل</small>
        </div>
        <div>
            <span class="title">{{ $product['published_items_except_chapter_and_heading_count'] }}</span>
            <small class="subtitle">جلسه</small>
        </div>
    </div>
    <div class="accordions">
        @foreach($chapters as $i => $chapter)
            <div class="accordion">
                <div class="header">
                    <span class="number">{{ $i + 1 }}</span>
                    <span class="title">{{ $chapter['title'] }}</span>
                </div>
                @if(count($chapter['items']) > 0)
                    <div class="content">
                        <ul class="list">
                            @foreach($chapter['items'] as $chapterItem)
                                <li>
                                    <span class="title">{{ $chapterItem['title'] }}</span>
                                    <span class="subtitle">{{ convert_seconds_to_persian_in_line_time($chapterItem['attachment_duration_sum']) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>