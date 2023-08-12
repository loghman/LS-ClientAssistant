<?php

use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Router\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$router->post('/page-meta/updateForm', function (Request $request, Response $response){
    $pageMeta = API::post('v1/marketing/page-meta/updateForm', [
        'route_name' => $request->request->get('route_name'),
        'entity_type' => $request->request->get('entity_type'),
        'entity_id' => $request->request->get('entity_id'),
        'key' => $request->request->get('key'),
        'meta_type' => $request->request->get('meta_type'),
        'default_value' => $request->request->get('default_value') ?? '',
    ], ['Authorization: Bearer ' . $request->cookies->get('token')]);

    if (!$pageMeta['success']) {
        return $response->unprocessableEntity($pageMeta->get('message') ?? 'مشکلی رخ داده است.');
    }

    $response->getBody()->write(json_encode($pageMeta->toArray()));

    return $response->withHeader('Content-Type', 'application/json');
});
