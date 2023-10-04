<?php

use Ls\ClientAssistant\Core\API;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Middlewares\AuthMiddleware;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\TaskManager;

$router->post('/page-meta/updateForm', function (Request $request) {
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

$router->get('clearcache/{client_key}', function (Request $request, $clientKey) {
    if ($clientKey == $GLOBALS['apikey']) {
        clear_static_cache();
        clear_redis_cache();

        return JsonResponse::success('کش پاک شد');
    }

    return JsonResponse::unprocessableEntity('کلید نامعتبر');
})->middleware(AuthMiddleware::class);

$router->get('robots.txt', function (Request $request) {
    $setting = setting('client_robots_txt');
    return empty($setting) ? abort(404, 'صفحه مورد نظر یافت نشد.') : $setting;
});

$router->post('workflow/task-store', function (Request $request) {
    $response = TaskManager::store($request->get('workflow'), [
        'entity_type' => $request->get('entity_type'),
        'entity_id' => $request->get('entity_id'),
        'full_name' => $request->get('full_name'),
        'mobile' => $request->get('mobile'),
        'email' => $request->get('email'),
        'variable_values' => $request->get('var'),
        'time2call' => $request->get('time2call'),
        'source' => $request->get('source'),
    ]);

    if (!$response->get('success')) {
        return JsonResponse::unprocessableEntity($response->get('message') ?? 'مشکلی رخ داده است.');
    }

    return JsonResponse::success('درخواست شما با موفقیت ثبت شد، به زودی با شما تماس خواهیم گرفت.');
})->name('workflow.task.store');

$router->get('/form/{workflow}', function (string $workflow, Request $request) {
    $response = TaskManager::formData($workflow);
    if (!$response->get('success')) {
        abort(404);
    }

    $courses = LMSProduct::search('', ['id', 'title', 'slug'], [], 5000);
    if (!$courses->get('success')) {
        $courses = [];
    }
    $courses = collect($courses->get('data')['data'])->pluck('title', 'id')->toArray();

    return WebResponse::view(
        'workflow.form',
        [
            'title' => $request->get('title'),
            'entityType' => $request->get('et'),
            'entityId' => $request->get('ei'),
            'source' => $request->get('source'),
            'workflowData' => $response->get('data'),
            'courses' => $courses,
            'backUrl' => $request->header('referer') ?? site_url('')
        ]
    );
})->name('pages.consultation');