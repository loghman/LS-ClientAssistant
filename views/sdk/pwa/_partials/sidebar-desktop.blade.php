<section class="sidebar" id="sidebar">
    <a href="<?= site_url('') ?>" class="homelink">
        <img src="<?=$data['logo_url']?>" alt="<?=$data['brand_name']?>">
        <span><?=$data['brand_name']?></span>
    </a>
    <div class="sidelinks">
        <a href="<?= site_url('pwa/dashboard') ?>">
            <i class="far fa-house"></i>
            <span>داشبورد</span>
        </a>
        <a href="<?= site_url('pwa/my-courses') ?>">
            <i class="far fa-play"></i>
            <span>دوره های من</span>
        </a>
        <a href="<?= site_url('pwa/courses') ?>">
            <i class="far fa-cart-shopping"></i>
            <span>خرید</span>
        </a>
        <a href="<?= site_url('pwa/blog') ?>">
            <i class="far fa-layer-group"></i>
            <span>وبلاگ</span>
        </a>
        <a href="<?= site_url('pwa/profile') ?>">
            <i class="far fa-user"></i>
            <span>پروفایل</span>
        </a>
        <a class="mt-auto" href="<?=site_url('pwa/logout')?>">
            <i class="far fa-sign-out"></i>
            <span>خروج</span>
        </a>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.sidebar .sidelinks > a').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

    });
</script>