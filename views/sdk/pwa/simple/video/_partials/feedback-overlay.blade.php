<div class="overlay" id="feedback-overlay">
    <div class="overlay-panel" data-pid="{{ $item->product_id }}" data-iid="{{ $item->id }}">
        <h2 class="side-title" style="font-size: 20px;">این جلسه چطور بود؟</h2>
        <p style="margin-bottom:30px;color:#333">پس از ثبت نظر به جلسه بعد منتقل میشید.</p>
        @foreach($item->videos_feedbacks_emojis as $emojy)
            <div class="erow emoji feedback-emojy" data-rate="{{ $emojy->key }}">
                <i class="fa-solid fa-face-grin-hearts" style=" color: {{$emojy->color}}; "></i>
                <span>{{ $emojy->title }}</span>
            </div>
        @endforeach
        <div class="goto-next" style="text-align: center;margin-top:10px;display: none;">در حال رفتن به جلسه بعدی ...</div>
        <!-- در زمان ارسال درخواست برای ثبت نظر این لودینگ نمایش داده شود -->
        <div class="loader" style="margin-top: 30px;display: none;"></div>
    </div>
</div>


<!-- منطق مورد انتظار ارسال درخوایت و ریدایرکت به جلسه بعد در کد زیر است. شبیه همین کار شود -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rateElements = document.querySelectorAll('.feedback-emojy');
        const gotoNext = document.querySelector('.goto-next');

        rateElements.forEach(element => {
            element.addEventListener('click', function() {
                const overlayPanel = document.querySelector('.overlay-panel');
                const loader = document.querySelector('.loader');
                const productId = overlayPanel.getAttribute('data-pid');
                const itemId = overlayPanel.getAttribute('data-iid');
                const rate = this.getAttribute('data-rate');
                loader.style.display = 'block';
                gotoNext.style.display = 'block'
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
                            gotoNext.style.display = 'none'
                            loader.style.display = 'none';
                            window.location.href = '{{ $item->next->url }}';
                        }, 700)
                    });
            });
        });
    });
</script>