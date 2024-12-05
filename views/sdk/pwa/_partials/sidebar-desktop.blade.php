<section class="sidebar" id="sidebar">
    <div class="sidelinks">
        {{-- <a href="<?= site_url('') ?>" class="homelink">
            <img src="<?=$data['logo_url']?>" alt="لوگو">
            <span><?=$data['brand_name']?></span>
        </a> --}}
        <a href="<?= site_url('pwa/dashboard') ?>">
            <i class="fa-solid fa-house"></i>
            <span>داشبورد</span>
        </a>
        <a href="<?= site_url('pwa/my-courses') ?>">
            <i class="fa-solid fa-play"></i>
            <span>دوره های من</span>
        </a>
        <a href="<?= site_url('pwa/courses') ?>">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>خرید</span>
        </a>
        <a href="<?= site_url('pwa/blog') ?>">
            <i class="fa-solid fa-layer-group"></i>
            <span>وبلاگ</span>
        </a>
        <a href="<?= site_url('pwa/profile') ?>">
            <i class="fa-solid fa-user"></i>
            <span>پروفایل</span>
        </a>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sidebar .sidelinks > a').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });

        let elementWithClass = document.querySelector('.base-content');
        let height = elementWithClass.offsetHeight;
        let elementWithId = document.getElementById('sidebar');
        elementWithId.style.height = height + 'px';
    });
</script>