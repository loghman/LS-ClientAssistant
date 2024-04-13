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
            <span class="title">{{ $productDuration }}</span>
            <small class="subtitle">طول دوره</small>
        </div>
        <div>
            <span class="title">{{ to_persian_num($product['published_items_except_chapter_and_heading_count']) }}</span>
            <small class="subtitle">جلسه</small>
        </div>
    </div>
    <div class="accordions">
        @php $index=0; @endphp
        @foreach($product['chapters'] as $i => $chapter)
            @if(count($chapter['publishedItems']) > 0)
                <div class="accordion">
                    <div class="header">
                        <span class="number">{{ to_persian_num(++$index) }}</span>
                        <span class="title">{{ $chapter['title'] }}</span>
                    </div>

                    <div class="content">
                        <ul class="list">
                            @foreach($chapter['publishedItems'] as $chapterItem)
                                <li>
                                    <span class="title">{{ $chapterItem['title'] }}</span>
                                    <span class="subtitle">{{ to_persian_num($chapterItem['videos_duration']['line_time']) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>