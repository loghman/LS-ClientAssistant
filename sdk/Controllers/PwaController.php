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
}
