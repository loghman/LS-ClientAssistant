<!doctype html>
<html lang="fa">
<head>
@include('sdk.pwa._partials.head')
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
        background-color: #ffffff;
    }
    .profile-content .profile-logout{
        background-color: #ffd3d7;
    }  
</style>
</head>
<body>
@include('sdk.pwa._partials.sidebar-desktop')
<div class="base-content">
    @include('sdk.pwa._partials.top-nav')

    <div class="profile-content">
        @if($user['avatar']['url'] ?? '')
            <img height="120" width="120" class="profile-image" src="<?=$user['avatar']['url'] ?? ''?>" alt="تصویر پروفایل شما">
        @endif
        <div class="profile-row"><?=($user['full_name'])?></div>
        <div class="profile-row"><?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?> روز با <?=$data['brand_name']?></div>
        <div class="profile-row"><?= to_persian_num($user['mobile']) ?></div>
        @if(count($courses))
        <a href="<?=site_url('pwa/my-courses')?>" class="profile-row"><?=to_persian_num(count($courses))?> دوره ثبت نام شده</a>
        @endif
        <a href="<?=site_url('pwa/logout')?>" class="profile-row profile-logout">خروج</a>
    </div>
    <div class="h200"></div>
</div>

@include('sdk.pwa._partials.bottom-nav')
@include('sdk._common.components.error-messages')


</body>
</html>
