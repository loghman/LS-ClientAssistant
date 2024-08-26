<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Tools\Token;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PwaController
{
    public function dashboard(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();

        $key = __FILE__.__LINE__.$user['id'];
        if(ObjectCache::exists($key)){
            $courses = ObjectCache::get($key);
        }else{
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        self::sleep(); 
        $pagetitle = "داشبورد";
        return WebResponse::view('sdk.pwa.dashboard.index', compact('pagetitle','user','courses','data'));
    }

    public function my_courses(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $key = __FILE__.__LINE__.$user['id'];
        if(0 and ObjectCache::exists($key)){    // cache is disabled!!!!!!
            $courses = ObjectCache::get($key);
        }else{
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        self::sleep(); 
        $pagetitle = "دوره های من";
        return WebResponse::view('sdk.pwa.my-courses.index', compact('pagetitle','courses','data'));
    }

    public function courses(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $key = __FILE__.__LINE__.$user['id'];
        if(0 and ObjectCache::exists($key)){    // cache is disabled!!!!!!
            $courses = ObjectCache::get($key);
        }else{
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        self::sleep(); 
        $pagetitle = "همه دوره ها";
        return WebResponse::view('sdk.pwa.my-courses.index', compact('pagetitle','courses','data'));
    }

    public function course_screen(Request $request,string $product_id)
    {
        $user = current_user();
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();
        $key = __FILE__.__LINE__.$product_id;
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = ObjectCache::write($key, LMSProduct::get($product_id)['data']);
        }
        $chapters = LMSProduct::chaptersWithUserData($product_id, $userToken)['data'];
        $enrollment = Enrollment::findByUserAndProduct($product_id, $userToken)['data'] ?? [];
        $pagetitle = "{$course['title']}";
        return WebResponse::view('sdk.pwa.course-screen.index', compact('pagetitle','data','course','chapters','enrollment'));
    } 

    public function profile(Request $request)
    {    
        $user = current_user();
        $user['avatar_url'] = str_replace('s=80','s=240',$user['avatar_url']);
        $data = self::shered_data();
        $key = __FILE__.__LINE__.$user['id'];
        if(ObjectCache::exists($key)){ 
            $courses = ObjectCache::get($key);
        }else{
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        self::sleep(1200); 
        $pagetitle = "پروفایل من";
        return WebResponse::view('sdk.pwa.profile.index', compact('pagetitle','user','courses','data'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Authentication::logout();
        setcookie('token','',time()-9999,'/',".{$_SERVER['HTTP_HOST']}");
        User::clearUserKeyCookie();
        return new RedirectResponse(site_url('pwa/auth'), 302, []);
    }

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
        $data = self::shered_data();
        $data['theme_color'] = '#ffffff';
        $data['mime_type'] = $mime_type;
        return $data;
    }

    public function offline(Request $request)
    {
        echo "<div style='text-align:center;margin-top:100px;'>شما آفلاین هستید<br>اینترنت خود را بررسی و متصل کنید</div>";
        return '';
    }

    private static function shered_data(){
        return [
            'brand_name' => setting('brand_name_fa'),
            'logo_url' => setting('logo_url'),
        ];
    }
    private static function sleep($ms = 700){
        usleep($ms*1000); // delay for display loading animation in front
    }
    
}
