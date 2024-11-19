<div class="overlay" id="question-overlay-{{ $question->id }}" data-answerd="false">
    <div class="overlay-panel">
        <h2 class="side-title" style="font-size: 20px;color:var(--primary)">
            {!! $question->question !!}
        </h2>
        <p style="margin-bottom:30px;color:#999;">پاسخ بدید که بریم سراغ ادامه آموزش ...</p>
        <form action="{{ $question->answer_url }}" style="margin-bottom: 30px;" onsubmit="return submitQuestion(event)"
              data-qid="{{ $question->id }}">
            @foreach($question->options as $index => $option)
                <label class="erow emoji">
                    <input type="radio" name="answer" value="{{ $index }}" class="icheck">
                    <span>{{ $option->text }}</span>
                </label>
            @endforeach
            <div style="display: flex;align-content: space-between;align-items: baseline;">
                <span style="color:#999;margin-right: 5px;">{{ to_persian_num($question->point) }} امتیاز</span>
                <button class="btn sm qbtn me-auto">ثبت پاسخ</button>
            </div>

        </form>
        <div class="loader" style="display: none;"></div>
        <div class="qa-response">
            <div class="ajResponse success" style="display: none;">پاسخ شما درست بود.<br>{{ to_persian_num($question->point) }} امتیاز دریافت کردید.</div>
            <div class="ajResponse danger" style="display: none;">متاسفانه پاسخ شما اشتباه بود.</div>
            <div class="ajResponse pending" style="display: none;">ممنون از ثبت پاسخ شما</div>
        </div>
    </div>
</div>

<script>
    async function submitQuestion(event) {
        event.preventDefault()
        const form = event.target;

        const qid = form.getAttribute('data-qid')
        const answerUrl = form.getAttribute('action')

        const parent = document.querySelector('#question-overlay-'+qid)

        let loader = form.closest('div').querySelector('.loader')
        let answerCorrect = form.closest('div').querySelector('.ajResponse.success')
        let answerIncorrect = form.closest('div').querySelector('.ajResponse.danger')
        let answerPending = form.closest('div').querySelector('.ajResponse.pending')

        loader.style.display = 'block';

        let chooses = []
        form.querySelectorAll("input[type='radio']").forEach(element => {
            if (element.checked) {
                chooses.push(element.value)
            }
        })

        const res = await fetch(answerUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                answer: chooses
            })
        }).finally(() => {
            loader.style.display = 'none';
        })

        const data = await res.json();
        if (res.status == 422) {
            alert(data.message);
            return;
        }

        if (res.status == 200) {
            if (data.data.correct) {
                answerCorrect.style.display = 'block';
            }
            if(data.data.incorrect) {
                answerIncorrect.style.display = 'block';
            }
            if(data.data.pending) {
                answerPending.style.display = 'block';
            }
        }
        parent.setAttribute('data-answerd', true)

        setTimeout(function () {
            playAndHideQuestion(qid)
        }, 2000)
    }
</script>
