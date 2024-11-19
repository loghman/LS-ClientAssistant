<?php
use Ls\ClientAssistant\Controllers\PWA\PwaSimpleController;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Core\StaticCache;
use Ls\ClientAssistant\Controllers\AuthController;
use Ls\ClientAssistant\Controllers\AuthVerificationController;
use Ls\ClientAssistant\Controllers\OnboardingController;
use Ls\ClientAssistant\Controllers\PageController;
use Ls\ClientAssistant\Controllers\PanelController;
use Ls\ClientAssistant\Controllers\WorkflowFormController;
use Ls\ClientAssistant\Controllers\CartController;
use Ls\ClientAssistant\Controllers\PaymentController;
use Ls\ClientAssistant\Controllers\HookController;
use Ls\ClientAssistant\Core\API;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Middlewares\AuthMiddleware;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Illuminate\Routing\Router;
use Ls\ClientAssistant\Controllers\MiniLandingController;
use Ls\ClientAssistant\Controllers\SiteMapController;

use Ls\ClientAssistant\Controllers\PWA\PwaController;
use Ls\ClientAssistant\Controllers\PWA\AjaxController;
use Ls\ClientAssistant\Controllers\PWA\CoursePlayerController;
use Ls\ClientAssistant\Controllers\PWA\MyCoursesController;
use Ls\ClientAssistant\Core\Middlewares\PwaMiddleware;

$router->name('sitemap.')->group(function(Router $router) {
    $router->name('index')
    ->get('/sitemap.xml', [SiteMapController::class, 'sitemap']);
    
    $router->name('static')
    ->get('/sitemap-static.xml', [SiteMapController::class, 'staticSiteMap']);
    
    $router->name('posts')
    ->get('/sitemap-posts.xml', [SiteMapController::class, 'postsSiteMap']);
    
    $router->name('pages')
    ->get('/sitemap-pages.xml', [SiteMapController::class, 'pagesSiteMap']);
    
    $router->name('products')
    ->get('/sitemap-lms-products.xml', [SiteMapController::class, 'lmsProductsSiteMap']);

    $router->name('hooks')
    ->get('/sitemap-hooks.xml', [SiteMapController::class, 'siteMapHooks']);
});


$router->name('landing.mini')->prefix('course')->group(function (Router $router){
    $router->get('{slug}/m', [MiniLandingController::class, 'index']);

    $router->name('.payment.details')
        ->post('{slug}/m/pay-details', [MiniLandingController::class, 'payDetails']);
});

$router->name('landing.quick.pay')->prefix('course')->group(function (Router $router){
    $router->get('{slug}/q', [MiniLandingController::class, 'quickPay']);
});

$router->name('panel.')->prefix('sdk/panel')->group(function (Router $router){
    $router->name('courses')->get('courses', [PanelController::class, 'panelCourses']);
    $router->name('course')->get('course', [PanelController::class, 'panelCourse']);
});

$router->name('hook.')->prefix('hook')->group(function (Router $router) {
    $router->name('landing')->get('/{slug}', [HookController::class, 'landing']);

    $router->name('download')->post('/{slug}/download', [HookController::class, 'download']);

    $router->name('signal')->post('/{slug}/signal', [HookController::class, 'signal']);
});

$router->name('verification.')->group(function (Router $router) {
    $router->name('send.code')
        ->post('/send/verification-code', [AuthVerificationController::class, 'send']);

    $router->name('fields.form')
        ->get('/verification-fields/verify', [AuthVerificationController::class, 'form'])
        ->middleware(AuthMiddleware::class);

    $router->name('fields.verify')
        ->post('/verification-fields/verify', [AuthVerificationController::class, 'verify'])
        ->middleware(AuthMiddleware::class);
});

$router->name('pageEditor.store')->post('/page-meta/updateForm', function (Request $request) {
    $pageMeta = API::post('v1/marketing/page-meta/updateForm', [
        'route_name' => $request->request->get('route_name'),
        'entity_type' => $request->request->get('entity_type'),
        'entity_id' => $request->request->get('entity_id'),
        'key' => $request->request->get('key'),
        'meta_type' => $request->request->get('meta_type'),
        'default_value' => $request->request->get('default_value') ?? '',
    ]);

    if (!$pageMeta['success']) {
        return JsonResponse::unprocessableEntity($pageMeta->get('message') ?? 'مشکلی رخ داده است.');
    }

    return JsonResponse::json($pageMeta->toArray()['success'], 200, $pageMeta->toArray()['data']);
});

$router->name('cache.clear')->get('clearcache/{client_key}', function (Request $request, $clientKey) {
    if ($clientKey == $GLOBALS['apikey']) {
        clear_redis_cache();
        ObjectCache::flush();
        StaticCache::flush();
        return JsonResponse::success('کش پاک شد');
    }

    return JsonResponse::unprocessableEntity('کلید نامعتبر');
})->middleware(AuthMiddleware::class);

$router->name('robots')->get('robots.txt', function (Request $request) {
    $setting = setting('client_robots_txt');
    return empty($setting) ? abort(404, 'صفحه مورد نظر یافت نشد.') : $setting;
});

$router->name('pages.consultation')
    ->get('/form/{workflow}', [WorkflowFormController::class, 'prepareForm']);

$router->name('workflow.task.store')
    ->post('workflow/task-store', [WorkflowFormController::class, 'store']);

