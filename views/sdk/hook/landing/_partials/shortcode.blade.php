<div class="{{ $subClass }}card">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="{{ $subClass }}shape-side">
                <img class="banner" src="{{ core_asset('resources/assets/img/demo/hook-landing-banner.png') }}" alt="">
            </div>
        </div>
        <div class="col-lg-6">
            <h2 class="{{ $subClass }}t-h2 {{ $subClass }}t-hr">
                کتاب اصل گرایی
            </h2>
        </div>
    </div>
    <p class="{{ $subClass }}t-text">
        اصل‌گرایی چگونگی انجام کارهای بیشتر نیست، بلکه به معنای انجام کارهای درست است. به معنای انجام کارهای کمتر فقط محض کمتر بودنشان هم نیست. بدین معناست که برای فعالیت در بالاترین سطح اثربخشی‌مان تا می‌توانیم عاقلانه زمان و انرژی‌مان را فقط روی انجام کارهای ضروری سرمایه‌گذاری کنیم. اصل‌گرایی یعنی خلق سیستمی برای رسیدگی به کمد زندگی‌مان. اصل‌گرایی فرآیندی نیست که مثل مرتب کردن کمد، یک‌بار در سال، یک‌بار در ماه یا حتی یک‌بار در هفته زیر بارش برویم.
    </p>
    <span class="{{ $subClass }}t-title-sm {{ $subClass }}hr-line">
        برای دریافت <span class="{{ $subClass }}text-primary">چیت شیت پایتون</span> فرم زیر رو پر کن
    </span>
    <div class="grid-items">
        <input type="text" placeholder="نام و نام خانوادگی">
        <input type="text" placeholder="شماره موبایل را وارد کنید ...">
        <input type="text" placeholder="ایمیل خود را وارد کنید ...">
        <button class="{{ $subClass }}btn" type="submit">
            ارسال و دریافت <span class="{{ $subClass }}d-flex {{ $subClass }}d-none-md">چیت شیت پایتون</span>
            {!! $iconArrowLeft !!}
        </button>
    </div>
</div>