@if (isset($uniqueId))
<div class="d-flex align-items-center w-100">
    <label class="ms-3" for="file{{$id}}">
        <input type="file" class="d-none uploader" data-collection_name={{$collectionName}} data-unique_id="{{$uniqueId}}" id="file{{$id}}" upload="false">
        <i class="si-folder-upload"></i>
        <span class="fw-700">آپلود فایل</span>
        <div  class="upload-progress">
            <div id="progress_bar_percent" class="progress-percent d-none"> % 0
            </div>
            <div id="progress_bar" class="progress">
                <div class="progress-bar"  style= "width: 0% "
                   ></div>
            </div>
        </div>
    </label>
    <small class="t-subtitle">(حداکثر {{ $maxSize }} کیلوبایت)</small>
</div>
@else
<div class="d-flex align-items-center w-100">
    <label class="ms-3" for="file{{$id}}">
        <input type="file" class="d-none uploader" data-collection_name={{$collectionName}} data-ei="{{$ei}}" data-et="{{$et}}" id="file{{$id}}" upload="false">
        <i class="si-folder-upload"></i>
        <span class="fw-700">آپلود فایل</span>
        <div  class="upload-progress">
            <div id="progress_bar_percent" class="progress-percent d-none"> % 0
            </div>
            <div id="progress_bar" class="progress">
                <div class="progress-bar"  style= "width: 0% "
                   ></div>
            </div>
        </div>
    </label>
    <small class="t-subtitle">(حداکثر {{ $maxSize }} کیلوبایت)</small>
</div>
@endif