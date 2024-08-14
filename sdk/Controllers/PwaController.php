<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class PwaController
{
    public function manifest(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        return WebResponse::view('sdk.pwa.manifest', $this->getManifestData());
    }

    public function service_worker(Request $request)
    {
        header('Content-Type: application/javascript');
        return WebResponse::view('sdk.pwa.service-worker', $this->getManifestData());
    }

    public function getManifestData(): array
    {
        $logo_url = empty(setting('logo_icon_url')) ? setting('logo_url') : setting('logo_icon_url');
        $mime_type = get_headers($logo_url, 1)['Content-Type'];
        return [
            'brand_name' => setting('brand_name_en'),
            'theme_color' => '#ffffff',
            'logo_url' => $logo_url,
            'mime_type' => $mime_type
        ];
    }

    public function offline(Request $request)
    {
        echo "<div style='text-align:center;margin-top:100px;'>شما آفلاین هستید<br>اینترنت خود را بررسی و متصل کنید</div>";
        return '';
    }
}
