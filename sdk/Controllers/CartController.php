<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\Cart;
use Ls\ClientAssistant\Utilities\Modules\Coupon;
use Ls\ClientAssistant\Utilities\Modules\User;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Utilities\Modules\V3\Gateway;

class CartController
{
    public function __construct()
    {
        if (! Config::get('endpoints.enable_cart_payment')) {
            abort(403, 'Payment system is disabled.');
        }
    }

    public function checkout(Request $request)
    {
        $response = get_or_fail(
            Cart::screen(['coupon', 'lmsProductItems.entity', 'lmsProductItems.coupon'])
        );
        $cart = $response['data'] ?? [];
        $defaultGateway = Gateway::getDefault([], $request->get('gateway'));
        $view = WebResponse::viewExist('salesflow.cart.index') ?
            'salesflow.cart.index' :
            'sdk.salesflow.cart.index';

        return WebResponse::view($view, compact('cart', 'defaultGateway'));
    }

    public function gateways(Request $request)
    {
        $response = get_or_fail(
            Cart::screen(['coupon', 'lmsProductItems.entity', 'lmsProductItems.coupon'])
        );
        $cart = $response['data'] ?? [];
        $gateways = Gateway::list()->get('data');
        $defaultGateway = Gateway::getDefault($gateways, $request->get('gateway'));
        $eligibleResponse = [];
        $snapPay = Gateway::findSnapPay($gateways);
        if (null !== $snapPay) {
            $price = $snapPay['isDiscountAvailable'] ? $cart['final_price'] : $cart['total_price'];
            $eligibleResponse = Gateway::snapPayEligible($price)->get('data');
        }
        $html = WebResponse::renderView(
            'sdk.salesflow.cart._partials._cart-pay',
            compact('cart', 'gateways', 'snapPay', 'defaultGateway', 'eligibleResponse')
        );

        return JsonResponse::success('', compact('html'));
    }

    public function add(Request $request)
    {
        if (! User::loggedIn()) {
            return JsonResponse::unprocessableEntity(
                'ابتدا وارد شوید.',
                ['backUrl' => setting('client_auth_index', route('auth.index')) . "?refer=" . request()->url()]
            );
        }

        $response = get_or_fail(
            Cart::addItem(
                base64_decode($request->get('et')),
                (int) $request->get('ei'),
                $request->get('coupon'),
                $request->getClientIp()
            )
        );

        return JsonResponse::success(
            $response->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }

    public function delete(Request $request, $itemId)
    {
        $response = get_or_fail(
            Cart::deleteItem($itemId)
        );

        return JsonResponse::success($response->get('message'));
    }

    public function applyCoupon(Request $request, $cart)
    {
        $response = get_or_fail(
            Coupon::apply(
                $request->cookies->get('token'),
                $cart,
                $request->request->get('coupon')
            )
        );

        return JsonResponse::success(
            $response->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }

    public function unapplyCoupon(Request $request, $cart, $coupon)
    {
        $response = get_or_fail(
            Coupon::unapply(
                $request->cookies->get('token'),
                $cart,
                $coupon
            )
        );

        return JsonResponse::success(
            $response->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }
}