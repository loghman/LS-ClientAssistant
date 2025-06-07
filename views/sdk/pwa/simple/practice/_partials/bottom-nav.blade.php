<nav class="bottom-nav screen-nav">
    <a class="bnavi" href="<?=site_url('pwa/my-courses')?>">
        <span>برگشت</span>
        <i class="fa-solid fa-arrow-left"></i>
    </a>
    <a class="bnavi" href="<?=site_url("pwa/course/{$item->product->id}/chapters?e={$item->product->enrollment->id}")?>">
        <!-- <i class="fa-solid fa-bars"></i> -->
        <!-- این پایین درصد پیشرفت کل دوره هست -->
        <?=circleProgressbar($item->product->enrollment->progress_percent, 'xs', 'nav-progress');?>
        <span>سرفصل های دوره</span>
    </a>
</nav>

<style>
    .bottom-nav.screen-nav {
        height: 70px;
        padding: 0;

    }

    .bottom-nav.screen-nav .nav-progress {
        width: 40px;
    }

    .bottom-nav.screen-nav>a {
        flex-direction: row;
        gap: 10px;
    }

    .bottom-nav.screen-nav>a>i {
        font-size: 16px;
        vertical-align: middle !important;
    }

    .bottom-nav.screen-nav>a>span {
        font-size: 16px;
        font-weight: 600;
        line-height: 20px;
        color: #333;
    }
</style>