<div class="overlay" data-qid="<?=$question['id']?>" data-qsecond="<?=$question['second']?>">
    <div class="overlay-panel" data-pid="{product-id-here}" data-iid="{item-id-here}">
        <h2 class="side-title" style="font-size: 20px;color:var(--primary)">متن سوال تعاملی اینجا، نظر تو در رابطه با ازدواج موقت <?=$question['id']?> چیست؟</h2>
        <p style="margin-bottom:30px;color:#999;">پاسخ بدید که بریم سراغ ادامه آموزش ...</p>
        <form action="">
            <label class="erow emoji">
                <input type="checkbox" name="q" value="{option_id}" class="icheck">
                <span>بسیار عالی است</span>
            </label>
            <label class="erow emoji">
                <input type="checkbox" name="q" value="{option_id}" class="icheck">
                <span>خجالت بکش!</span>
            </label>
            <label class="erow emoji">
                <input type="checkbox" name="q" value="{option_id}" class="icheck">
                <span>بستگی به کیسش داره اگر اندازه محمد گازری نباشه مشکلی باهاش ندارم.</span>
            </label>
            <label class="erow emoji">
                <input type="checkbox" name="q" value="{option_id}" class="icheck">
                <span>خیلی بد بود</span>
            </label>
            <div style="display: flex;align-content: space-between;align-items: baseline;">
                <span style="color:#999;margin-right: 5px;">۳ امتیاز</span>
                <button class="btn sm qbtn me-auto">ثبت پاسخ</button>
            </div>

        </form>
        <div class="loader" style="margin-top: 30px;display: block;"></div>

    </div>
</div>