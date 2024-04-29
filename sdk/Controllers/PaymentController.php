<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\Payment;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Utilities\Modules\V3\Gateway;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PaymentController
{
    public function __construct()
    {
        if (!Config::get('endpoints.enable_cart_payment')) {
            abort(404);
        }
    }

    public function requestLink(int $cart, int $gateway)
    {
        $res = Payment::requestLink($cart, $gateway, site_url('payment/###payment_id###'));

        if (!$res->get('success')) {
            $_SESSION['error_messages'] = (array)$res->get('message');

            return WebResponse::redirect('cart/checkout');
        }

        return new RedirectResponse($res['data']['link'], 302, []);
    }

    public function qPay(Request $request, ?int $gateway)
    {
        $gateway = $gateway ?? Gateway::getDefault()['id'];
        $res = Payment::qPay(
            base64_decode($request->get('et')),
            (int)$request->get('ei'),
            $gateway,
            site_url('payment/###payment_id###'),
            $request->get('coupon'),
        );

        if (!$res->get('success')) {
            $_SESSION['error_messages'] = (array)$res->get('message');

            return new RedirectResponse(route('landing.mini', $request->get('slug')), 302, []);
        }

        return new RedirectResponse($res['data']['link'], 302, []);
    }

    public function callback(int $paymentId, Request $request)
    {
        if ((int)$request->status === 0) {
            return WebResponse::redirect("payment/failed/$paymentId");
        }

        return WebResponse::redirect("payment/succeed/$paymentId");
    }

    public function successForm(int $paymentId, Request $request)
    {
        $payment = Payment::check($paymentId, Payment::PAGE_SUCCESS);

        if (!$payment['success']) {
            return WebResponse::redirect();
        }

        $view = WebResponse::viewExist('salesflow.payment.payment-success') ?
            'salesflow.payment.payment-success' :
            'sdk.salesflow.payment.payment-success';

        return WebResponse::view($view, [
            'message' => $request->get('message'),
            'payment' => $payment['data'],
        ]);
    }

    public function failureForm(int $paymentId)
    {
        $payment = Payment::check($paymentId, Payment::PAGE_FAILED);
        if (!$payment['success']) {
            return WebResponse::redirect();
        }

        $view = WebResponse::viewExist('salesflow.payment.payment-failed') ?
            'salesflow.payment.payment-failed' :
            'sdk.salesflow.payment.payment-failed';

        return WebResponse::view($view, ['payment' => $payment['data']]);
    }
}