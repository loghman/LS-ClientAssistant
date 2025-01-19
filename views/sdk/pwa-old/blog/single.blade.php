<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
@include('sdk.pwa._partials.styles')
<style>
    button:hover, .btn:hover {
        opacity: 0.8;
        background: var(--primary) !important;
        border-color: var(--primary) !important;
    }

    .card-product .title{
        font-size: 22px;
        padding-bottom: 8px;
    }

    .bghead{
        position: relative;
        min-height: 100%;
        padding-top: 150px !important;
        padding-bottom: 40px !important;
        background-size: cover !important;
        background: linear-gradient(0deg, var(--primary-50), rgba(0,0,0,0.4)), url(<?= $post['thumbnail']['url'] ?? '' ?>);
    }
    .bghead .pbar{
        position: absolute;
        top:20px;
        left:20px;
    }
    </style>
</head>

<body>
    @include('sdk.pwa._partials.sidebar-desktop')

    <div class="base-content">
        <div class="card-status bghead m-0 shadow-inset pt pb">
            <div>
                <span class="content">
                    <span class="text">
                        @if($post['main_category']['name_fa']??false)
                        <span class="badge-light"><?=$post['main_category']['name_fa']?></span><br>
                        @endif
                        <span class="title" style="font-size: 24px;"><?=to_persian_num($post['title'])?></span><br>
                        <!-- <span class="content">
                            <small class="subtitle"><?=to_persian_date($post['created_at']['main'])?></small>
                        </span> -->
                    </span>
                </span>
            </div>
        </div>
        <div class="stats-row wpad">
            <span><i class="fa-regular fa-clock"></i> <?=to_persian_date($post['created_at']['main'],"%d %B %Y")?></span>
            <span><i class="fa-regular fa-comment"></i> <?=to_persian_num(count($post['comments']))?> دیدگاه</span>
            <span><i class="fa-regular fa-eye"></i> <?=to_persian_num(171 + $post['meta']['views'])?> بازدید</span>
        </div>
        <div class="content wpad">
            <?=planetContentFilter($post['content']['full'])?>
            <div class="content-footer">
                <a href="<?=site_url('pwa/dashboard')?>"><i class="fa-solid fa-house"></i> صفحه اصلی</a>
                <a href="<?=site_url('pwa/blog')?>"><i class="fa-solid fa-newspaper"></i> همه مقالات</a>
            </div>
        </div>


    </div>
    @include('sdk.pwa._partials.bottom-nav')
    <script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
    <script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
    @include('sdk._common.components.error-messages');
    @include('sdk.pwa._partials.scripts')

<script>sendPostView(<?=$post['id']?>);</script>

</body>

</html>
