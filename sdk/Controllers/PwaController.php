<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class PwaController
{
    public function manifest(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        $data = [
            'brand_name' => setting('brand_name_en'),
            'logo_url' => setting('logo_url'),
        ];
        return WebResponse::view('sdk.pwa.manifest',$data);
    }

    public function service_worker(Request $request)
    {
        header('Content-Type: application/javascript');
        $data = [
            'brand_name' => setting('brand_name_en'),
            'logo_url' => setting('logo_url'),
        ];
        return WebResponse::view('sdk.pwa.service-worker',$data);
    }

    public function offline(Request $request)
    {
        echo "<div style='text-align:center;margin-top:100px;'>شما آفلاین هستید<br>اینترنت خود را بررسی و متصل کنید</div>";
        return '';
    }

}
