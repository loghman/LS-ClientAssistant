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

        if (in_array($request->getUri(), ['/auth/logout', '/auth/verify', '/auth/email/update', '/auth/mobile/update'])) {
            return $next($request);
        }

        $verificationFields = get_verification_fields();
        if (
            (in_array('email', $verificationFields) && !User::emailVerified()) ||
            (in_array('mobile', $verificationFields) && !User::mobileVerified())
        ) {
            redirect(site_url('auth/verify'));
        }

        return $next($request);
    }
}