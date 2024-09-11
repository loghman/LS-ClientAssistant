@if($cart && count($cart['items']) > 0)
    <div class="col-lg-7">
        <div class="d-flex flex-column gap-xs">
            @foreach($cart['items'] as $item)
                @php($title = $item['entity']['title'] ?? ($item['entity']['name_fa'] ?? ''))
                <div class="card position-relative">
                    <div class="card-row">
                        @if(!empty($item['entity']['icon_multi_color']))
                            <img src="{{ get_media_url($item['entity']['icon_multi_color']) }}" class="card-icon" alt="{{ $title }}">
                        @endif
{{--                        @isset($item['entity']['meta']['icon_multi_color'])--}}
{{--                            <img src="{{ $item['entity']['meta']['icon_multi_color'] }}" class="card-icon" alt="{{ $title }}">--}}
{{--                        @endisset--}}

                        <div class="card-column truncate">
                            <span class="card-heading truncate w-100">{{ $title }}</span>
                            @isset($item['entity']['items_count'])
                                <small class="card-subtitle truncate w-100">
                                    <span>شامل </span>
                                    {{ to_persian_num($item['entity']['items_count']) }}
                                    <span> جلسه آموزشی</span>
                                </small>
                            @endisset
                        </div>

                        <div class="card-row justify-content-end w-fit">
                            <small class="card-subtitle fa-number text-center w-fit">
                                <span>{{ $item['price'] === 0 ? 'رایگان' : number_format($item['price']).' تومان' }}</span>
                            </small>
                            <button type="button" data-jsc="modal#action-modal"
                                    class="delete btn circle gray si-cross-r sm flex-shrink-0"
                                    data-modal='{"action":"{{ site_url("cart/delete/{$item['id']}") }}","header":"حذف آیتم","message":"آیا قصد دارید این آیتم را حذف کنید؟","btn":"حذف"}'></button>
                        </div>
                    </div>
                </div>
            @endforeach

            <div id="pay-content">
                <div class="mt-5">
                    <i class="spinner me-auto ms-auto" style="--spinner-color: var(--primary); --spinner-size: 45px"></i>
                </div>
            </div>

        </div>
    </div>
@else
    <div class="col-xxl-5 col-lg-6">
        <div class="d-flex flex-column gap-xs">
            <div class="card padding-md align-items-center text-center">
                <div class="content">
                    <i class="card-icon si-shopping-basket-r text-secondary-50"></i>
                    <h3 class="card-heading">سبد شما خالی است</h3>
                    <p class="card-subtitle">شما می‌توانید با رفتن به صفحه دوره‌ها، دوره مد نظر خود را
                        انتخاب نمایید</p>
                </div>
                <div class="footer justify-content-center">
                    <a href="{{ route('lms.courses') }}" class="btn">مشاهده دوره‌ها</a>
                </div>
            </div>
        </div>
    </div>
@endif