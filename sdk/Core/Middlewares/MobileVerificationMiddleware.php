<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class MobileVerificationMiddleware
{
    public function handle($request, $next)
    {
        if (!User::loggedIn()) {
            return $next($request);
        }

        if ($request->is(
            'auth/logout',
            'verification-fields/verify',
            'auth/email/update',
            'auth/mobile/update'
        )) {
            return $next($request);
        }

        $verificationFields = get_verification_fields();
        if (in_array('mobile', $verificationFields) && !User::mobileVerified()) {
            $refer = $request->url();
            redirect(
                setting('user_have_access_to_panel', false)
                    ? core_url("verification-fields/verify?refer={$refer}")
                    : site_url("verification-fields/verify?refer={$refer}")
            );
        }

        return $next($request);
    }
}