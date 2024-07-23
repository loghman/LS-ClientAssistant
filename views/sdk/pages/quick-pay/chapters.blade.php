<div class="accordions">
    @foreach($product['chapters'] as $i => $chapter)
        <div class="accordion {{count($product['chapters']) === 1 ? 'expanded' : ''}}">
            <div class="header">
                <span class="i-align-right-2 number"></span>
                <span class="title">{{ $chapter['title'] }}</span>
            </div>
            @if(count($chapter['publishedItems']) > 0)
                <div class="content">
                    <ul class="list">
                        @foreach($chapter['publishedItems'] as $chapterItem)
                            @if($chapterItem['type']['value'] === 2 && $chapterItem['videos_duration']['line_time'] != '00:00:00')
                                <li>
                                    <span class="title">{{ $chapterItem['title'] }}</span>
                                    <span class="subtitle">{{ to_persian_num($chapterItem['videos_duration']['line_time']) }}</span>
                                </li>
                            @endif
                            @if(in_array($chapterItem['type']['value'], [5, 7]) && isset($chapterItem['payload']['question_count']) && $chapterItem['payload']['question_count'] > 0)
                                <li>
                                    <span class="title">{{ $chapterItem['title'] }}</span>
                                    <span class="subtitle">{{ to_persian_num($chapterItem['payload']['question_count']) }} سوال</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endforeach
</div>