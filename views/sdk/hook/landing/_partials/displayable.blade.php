<button onclick="showModal('{{$shortLink}}')" class="{{ $subClass }}btn xs">
    نمایش
    <i class="si-chevron-left-r cta"></i>
</button>
<div class="modal full" id="recruitment-modal">
    <div class="card p-0 position-relative">
        <div class="close-btn-absolute close">
        </div>
        <iframe id="recruitment-iframe" width="100%"></iframe>
        <div class="d-flex justify-content-center">
            <a href="{{$shortLink}}" target="_blanck" class="{{ $subClass }}btn xs flex-grow-1 mt-1">دانلود فایل</a>
        </div>
    </div>
</div>