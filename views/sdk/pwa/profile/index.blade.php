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
<div class="base-content">
    @include('sdk.pwa._partials.top-nav')

    <div class="profile-content">
        @if(get_media_url($user['avatar']) != '')
{{--        @if(!empty($user['avatar_url']))--}}
{{--        <img height="120" width="120" class="profile-image" src="<?=$user['avatar_url']?>" alt="تصویر پروفایل شما">--}}
        <img height="120" width="120" class="profile-image" src="<?=get_media_url($user['avatar'], get_default_media(\Ls\ClientAssistant\Utilities\Tools\Enums\MediaDefaultReplacementEnum::AVATAR), \Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum::MEDIUM_THUMBNAIL)?>" alt="تصویر پروفایل شما">
        @endif
        <div class="profile-row"><?=(strlen($user['display_name']) < 3 ? $user['real_name'] : $user['display_name'])?></div>
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