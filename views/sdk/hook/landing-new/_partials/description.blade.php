<div class="container-fluid {{ $subClass }}section-description">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-sm-12 col-11">
                <div class="{{ $subClass }}truncate-toggle {{ $subClass }}line-clamp">
                    <div class="{{ $subClass }}t-tags compact {{ $subClass }}toggle-content">
                        {!! $hook['description']['full'] !!}
                    </div>
                    <div class="{{ $subClass }}toggle-btn">
                        {!! $iconArrowBottomCircle !!}نمایش بیشتر
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="{{ $subClass }}shape-svg-pattern description">
        {!! $shapePatternB !!}
    </div>

    {!! $shapeFooterPattern !!}
</div>