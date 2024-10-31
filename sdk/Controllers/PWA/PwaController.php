<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\V3\CmsPost;
use Ls\ClientAssistant\Utilities\Modules\V3\Enrollment as V3Enrollment;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct as V3LMSProduct;
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
        return WebResponse::view('sdk.pwa.dashboard.index', compact('pagetitle', 'user', 'enrollments', 'data'));
    }

    public function courses(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $key = 'LmsOnSaleCourses';
        if (ObjectCache::exists($key)) {    // cache is disabled!!!!!!
            $courses = ObjectCache::get($key);
        } else {
            $courses = V3LMSProduct::list(
                ModuleFilter::new()
                    ->search('is_on_sale', '1')
                    ->perPage(500)
                    ->orderBy('id')->sortedBy('DESC')
            )->get('data');
            $courses = ObjectCache::write($key, $courses ?? []);
        }
        // dd($courses[1]);

        $pagetitle = "لیست محصولات";
        return WebResponse::view('sdk.pwa.shopping.course-list', compact('pagetitle', 'courses', 'data'));
    }
    public function course(Request $request, string $slug)
    {
        $user = current_user();
        $user['isLmsManager'] = in_array('lms:update', $user['permissions'] ?? []) ? 1 : 0;
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();

        $key = "course($slug)-land";
        if (ObjectCache::exists($key)) {
            $course = ObjectCache::get($key);
        } else {
            $course = V3LMSProduct::get(
                $slug,
                ModuleFilter::new()
                    ->includes('mainTeacherFaculty')
                    ->withCounts('items')
            )->get('data');
            if (is_null($course['id'])) {
                return new RedirectResponse(site_url('pwa/courses'), 302, []);
            }
            unset($course['enrollment'], $course['resume_item']);
            $course['chapters'] = LMSProduct::chapters($course['id'], $userToken)['data']['items'];
            foreach ($course['chapters'] as $i => $ch)
                if (!$ch['is_published'] || !is_null($ch['deleted_at']) || $ch['type_en'] != 'chapter')
                    unset($course['chapters'][$i]);
            $course = ObjectCache::write($key, $course);
        }
        // dd($course);
        // dd($course['teacherFaculty']);
        $pagetitle = "{$course['title']}";
        return WebResponse::view('sdk.pwa.shopping.course-single', compact('pagetitle', 'data', 'course', 'user'));
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
        return WebResponse::view('sdk.pwa.my-courses.index', compact('pagetitle', 'enrollments', 'data'));
    }

    public function course_screen(Request $request, string $product_id)
    {
        $user = current_user();
        $user['isLmsManager'] = in_array('lms:update', $user['permissions'] ?? []) ? 1 : 0;
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();
        $key = "course($product_id)-with-chapters";
        if (ObjectCache::exists($key)) {
            $course = ObjectCache::get($key);
        } else {
            $course = LMSProduct::get($product_id)['data'];
            $course['chapters'] = LMSProduct::chapters($product_id, $userToken)['data']['items'];
            $course = ObjectCache::write($key, $course);
        }
        $pagetitle = "{$course['title']}";
        return WebResponse::view('sdk.pwa.course-screen.index', compact('pagetitle', 'data', 'course', 'user'));
    }
    public function item_screen(Request $request, string $product_id, string $item_id)
    {
        $user = current_user();
        $userToken = $request->cookies->get('token');
        $data = self::shered_data();
        $key = "course($product_id)-with-chapters";
        if (ObjectCache::exists($key)) {
            $course = ObjectCache::get($key);
        } else {
            $course = LMSProduct::get($product_id)['data'];
            $course['chapters'] = LMSProduct::chapters($product_id, $userToken)['data']['items'];
            $course = ObjectCache::write($key, $course);
        }
        $item = null;
        foreach ($course['chapters'] as $ch) {
            foreach ($ch['items'] as $i) {
                if ($i['id'] == $item_id) {
                    $item = $i;
                    break;
                }
            }
            if ($item) break;
        }
        $pagetitle = "{$item['title']}";
        return WebResponse::view('sdk.pwa.pages.item-screen', compact('pagetitle', 'data', 'course', 'item'));
    }

    public function blog(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $filter = ModuleFilter::new()
            ->search('type', 'post')
            ->searchJoin('and')
            ->search('status', 'published') // published
            ->orderBy('id')->sortedBy('desc')
            ->perPage(20);

        if ($request->get('keyword')) {
            $posts['latest'] = CmsPost::list(
                $filter->search('title', "%" . $request->get('keyword') . "%", 'like')->perPage(200)
            )->get('data');
        } else {
            $key = "blog-posts-20";
            if (obc_exists($key)) {
                $posts = obc_get($key);
            } else {
                $posts['latest'] = CmsPost::list($filter)->get('data');
                $posts['featured'] = CmsPost::list($filter->perPage(10))->get('data');
                $posts = obc_write($key, $posts);
            }
        }
        unset($posts['latest']['meta'], $posts['featured']['meta']);
        $pagetitle = "وبلاگ " . $data['brand_name'];
        return WebResponse::view('sdk.pwa.blog.list', compact('pagetitle', 'data', 'posts'));
    }

    public function blog_single(Request $request, string $post_id)
    {
        $user = current_user();
        $data = self::shered_data();
        $key = "cmspost($post_id)";
        if (obc_exists($key)) {
            $post = obc_get($key);
        } else {
            $post = obc_write(
                $key,
                CmsPost::get($post_id, ModuleFilter::new()
                    ->includes('comments', 'attachments'))->get('data')
            );
        }
        $pagetitle = $post['title'];
        return WebResponse::view('sdk.pwa.blog.single', compact('pagetitle', 'data', 'post'));
    }

    public function profile(Request $request)
    {
        $user = current_user();
        $data = self::shered_data();
        $key = __FILE__ . __LINE__ . $user['id'];
        if (ObjectCache::exists($key)) {
            $courses = ObjectCache::get($key);
        } else {
            $courses = ObjectCache::write($key, User::courses($request->cookies->get('token'))['data']['data'] ?? []);
        }
        unset($user['password'], $user['national_code']);
        $pagetitle = "پروفایل من";
        return WebResponse::view('sdk.pwa.profile.index', compact('pagetitle', 'user', 'courses', 'data'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Authentication::logout();
        setcookie('token', '', time() - 9999, '/', ".{$_SERVER['HTTP_HOST']}");
        User::clearUserKeyCookie();
        return new RedirectResponse(site_url('pwa/auth'), 302, []);
    }

    public function add_post_views(Request $request)
    {
        if(!$request->has('pid'))
            return;
        $post_id = $request->get('pid');
        if(!is_numeric($post_id))
            return;
        CMS::signal($post_id, 'views', 1);
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
        // $logo_url = empty(setting('logo_icon_url')) ? setting('logo_url') : setting('logo_icon_url');
        // $mime_type = get_headers($logo_url, 1)['Content-Type'];
        // $data['mime_type'] = $mime_type;
        $data = self::shered_data();
        $data = array_merge($data,[
            // 'pwa_orientation'       => setting('pwa_orientation'),
            // 'pwa_display'           => setting('pwa_display'),
            // 'pwa_dir'               => setting('pwa_dir'),
            'pwa_icon_512_maskable' => setting('pwa_icon-512-maskable'),
            'pwa_icon-512'          => setting('pwa_icon-512'),
            'pwa_icon_192_maskable' => setting('pwa_icon-192-maskable'),
            'pwa_icon_192'          => setting('pwa_icon-192'),
            'pwa_lang'              => setting('pwa_lang'),
            'pwa_scope'             => setting('pwa_scope'),
            'pwa_theme_color'       => setting('pwa_theme_color'),
            'pwa_background_color'  => setting('pwa_background_color'),
            'pwa_start_url'         => setting('pwa_start_url'),
            'pwa_description'       => setting('pwa_description'),
            'pwa_short_name'        => setting('pwa_short_name'),
            'pwa_name'              => setting('pwa_name'),
        ]);
        return $data;
    }

    public function offline(Request $request)
    {
        echo "<div style='text-align:center;margin-top:100px;'>شما آفلاین هستید<br>اینترنت خود را بررسی و متصل کنید</div>";
        return '';
    }

    private static function shered_data()
    {
        return [
            'brand_name'            => setting('brand_name_fa'),
            'logo_url'              => setting('logo_icon_url') ?? setting('logo_url') ?? '',
        ];
    }
    private static function sleep($ms = 700)
    {
        usleep($ms * 1000); // delay for display loading animation in front
    }
}