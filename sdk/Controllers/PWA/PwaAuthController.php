<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class PwaAuthController
{
    public function step1(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $pagetitle = "ورود به " . $data['brand_name'];
        return WebResponse::view('sdk.pwa.simple.auth.step1', compact('pagetitle','data'));
    }

    private static function shered_data()
    {
        return [
            'brand_name'            => setting('brand_name_fa'),
            'logo_url'              => setting('logo_icon_url') ?? setting('logo_url') ?? '',
            'logotype_url'          => setting('logo_url') ?? setting('logo_icon_url') ?? '',
        ];
    }
}