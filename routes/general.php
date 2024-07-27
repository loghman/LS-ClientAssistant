<?php

use Ls\ClientAssistant\Controllers\AuthVerificationController;
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

$router->name('auth.')->prefix('auth')->group(function (Router $router){
    $router->get('/', [AuthController::class, 'index']);
});

$router->name('onboarding.')->prefix('onboarding')->group(function (Router $router){
    $router->get('/', [OnboardingController::class, 'index']);

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
    ], ['Authorization: Bearer ' . $request->cookies->get('token')]);

    if (!$pageMeta['success']) {
        return JsonResponse::unprocessableEntity($pageMeta->get('message') ?? 'مشکلی رخ داده است.');
    }

    return JsonResponse::json($pageMeta->toArray()['success'], 200, $pageMeta->toArray()['data']);
});

$router->name('cache.clear')->get('clearcache/{client_key}', function (Request $request, $clientKey) {
    if ($clientKey == $GLOBALS['apikey']) {
        clear_static_cache();
        clear_redis_cache();

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

$router->get('/{slug}', [PageController::class, 'find']);