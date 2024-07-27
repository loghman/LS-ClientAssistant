<?php 
function formatSizeUnits($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824,2) . ' گیگابایت';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576,2) . ' مگابایت';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024) . ' کیلوبایت';
    } elseif ($bytes >= 1) {
        $bytes = $bytes . ' بایت';
    } else {
        $bytes = '';
    }
    return $bytes;
}
?>

@if(in_array($item['type'],[2,3]))
    <div class="playerbox">
    @if($data['player_type'] == 'arvan')
        <iframe id="ir1p" frameborder="0" title="<?=$item?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        src="https://player.arvancloud.ir/index.html?config=<?=$data['arvanUrl']?>" allowfullscreen></iframe>
        <!-- src="https://player.arvancloud.ir/?config={CONFIG_URL}" allowfullscreen></iframe> -->

    @elseif($data['player_type'] == 'kavimo')
        <script src="https://stream.7learn.com/<?=$item['main_video']['stream_id']?>/embed"></script>
    @else
        @if(filter_var($item['main_video']['full_url'], FILTER_VALIDATE_URL))
        <video controls autoplay class="w-100 base-radius overflow-hidden" onclick="this.paused ? this.play() : this.pause();">
            <source src="{{ $item['main_video']['full_url'] }}" type="video/mp4"/>
        </video>
        @else
            <div>ویدیوی این جلسه مشکل دارد و یا اینکه هنوز منتشر نشده است.</div>
        @endif
    @endif
    </div>
        <div class="signal-box">
        @if($data['log_type'] != 'completed')
            <span>این جلسه رو به صورت کامل  دیدید؟</span>
            <button class="signal-btn me-auto" data-iid="<?=$item['id']?>" onclick="signalRequest(this,'completed')"><span class="i-check-circle"></span> بله، کامل دیدم</button>
            @else
            <span><span class="i-check-circle" style="font-size: 20px; color: var(--primary); vertical-align: text-bottom;"></span> قبلا این جلسه را مشاهده کرده اید.</span>
            @endif
        </div> 
@endif

<div>
    <?php foreach($item['other_attachments'] as $atch): ?>
        <a href="<?=$atch['full_url']?>" target="_blank" class="atlink">
            <span class="title"><b><i>📌</i> دانلود: </b> <?=str_replace(['پیوست ','پیوست'],'',$atch['title'])?></span>
            <span class="me-auto"><?=to_persian_num(formatSizeUnits($atch['size']))?></span>
        </a>
    <?php endforeach; ?>
    <div class="desc"><?= $item['description']?></div>
</div>


