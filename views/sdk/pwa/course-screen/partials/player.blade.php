@if(in_array($item['type'],[2,3]))
    <div class="playerbox">
    @if($data['player_type'] == 'arvan')
        <iframe id="ir1p" frameborder="0" title="<?=$item['title']?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        src="https://player.arvancloud.ir/index.html?config=<?=$data['arvanUrl']?>" allowfullscreen></iframe>
        <!-- src="https://player.arvancloud.ir/?config={CONFIG_URL}" allowfullscreen></iframe> -->

    @elseif(0 && $data['player_type'] == 'kavimo')
        <script src="https://stream.7learn.com/<?=$item['main_video']['stream_id']?>/embed"></script>
    @else
        @if(filter_var(get_media_url($item['main_video'], FILTER_VALIDATE_URL)))
        <video controls autoplay class="w-100 base-radius overflow-hidden">
            <source src="{{ get_media_url($item['main_video']) }}" type="video/mp4"/>
        </video>
        @else
            <div>ویدیوی این جلسه مشکل دارد و یا اینکه هنوز منتشر نشده است.</div>
        @endif
    @endif
    </div>
    @if(is_logged_in())
    <div class="signal-box">
        @if($data['log_type'] != 'completed')
            <button class="signal-btn me-auto btn" data-iid="<?=$item['id']?>" onclick="signalRequest(this,'completed')"><i class="fa-solid fa-circle-check"></i> تماشا کردم</button>
        @else
            <span><span class="i-check-circle" style="font-size: 20px; color: var(--primary); vertical-align: text-bottom;"></span> قبلا این جلسه را مشاهده کرده اید.</span>
        @endif
    </div> 
    @endif

@endif

<?php if(!empty($item['other_attachments'])): ?>
<div class="attachments">
<?php foreach($item['other_attachments'] as $atch): ?>
    <a href="<?=get_media_url($atch)?>" target="_blank" class="atlink btn light">
    <span class="title"><b><i class="fa-solid fa-download"></i></b> <?=str_replace(['پیوست ','پیوست'],'',$atch['title'])?></span>
    <span class="size me-auto"><?=to_persian_num(formatSizeUnits($atch['size']))?></span>
</a>
<?php endforeach; ?>
</div> 
<?php endif; ?>

<?php $len = strlen($item['description'] ?? '');?>
<?php if($len > 3): ?>
<div class="longtextwrap">
    <?php if($len > 400): ?>
        <div class="longtext"><?= $item['description']?></div>
        <span class="moretext" onclick="toggleMoreText(event)">ادامه توضیحات ...</span>
    <?php else: ?>
        <div class="alltext"><?= $item['description']?></div>
    <?php endif; ?>
</div>
<?php endif; ?>
