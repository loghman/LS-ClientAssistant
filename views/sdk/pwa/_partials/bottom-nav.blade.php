<?php 
    echo $_SERVER['PHP_SELF'];

?>

<nav class="bottom-nav">
    <a class="bnavi" href="<?=site_url('pwa/profile')?>">
        <i class="fa-solid fa-user"></i>
        <span>پروفایل</span>
    </a>
    <a class="bnavi" href="<?=site_url('pwa/blog')?>">
    <i class="fa-solid fa-layer-group"></i>
        <span>وبلاگ</span>
    </a>
    <!-- <a class="bnavi" href="<?=site_url('pwa/courses')?>">
        <i class="fa-solid fa-cart-shopping"></i>
        <span>خرید</span>
    </a>  -->
    <a class="bnavi" href="<?=site_url('pwa/my-courses')?>">
        <i class="fa-solid fa-play"></i>
        <span>دوره های من</span>
    </a>
    <a class="bnavi" href="<?=site_url('pwa/dashboard')?>">
        <i class="fa-solid fa-house"></i>
        <span>داشبورد</span>
    </a>
</nav>

<div id="pageloader">
    <img src="{{ $data['logo_url'] }}" alt="{{ $data['brand_name'] }}">
    <div id="typewriter"></div>
</div>

<script>

    const quotes = [
        "با صبر، هر شبی به صبح می‌رسد",
        "با صبر، هر صفحه ای باز می شود ;)",
        "با صبر، هر تاریکی به نور می‌رسد",
        "صبر کن تا گشایش حاصل شود",
        "با صبر، تلخی‌ها به شیرینی تبدیل می‌شوند",
        "صبر کلید موفقیت است",
        "صبر، بهترین معلم زندگی است",
        "صبر کن، زمان همه چیز را حل می‌کند",
        "صبوری، نشانه خردمندی است",
        "صبر کلید گشایش تمام درهاست",
        "صبوری، هنر زندگی است",
        "صبر، مادر تمام موفقیت‌هاست",
        "صبر تلخ است، ولی میوه‌اش شیرین",
        "با صبر، همه چیز ممکن می‌شود",
        "صبر، زیباترین فضیلت انسان است",
        "صبر، نشانه قدرت روح است",
        "صبر، کلید گشایش درهای بسته است",
        "صبر، راه رسیدن به آرامش است",
        "گر صبر کنی ز غوره حلوا سازی",
        "گر صبر کنی ز غوره حلوا سازی",
        "گر صبر کنی ز غوره حلوا سازی",
        "گر صبر کنی ز غوره حلوا سازی",
        "گر صبر کنی ز غوره حلوا سازی",
    ];

    document.querySelectorAll('.bnavi').forEach(function(element) {
        element.addEventListener('click', function(event) {
            // const sabrText = quotes[Math.floor(Math.random() * quotes.length)];
            const pageloader = document.getElementById('pageloader');
            pageloader.classList.add('show');
            // typeWriter(sabrText + "", "typewriter", 30);
        });
    });
    document.querySelectorAll('.fnavi').forEach(function(element) {
        element.addEventListener('submit', function(event) {
            const pageloader = document.getElementById('pageloader');
            pageloader.classList.add('show');
            document.activeElement.blur();
        });
    });

    document.querySelectorAll('.bottom-nav .bnavi').forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>