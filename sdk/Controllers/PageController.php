<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\CMS;

class PageController
{
    public function find(Request $request, $slug)
    {
        $response = get_or_fail(CMS::get($slug, ['comments', 'comments.user', 'comments.parent']), 'برگه مورد نظر یافت نشد');
        $page = $response['data'];
        if ($page['type'] != 'page') {
            abort(404, 'برگه مورد نظر یافت نشد');
        }

        if(!WebResponse::viewExist("pages.$slug.index")){
            WebResponse::view('sdk.pages.common', compact('page'));
        }

        WebResponse::view("pages.$slug.index", compact('page'));
    }
}