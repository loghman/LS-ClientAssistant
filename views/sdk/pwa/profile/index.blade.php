@section('title', 'پروفایل من')
        <!doctype html>
<html lang="fa">
<head>
    @include('sdk.pages.landing-partials.head')
    @include('sdk.pwa._partials.styles')
    <style>
    .profile-content{
        text-align: center;
    }
    .profile-content .profile-image{
        border-radius: 50%;
        margin:30px auto;
    }
    .profile-content .profile-row{
        display: block;
        margin: 10px 30px;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        background-color: #f7f7f7;
    }
    .profile-content .profile-logout{
        background-color: #ffd3d7;
    }  
</style>
</head>
<body>
<div class="base-content">
    <div class="navbar">
        <a href="{{ site_url('') }}" class="brand">
            <img src="{{ $data['logo_url'] }}" alt="{{ $data['brand_name'] }}">
        </a>
    </div>
    <div class="card-status" style="margin-top:70px">
        <span class="title">پروفایل من</span>
        <small class="subtitle">
        <?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?> روز با <?=$data['brand_name']?>
        </small>
    </div>
    <div class="profile-content">
        @if(!empty($user['avatar_url']))
        <img height="120" width="120" class="profile-image" src="<?=$user['avatar_url']?>" alt="تصویر پروفایل شما">
        @endif
        <div class="profile-row"><?=(strlen($user['display_name']) < 3 ? $user['real_name'] : $user['display_name'])?></div>
        <div class="profile-row"><?= to_persian_num($user['mobile']) ?></div>
        @if(count($courses))
        <a href="<?=site_url('pwa/my-courses')?>" class="profile-row"><?=to_persian_num(count($courses))?> دوره ثبت نام شده</a>
        @endif
        <a href="<?=site_url('pwa/logout')?>" class="profile-row profile-logout">خروج</a>
    </div>
    <div class="h200"></div>
</div>

@include('sdk.pwa._partials.bottom-nav')
<script type="module" src="{{ core_asset('resources/assets/js/jquery.js') }}"></script>
<script type="module" src="{{ core_asset('resources/assets/minimal-landing/js/client.js') }}"></script>
@include('sdk._common.components.error-messages')


</body>
</html>