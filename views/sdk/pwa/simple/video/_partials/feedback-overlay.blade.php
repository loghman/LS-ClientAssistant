<div class="overlay" id="feedback-overlay">
    <div class="overlay-panel" data-pid="{product-id-here}" data-iid="{item-id-here}">
        <h2 class="side-title" style="font-size: 20px;">این جلسه چطور بود؟</h2>
        <p style="margin-bottom:30px;color:#333">پس از ثبت نظر به جلسه بعد منتقل میشید.</p>
            <div class="erow emoji" data-rate="5">
                <i class="fa-solid fa-face-grin-hearts" style=" color: #04ad0a; "></i>
                <span>عالی بود</span>
            </div>
            <div class="erow emoji" data-rate="4">
                <i class="fa-solid fa-face-smile" style=" color: #117ec1; "></i>
                <span>خوب بود</span>
            </div>
            <div class="erow emoji" data-rate="3">
                <i class="fa-solid fa-face-meh" style=" color: #3d3f3d; "></i>
                <span>نسبتا خوب بود</span>
            </div>
            <div class="erow emoji" data-rate="2">
                <i class="fa-solid fa-face-frown" style=" color: #c18b11; "></i>
                <span>بد بود</span>
            </div>
            <div class="erow emoji" data-rate="1">
                <i class="fa-solid fa-face-angry" style=" color: #c12511; "></i>
                <span>خیلی بد بود</span>
            </div>
            <!-- در زمان ارسال درخواست برای ثبت نظر این لودینگ نمایش داده شود -->
            <div class="loader" style="margin-top: 30px;display: none;"></div>
    </div>
</div>


<!-- منطق مورد انتظار ارسال درخوایت و ریدایرکت به جلسه بعد در کد زیر است. شبیه همین کار شود -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rateElements = document.querySelectorAll('.erow');
    rateElements.forEach(element => {
        element.addEventListener('click', function() {
            const overlayPanel = document.querySelector('.overlay-panel');
            const loader = document.querySelector('.loader');
            const productId = overlayPanel.getAttribute('data-pid');
            const itemId = overlayPanel.getAttribute('data-iid');
            const rate = this.getAttribute('data-rate');
            loader.style.display = 'block';
            fetch('YOUR_ENDPOINT_HERE', {
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
            .then(response => response.json())
            .then(data => {
                loader.style.display = 'none';
                window.location.href = 'YOUR_REDIRECT_URL(NEXT_ITEM_URL)';
            })
            .catch(error => {
                window.location.href = 'YOUR_REDIRECT_URL(NEXT_ITEM_URL)';                
            });
        });
    });
});
</script>