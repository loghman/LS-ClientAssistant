<div class="container-fluid ls-client-hook-section-footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-7 col-10">
                <div class="ls-client-hook-section-form">
                    {!! $shapeArrow !!}
                    <div class="ls-client-hook-shape-image">
                        {!! $shapeImage !!}
                        <img src="{{ core_asset('resources/assets/img/clients/hook/download.svg') }}" alt="سون‌لرن" class="icon">
                    </div>
                    <h2 class="ls-client-hook-t-h2 ls-client-hook-text-center">
                        برای دریافت <span class="ls-client-hook-text-primary">چیت شیت پایتون</span>
                        <br>
                        فرم زیر رو پر کن
                    </h2>
                    <div class="ls-client-hook-shape-side top-horizontal ls-client-hook-w-100">
                        <div class="ls-client-hook-card">
                            <div class="ls-client-hook-input-group sm-convert-to-input">
                                <label>نام و نام خانوادگی</label>
                                <input type="text" placeholder="نام خود را وارد کنید ...">
                            </div>
                            <div class="ls-client-hook-input-group sm-convert-to-input">
                                <label>شماره موبایل</label>
                                <input type="text" placeholder="شماره موبایل را وارد کنید ...">
                            </div>
                            <div class="ls-client-hook-input-group sm-convert-to-input">
                                <label>ایمیل</label>
                                <input type="text" placeholder="ایمیل خود را وارد کنید ...">
                            </div>
                            <button class="ls-client-hook-btn magnet-bottom ls-client-hook-mx-auto" type="submit">
                                ارسال و دریافت <span class="ls-client-hook-d-flex ls-client-hook-d-none-md">چیت شیت پایتون</span>
                                {!! $iconArrowLeft !!}
                            </button>
                        </div>
                    </div>
                    <span class="ls-client-hook-t-title-sm ls-client-hook-text-center">پس از اسال فرم، <span class="ls-client-hook-text-primary">چیت شیت</span> به ایمیل شما ارسال خواهد شد</span>
                    {!! $shapeFooterLine !!}
                </div>
            </div>
        </div>
    </div>
    <div class="ls-client-hook-shape-bg">
        {!! $shapeFooter !!}
    </div>
    {!! $shapeFooterPattern !!}
</div>