<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\V3\CmsPost;
use Ls\ClientAssistant\Utilities\Modules\V3\Enrollment as V3Enrollment;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PwaController
{
    public function dashboard(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();

        $enrollments = V3Enrollment::list(
            ModuleFilter::new()
                ->search('entity_type', 'lms_products')
                ->search('user_id', $user['id'])
                ->includes('entity')
                ->orderBy('last_log_date')->sortedBy('DESC')
        )->get('data');
        $pagetitle = "داشبورد";
        return WebResponse::view('sdk.pwa.dashboard.index', compact('pagetitle','user','enrollments','data'));
    }

    public function my_courses(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();

        $enrollments = V3Enrollment::list(
            ModuleFilter::new()
                ->search('entity_type', 'lms_products')
                ->search('user_id', $user['id'])
                ->includes('entity')
                ->perPage(500)
                ->orderBy('last_log_date')->sortedBy('DESC')
        )->get('data');

        $pagetitle = "دوره های من";
        return WebResponse::view('sdk.pwa.my-courses.index', compact('pagetitle','enrollments','data'));
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

        $pagetitle = "همه دوره ها";
        return WebResponse::view('sdk.pwa.my-courses.index', compact('pagetitle','courses','data'));
    }

    public function course_screen(Request $request,string $product_id)
    {
        $user = current_user();
        $user['isLmsManager'] = in_array('lms:update',$user['permissions']??[]) ? 1 : 0;
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();
        $key = "course($product_id)-with-chapters";
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = LMSProduct::get($product_id)['data'];
            $course['chapters'] = LMSProduct::chapters($product_id, $userToken)['data']['items'];
            $course = ObjectCache::write($key, $course);
        }
        $pagetitle = "{$course['title']}";
        return WebResponse::view('sdk.pwa.course-screen.index', compact('pagetitle','data','course','user'));
    } 
    public function item_screen(Request $request,string $product_id,string $item_id)
    {
        $user = current_user();
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();
        $key = "course($product_id)-with-chapters";
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = LMSProduct::get($product_id)['data'];
            $course['chapters'] = LMSProduct::chapters($product_id, $userToken)['data']['items'];
            $course = ObjectCache::write($key, $course);
        }
        $item = null;
        foreach ($course['chapters'] as $ch) {
            foreach ($ch['items'] as $i) {
                if($i['id'] == $item_id){
                    $item = $i;
                    break;
                }
            }
            if($item) break;
        }
        $pagetitle = "{$item['title']}";
        return WebResponse::view('sdk.pwa.pages.item-screen', compact('pagetitle','data','course','item'));
    } 
    public function course_screen_links(Request $request,string $product_id)
    {
        $user = current_user(); 
        $allowed_positions = ['platform_owner','marketing_manager','educational_manager','manager','system_admin'];
        if(count(array_intersect($allowed_positions,$user['positions_name_en']??[])) <=0){
            abort(404,'دسترسی برای شما مجاز نیست'); 
        }        
        $key = "course($product_id)-with-chapters";
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = LMSProduct::get($product_id)['data'];
            $course['chapters'] = LMSProduct::chapters($product_id, $request->cookies->get('token'))['data']['items'];
            $course = ObjectCache::write($key, $course);
        }
        $links[0] = ['id'=>'id','type'=>'type','title'=>'title','link'=>'link'];
        $row=1;
        foreach ($course['chapters'] as $chapter) {
            $links[$row++] = ['id'=>$chapter['id'],'type'=>'سرفصل','title'=>$chapter['title'],'link'=>''];
            foreach ($chapter['items'] as $item) {
                $links[$row++] = ['id'=>$item['id'],'type'=>'جلسه','title'=>$item['title'],'link'=>site_url("pwa/item/p{$item['product_id']}i{$item['id']}/screen")];
            }
        }
        $pagetitle = "لینک های دوره {$course['title']}";
        return WebResponse::view('sdk.pwa.pages.course-links', compact('pagetitle','course','links'));
    } 

    public function blog(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $filter = ModuleFilter::new()
        ->search('type','post')
        ->searchJoin('and')
        ->search('status','published') // published
        ->orderBy('id')->sortedBy('desc')
        ->perPage(20);

        if($request->get('keyword')){
            $posts['latest'] = CmsPost::list(
                $filter->search('title',"%".$request->get('keyword')."%",'like')->perPage(200)
                )->get('data');
        }else{
            $key = "blog-posts-20";
            if(obc_exists($key)){
                $posts = obc_get($key);
            }else{
                $posts['latest'] = CmsPost::list($filter)->get('data');
                $posts['featured'] = CmsPost::list($filter->perPage(10))->get('data');
                $posts = obc_write($key,$posts);
            }
        }
        $pagetitle = "وبلاگ " . $data['brand_name'];
        return WebResponse::view('sdk.pwa.blog.list', compact('pagetitle','data','posts'));
    } 
    
    public function blog_single(Request $request,string $post_id)
    {        
        $user = current_user();
        $data = self::shered_data();
        $key = "cmspost($post_id)";
        if(obc_exists($key)){
            $post = obc_get($key);
        }else{
            $post = obc_write($key, CmsPost::get($post_id,ModuleFilter::new()
                ->includes('comments','attachments'))->get('data')
            );
        }
        $pagetitle = $post['title'];
        return WebResponse::view('sdk.pwa.blog.single', compact('pagetitle','data','post'));
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
