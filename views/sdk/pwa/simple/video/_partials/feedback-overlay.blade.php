<div class="overlay" id="feedback-overlay">
    <div class="overlay-panel" data-pid="{{ $item->product_id }}" data-iid="{{ $item->id }}">
        <span class="close"><i class="fa-solid fa-xmark"></i></span>
        <h2 class="side-title" style="font-size: 20px;">این جلسه چطور بود؟</h2>
        <p style="margin-bottom:30px;margin-top: 5px;color:#333">پس از ثبت نظر به جلسه بعد منتقل می شوید.</p>
        @foreach($item->videos_feedbacks_emojis as $emojy)
            <div class="erow emoji feedback-emojy" data-rate="{{ $emojy->key }}">
                <i class="fa-solid {{ $emojy->fa_icon }}" style=" color: {{$emojy->color}}; "></i>
                <span>{{ $emojy->title }}</span>
            </div>
        @endforeach
        <!-- در زمان ارسال درخواست برای ثبت نظر این لودینگ نمایش داده شود -->
        <div class="loader" style="display: none;"></div>
        <div class="goto-next"
            style="display:none;text-align: center; margin-top: 10px; bottom: var(--base-padding); font-weight: 600; z-index: 100000000000; position: fixed; width: 100%; right: 0; color: white; font-size: 16px;justify-content:center">
            در حال ثبت و رفتن به جلسه بعدی
            ...</div>
    </div>
</div>


<!-- منطق مورد انتظار ارسال درخوایت و ریدایرکت به جلسه بعد در کد زیر است. شبیه همین کار شود -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rateElements = document.querySelectorAll('.feedback-emojy');
        const gotoNext = document.querySelector('.goto-next');

        rateElements.forEach(element => {
            element.addEventListener('click', function () {
                const overlayPanel = document.querySelector('.overlay-panel');
                const loader = document.querySelector('.loader');
                const productId = overlayPanel.getAttribute('data-pid');
                const itemId = overlayPanel.getAttribute('data-iid');
                const rate = this.getAttribute('data-rate');
                loader.style.display = 'flex';
                gotoNext.style.display = 'flex'
                fetch('{{ $item->reaction_url }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        item_id: itemId,
                        rate: rate
                    })
                })
                    .finally(error => {
                        signalRequest(itemId, 'completed')
                        setTimeout(function () {
                            // gotoNext.style.display = 'none'
                            // loader.style.display = 'none';
                            window.location.href = '{{ $item->next ? $item->next->url : '' }}';
                        }, 700)
                    });
            });
        });
    });
</script>