<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\User;

class AuthVerificationController
{
    public function form()
    {
        dd($request->cookie(Authentication::authReferer));
        $user = User::getCurrent()['data'];
        $verificationFields = get_verification_fields();
        $emailVerified = User::emailVerified();
        $mobileVerified = User::mobileVerified();
        if (
            (!in_array('email', $verificationFields) || $emailVerified) &&
            (!in_array('mobile', $verificationFields) || $mobileVerified)
        ) {
            return WebResponse::redirect();
        }

        return WebResponse::view('sdk.auth.verify',
            compact('verificationFields', 'emailVerified', 'mobileVerified', 'user'));
    }

    public function send(Request $request)
    {
        $response = Authentication::sendVerificationCode(
            $request->get('input'),
            ['g-recaptcha-response' => $request->get('g-recaptcha-response')]
        );
        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message'));
        }

        return JsonResponse::success($response->get('message'));
    }

    public function verify(Request $request)
    {
        $response = Authentication::verifyVerificationFields(
            $request->cookies->get('token'),
            $request->get('input'),
            $request->get('otp'),
            ['g-recaptcha-response' => $request->get('g-recaptcha-response')]
        );
        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message'));
        }
        $backUrl = $request->cookie(Authentication::authReferer);
        setcookie('auth_referer', '', time() - 3600, '/', get_cookie_domain(), is_production_environment());
        file_put_contents(__DIR__.'/log.json',json_encode([($backUrl ? ['backUrl' => $backUrl] : [] )]));
        return JsonResponse::success($response->get('message'), [($backUrl ? ['backUrl' => $backUrl] : [] )]);
    }
}