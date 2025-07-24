<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Utilities\Modules\Authentication;

class AuthInformationController
{
    public function updateEmail(Request $request)
    {
        $response = Authentication::updateUserEmail($request->cookies->get('token'), $request->get('input'));
        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message'));
        }

        return JsonResponse::success($response->get('message'));
    }

    public function updateMobile(Request $request)
    {
        $response = Authentication::updateUserMobile($request->cookies->get('token'), $request->get('input'));
        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message'));
        }

        return JsonResponse::success($response->get('message'));
    }
}