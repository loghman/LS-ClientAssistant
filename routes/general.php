<?php

use Ls\ClientAssistant\Core\API;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Cache;
use Ls\ClientAssistant\Core\Middlewares\AuthMiddleware;
use \Ls\ClientAssistant\Core\Router\JsonResponse;

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