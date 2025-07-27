<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')

        <div class="base-content">
            <div class="bghead" style="--bg: url(<?= $post['thumbnail']['url'] ?? '' ?>)">
                @if($post['main_category']['name_fa'] ?? false)
                    <span class="badge-light"><?=$post['main_category']['name_fa']?></span>
                @endif
                <span class="title"><?=to_persian_num($post['title'])?></span>
                <!-- <span class="content">
                                                    <small class="subtitle"><?=to_persian_date($post['created_at']['main'])?></small>
                                                </span> -->
                <div class="stats-row white opacity-50">
                    <span><i class="fa-regular fa-clock"></i>
                        <?=to_persian_date($post['created_at']['main'], "%d %B %Y")?></span>
                    <span><i class="fa-regular fa-comment"></i>
                        <?=to_persian_num(count($post['comments']))?> دیدگاه</span>
                    <span><i class="fa-regular fa-eye"></i>
                        <?=to_persian_num(171 + $post['meta']['views'])?> بازدید</span>
                </div>
            </div>
            <div class="content ck-content wpad tpad">
                <?=planetContentFilter($post['content']['full'])?>
                <div class="content-footer tpad">
                    <a class="btn" href="<?=site_url('pwa/dashboard')?>"><i class="fa-solid fa-house"></i> صفحه اصلی</a>
                    <a class="btn" href="<?=site_url('pwa/blog')?>"><i class="fa-solid fa-newspaper"></i> همه مقالات</a>
                </div>
            </div>


        </div>
    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module"  src="{{ getViteAssetUrl('resources/js/utilities/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages');
    @include('sdk.pwa._partials.scripts')

    <script>sendPostView(<?=$post['id']?>);</script>

</body>

</html>