
@extends('vue-apps.views._partials.base')
@section('content')
<script>
function getBackUrl() {
    const cookies = document.cookie.split('; ');
    for (let cookie of cookies) {
        const [key, value] = cookie.split('=');
        if (key === 'auth_backurl') {
            return decodeURIComponent(value); // مقدار کوکی را برمی‌گرداند
        }
    }
    return '/pwa/dashboard'; 
}
</script>
<div class="section-auth" id="app">
</div>
@endsection

