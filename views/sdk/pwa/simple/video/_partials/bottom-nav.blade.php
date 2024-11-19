<nav class="bottom-nav screen-nav">
    <a class="bnavi" href="<?=site_url('pwa/my-courses')?>" style="width: 30%;justify-content: center;border-right: 1px solid #f3f3f3 !important;">
        <span style="color:#777;font-size: 14px;">برگشت</span>
        <i class="fa-solid fa-arrow-left" style="color:#777;font-size: 14px;"></i>
    </a>

    <a class="bnavi" href="{{ $item->chapter_url }}" style="width: 70%;justify-content: start;padding-right:24px">
        <!-- <i class="fa-solid fa-bars"></i> -->
        <!-- این پایین درصد پیشرفت کل دوره هست -->
        <?=circleProgressbar($item->product->enrollment->progress_percent,'xs','nav-progress');?>
        <span>سرفصل های دوره</span>
    </a>
</nav>

<style>
    .bottom-nav.screen-nav {
        height: 70px;
    }
    .bottom-nav.screen-nav .nav-progress {
        width: 40px;
        margin-left: 10px;
    }
    .bottom-nav.screen-nav>a {
        flex-direction: row;
    }
    .bottom-nav.screen-nav>a>i {
        font-size: 26px;
        margin: 0 10px;
        vertical-align: middle !important;
    }

    .bottom-nav.screen-nav>a>span {
        font-size: 16px;
        line-height: 20px;
        color:#333;
    }
</style>