$router->name('cart.')->prefix('cart')->group(function (Router $router) {
    $router->name('checkout')
        ->get('/checkout', [CartController::class, 'checkout'])
        ->middleware(AuthMiddleware::class);

    $router->name('checkout.gateways')
        ->post('/checkout/gateways', [CartController::class, 'gateways'])
        ->middleware(AuthMiddleware::class);

    $router->name('add')->post('/add', [CartController::class, 'add']);

    $router->name('delete')
        ->post('/delete/{itemId}', [CartController::class, 'delete'])
        ->middleware(AuthMiddleware::class);
});

$router->name('coupon.')->prefix('coupon')->middleware(AuthMiddleware::class)->group(function (Router $router) {
    $router->name('apply')
        ->post('/apply/{cart}', [CartController::class, 'applyCoupon']);

    $router->name('unapply')
        ->post('/unapply/{cart}/{coupon}', [CartController::class, 'unapplyCoupon']);
});

$router->name('payment.')->prefix('payment')->group(function (Router $router) {
    $router->name('requestLink')
        ->get('/request-link/{cart}/{gateway}', [PaymentController::class, 'requestLink']);

    $router->name('qPay')
        ->get('/quick/pay/{gateway?}', [PaymentController::class, 'qPay'])
        ->middleware(AuthMiddleware::class);

    $router->name('callback')
        ->get('/{paymentId}', [PaymentController::class, 'callback']);

    $router->name('successForm')
        ->get('/succeed/{paymentId}', [PaymentController::class, 'successForm']);

    $router->name('failureForm')
        ->get('/failed/{paymentId}', [PaymentController::class, 'failureForm']);
});


$router->get('manifest.json', [PwaController::class, 'manifest']);  
// $router->get('site.webmanifest', [PwaController::class, 'manifest']);  
$router->get('service-worker.js', [PwaController::class, 'service_worker']);  
$router->name('pwa.')->prefix('pwa')->group(function (Router $router){
    $router->name('auth')->get('/auth', [AuthController::class, 'index']);
    $router->name('onboarding')->get('/onboarding', [OnboardingController::class, 'index'])->middleware(PwaMiddleware::class);
    $router->name('dashboard')->get('dashboard', [PwaController::class, 'dashboard'])->middleware(PwaMiddleware::class);
    $router->name('myCourses')->get('my-courses', [PwaController::class, 'my_courses'])->middleware(PwaMiddleware::class);
    $router->name('courseScreen')->get('course-{pid}/screen', [PwaController::class, 'course_screen'])->middleware(PwaMiddleware::class);
    $router->name('itemScreen')->get('item/p{pid}i{iid}/screen', [PwaController::class, 'item_screen']);
    
    $router->name('simple.')->prefix('simple')->group(function (Router $router){
        // video
        $router->name('video')->get('/video/{item_id}/screen', [PwaSimpleController::class, 'video_screen']);
        // quiz
        $router->name('quiz.start')->get('/quiz/{item_id}/start', [PwaSimpleController::class, 'quiz_start']);
        $router->name('quiz.screen')->get('/quiz/{item_id}/screen', [PwaSimpleController::class, 'quiz_screen']);
        $router->name('quiz.result')->get('/quiz/{item_id}/result', [PwaSimpleController::class, 'quiz_result']);
        
        // practice
        // $router->name('practice.screen')->get('/practice/{item_id}/screen', [PwaSimpleController::class, 'practice_screen']);
        // $router->name('practice.result')->get('/practice/{item_id}/result', [PwaSimpleController::class, 'practice_result']);
        // opus
        // $router->name('opus.form')->get('/opus/{product_id}/form', [PwaSimpleController::class, 'opus_form']);

    });

    $router->name('courses')->get('courses', [PwaController::class, 'courses'])->middleware(PwaMiddleware::class); 
    $router->name('course')->get('course/{slug}', [PwaController::class, 'course'])->middleware(PwaMiddleware::class); 
    $router->name('cart')->get('cart', [PwaController::class, 'cart'])->middleware(PwaMiddleware::class); 
    $router->name('payback')->get('payback/{payment_id}', [PaymentController::class, 'pwa_callback'])->middleware(PwaMiddleware::class); 

    $router->name('blog')->get('blog', [PwaController::class, 'blog'])->middleware(PwaMiddleware::class); 
    $router->name('blog.single')->get('blog/{id}', [PwaController::class, 'blog_single'])->middleware(PwaMiddleware::class); 
    $router->name('blog.single.addviews')->post('add-post-views', [PwaController::class, 'add_post_views']);
    $router->name('profile')->get('profile', [PwaController::class, 'profile'])->middleware(PwaMiddleware::class);
    $router->name('logout')->get('logout', [PwaController::class, 'logout']); 
    $router->name('offline')->get('/offline.html', [PwaController::class, 'offline']);
});

$router->name('ajax.')->prefix('ajax')->group(function (Router $router){
    $router->name('item')->get('item', [AjaxController::class, 'item']);
    $router->name('item.signal')->get('item/signal', [AjaxController::class, 'itemSignal']);
    $router->name('enrollment.logs')->get('enrollment/{eid}/logs', [AjaxController::class, 'enrollmentLogs']);
    $router->name('myCourses.stats')->get('my-courses/stats', [AjaxController::class, 'myCoursesStats']);
    $router->name('item.reaction')->post('item/reaction', [AjaxController::class, 'itemReaction']);
    $router->name('quiz.answer')->post('/{quiz_id}/{question_id}/answer', [AjaxController::class, 'quizAnswer']);
});



// this route must be at the end of file
$router->get('/{slug}', [PageController::class, 'find']);
