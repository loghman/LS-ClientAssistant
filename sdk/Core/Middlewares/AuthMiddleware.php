<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        if (!User::loggedIn()) {
            redirect(site_url('auth'));
        }

        if (in_array($request->getUri(), [
            site_url('auth/logout'), site_url('verification-fields/verify'),
            site_url('auth/email/update'), site_url('auth/mobile/update')
        ])) {
            return $next($request);
        }

        $verificationFields = get_verification_fields();
        if (
            (in_array('email', $verificationFields) && !User::emailVerified()) ||
            (in_array('mobile', $verificationFields) && !User::mobileVerified())
        ) {
            redirect(
                setting('user_have_access_to_panel', false) ?
                    core_url('verification-fields/verify') : site_url('verification-fields/verify')
            );
        }

        return $next($request);
    }
}