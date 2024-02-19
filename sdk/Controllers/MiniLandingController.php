<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;

class MiniLandingController
{
    public function index(Request $request, string $slug)
    {
        $product = LMSProduct::get($slug)['result'];
        if(!$product){
            abort(404, 'محصول پیدا نشد');
        }

        $brandNameEn = setting('brand_name_en');

        $currentUser= current_user();
        return WebResponse::view('sdk.mini-landing.index', compact('product', 'brandNameEn', 'currentUser'));
    }
}