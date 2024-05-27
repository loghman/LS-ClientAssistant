<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Utilities\Modules\User;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if($request->ajax()){
            if (!User::loggedIn()) {
                return JsonResponse::forbidden('ابتدا لاگین کنید');
            }
        }

        if (!User::loggedIn()) {
            redirect(site_url('auth'));
        }

        if ($request->is(
            'auth/logout',
            'verification-fields/verify',
            'auth/email/update',
            'auth/mobile/update'
        )) {
            return $next($request);
        }

        return $next($request);
    }
}