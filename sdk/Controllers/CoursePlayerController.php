<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;

class CoursePlayerController
{
    public function index(Request $request,string $product_id)
    {
        $user = current_user();
        if(is_null($user))
            redirect(site_url());
        $userToken = $request->cookies->get('token');

        $data = [
            'brand_name' => setting('brand_name_fa'),
            'logo_url' => setting('logo_url'),
        ];

        // $start = microtime(true);
        $key = __FILE__.__LINE__;
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = ObjectCache::write($key, LMSProduct::get($product_id)['data']);
        }

        $chapters = LMSProduct::chaptersWithUserData($product_id, $userToken)['data'];
        $enrollment = Enrollment::findByUserAndProduct($product_id, $userToken)['data'] ?? [];
        // echo (microtime(true) - $start) . 'ms';

        return WebResponse::view('sdk.pwa.course-player.index', compact('data','course','chapters','enrollment'));

    }
}
