<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\V3\Authentication;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\Payment;

class QPayController
{
    public function index(Request $request)
    {
        $userLoggedIn = User::loggedIn();
        $otpLength = setting('_env_sms_verification_code_length');
        $backUrl = $request->headers->get('referer');
        $data = $request->all();
        $uniqueKey = $request->mobile ?? $request->email;
        $data['unique_key'] = $uniqueKey;
        $data['step'] = null;

        if (!$userLoggedIn && !$uniqueKey || !$request->entity_id || !$request->entity_type || !$request->gateway) {
            $message = 'اطلاعات ارسال شده نامعتبر است.';
            return WebResponse::view('sdk.salesflow.qpay.index', compact('message', 'backUrl', 'otpLength', 'data'));
        }

        $response = LMSProduct::get($request->entity_id, null, 'id', true);
        if (! $response->get('success')) {
            $message = $response->get('message');
            return WebResponse::view('sdk.salesflow.qpay.index', compact('message', 'backUrl', 'otpLength', 'data'));
        }
        $product = $response->get('data');
        $data['coupon'] = isset($product['primaryCampaign']) ? $product['primaryCampaign']['coupon_label'] : null;

        $data['step'] = $userLoggedIn ? 'makeCart' : 'auth';

        if (! $userLoggedIn) {
            $response = Authentication::sendToken($uniqueKey);
            if (! $response->get('success')) {
                $message = $response->get('message');
                return WebResponse::view('sdk.salesflow.qpay.index', compact('message', 'backUrl', 'otpLength', 'data'));
            }
        }

        return WebResponse::view('sdk.salesflow.qpay.index', compact('backUrl', 'otpLength', 'data'));
    }

    public function sendToken(Request $request)
    {
        if (! $request->unique_key) {
            return JsonResponse::unprocessableEntity('اطلاعات ارسال شده نامعتبر است.');
        }

        $response = Authentication::sendToken($request->unique_key);

        return JsonResponse::json(
            $response->get('message'),
            $response->get('status_code'),
            $response->get('success') ? $response->get('data') : $response->get('errors', [])
        );
    }

    public function auth(Request $request)
    {
        $response = Authentication::auth($request->all());

        return JsonResponse::json(
            $response->get('message'),
            $response->get('status_code'),
            $response->get('success') ? $response->get('data') : $response->get('errors', [])
        );
    }

    public function pay(Request $request)
    {
        if (!$request->entity_id || !$request->entity_type || !$request->gateway) {
            return JsonResponse::unprocessableEntity('اطلاعات ارسال شده نامعتبر است.');
        }

        $response = Payment::qPay(
            $request->entity_type,
            $request->entity_id,
            (int)$request->gateway,
            site_url('payment/###payment_id###'),
            $request->coupon
        );

        return JsonResponse::json(
            $response->get('message'),
            $response->get('status_code'),
            $response->get('success') ? $response->get('data') : $response->get('errors', [])
        );
    }
}