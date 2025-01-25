<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\Payment;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Utilities\Modules\V3\Cart;
use Ls\ClientAssistant\Utilities\Modules\V3\Gateway;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\V3\Payment as V3Payment;
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

    public function qPay(Request $request, ?int $gateway = null)
    {
        $gateway = $gateway ?? Gateway::getDefault()['id'];
        $payback_url = $request->get('payback_url',site_url('payment/###payment_id###')); 
        $res = Payment::qPay(
            base64_decode($request->get('et')),
            (int)$request->get('ei'),
            $gateway,
            $payback_url,
            $request->get('coupon'),
        );
        if (!$res->get('success')) {
            $_SESSION['error_messages'] = (array)$res->get('message');
            return new RedirectResponse(route('pwa.myCourses'), 302, []);
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

    public function pwa_callback(int $paymentId, Request $request)
    {
        $logo = setting('logo_icon_url') ?? setting('logo_url') ?? '';
        $data = self::shered_data();
        $status = (int)$request->status;
        // get payment object here
        $payment = V3Payment::get($paymentId)['data'];
        $pagetitle = 'نتیجه پرداخت';
        return WebResponse::view('sdk.pwa.pages.payback', compact('data','status','logo','payment','pagetitle'));
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

    public function invoiceScreen(string $hashId)
    {
        $filter = ModuleFilter::new()
            ->includes('user', 'lmsProductItems', 'lmsProductItems.entity', 'payments', 'coupon');
        $invoice = Cart::get($hashId, $filter)->get('data');
        if (null === $invoice || empty($invoice['type']['name']) || $invoice['type']['name'] === 'CART') {
            abort(404);
        }

        return WebResponse::view(
            'sdk.salesflow.invoice.index',
            compact('invoice')
        );
    }

    private static function shered_data()
    {
        return [
            'brand_name'            => setting('brand_name_fa'),
            'logo_url'              => setting('logo_icon_url') ?? setting('logo_url') ?? '',
            'logotype_url'          => setting('logo_url') ?? setting('logo_icon_url') ?? '',
        ];
    }
}