<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;

class MiniLandingController
{
    public function index(Request $request, string $slug)
    {
        dd(LMSProduct::get($slug));

        return WebResponse::view('sdk.mini-landing.index');
    }
}