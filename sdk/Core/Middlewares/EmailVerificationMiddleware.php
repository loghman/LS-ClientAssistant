<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class EmailVerificationMiddleware
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
        if (in_array('email', $verificationFields) && !User::emailVerified()) {
            $refer = $request->url();
            redirect(
                site_url("verification-fields/verify?refer={$refer}")
            );
        }

        return $next($request);
    }
}