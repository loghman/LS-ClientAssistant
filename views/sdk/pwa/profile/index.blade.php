<!doctype html>
<html lang="fa">

<head>
    @include('sdk.pwa._partials.head')
    @include('sdk.pwa._partials.styles')
    <style>

        .profile-content {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: calc(var(--base-gap) / 1.5);
        }

        .profile-content>* {
            max-width: 500px;
            width: 100%;
        }

        .profile-content .profile-heading {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: calc(var(--base-gap) / 2);
        }

        .profile-content .profile-row {
            display: block;
            margin: 10px auto;
            padding: 10px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            background-color: #ffffff;
            border: solid 1px var(--primary-15);
            border-radius: var(--card-radius);
        }

        .profile-content .profile-logout {
            background-color: #ffd3d7;
        }

        @media (max-width: 800px) {
            .profile-content {
                padding-top: calc(var(--base-padding) * 2) !important;
                gap: var(--base-gap);
            }
        }
    </style>
</head>

<body>
    <div class="base-container">
        @include('sdk.pwa._partials.sidebar-desktop')
        <div class="base-content">
            @include('sdk.pwa._partials.top-nav')

            <div class="profile-content tpad wpad">
                @if($user['avatar']['url'] ?? '')
                    <div class="avatar-big mx-auto">
                        <img height="120" width="120" src="<?=$user['avatar']['url'] ?? ''?>" alt="تصویر پروفایل شما">
                    </div>
                @endif
                <div class="profile-heading"><?=($user['full_name'])?></div>
                <div>
                    <div class="profile-row">
                        <?= to_persian_num((new DateTime())->diff(new DateTime($user['created_at']))->days) ?>
                        روز با <?=$data['brand_name']?>
                    </div>
                    <div class="profile-row"><?= to_persian_num($user['mobile']) ?></div>
                    @if(count($courses))
                        <a href="<?=site_url('pwa/my-courses')?>" class="profile-row"><?=to_persian_num(count($courses))?>
                            دوره
                            ثبت نام
                            شده</a>
                    @endif
                </div>
                <a href="<?=site_url('pwa/logout')?>" class="btn danger">خروج از حساب کاربری</a>
            </div>
        </div>
    </div>

    @include('sdk.pwa._partials.bottom-nav')
    @include('sdk._common.components.error-messages')


</body>

</html>