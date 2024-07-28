<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\User;



class MyCoursesController
{
    public function index(Request $request)
    {
        $user = current_user();
        if(is_null($user))
            redirect(site_url());

        $data = [
            'brand_name' => setting('brand_name_fa'),
            'logo_url' => setting('logo_url'),
        ];

        // $start = microtime(true);
        $key = __FILE__.__LINE__.$user['id'];
        if(ObjectCache::exists($key)){
            $courses = ObjectCache::get($key);
        }else{
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        // echo (microtime(true) - $start) . 'ms';

        return WebResponse::view('sdk.pwa.my-courses.index', compact('courses','data'));
    }

}