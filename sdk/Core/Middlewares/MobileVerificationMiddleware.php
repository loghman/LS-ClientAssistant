<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class MobileVerificationMiddleware
{
    public function handle($request, $next)
    {
        $verificationFields = get_verification_fields();
        if (in_array('mobile', $verificationFields) && !User::mobileVerified()) {
            redirect(
                setting('user_have_access_to_panel', false)
                    ? core_url('verification-fields/verify')
                    : site_url('verification-fields/verify')
            );
        }

        return $next($request);
    }
}