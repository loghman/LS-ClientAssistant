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
        @if($productDuration!=0)
            <div>
                <span class="title">{{ $productDuration }}</span>
                <small class="subtitle">طول دوره</small>
            </div>
        @endif
        @if($product['published_items_except_chapter_and_heading_count']>0)
            <div>
                <span class="title">{{ to_persian_num($product['published_items_except_chapter_and_heading_count']) }}</span>
                <small class="subtitle">جلسه</small>
            </div>
        @endif
    </div>
    <div class="accordions">
        @foreach($product['chapters'] as $i => $chapter)
            <div class="accordion">
                <div class="header">
                    <span class="number">{{ to_persian_num($i + 1) }}</span>
                    <span class="title">{{ $chapter['title'] }}</span>
                </div>
                @if(count($chapter['publishedItems']) > 0)
                    <div class="content">
                        <ul class="list">
                            @foreach($chapter['publishedItems'] as $chapterItem)
                                @if($chapterItem['videos_duration']['line_time'] != '00:00:00')
                                <li>
                                    <span class="title">{{ $chapterItem['title'] }}</span>
                                    <span class="subtitle">{{ to_persian_num($chapterItem['videos_duration']['line_time']) }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>