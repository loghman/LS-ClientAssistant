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
        $cart = Cart::screen(['coupon', 'lmsProductItems.entity', 'lmsProductItems.coupon'])['data'] ?? [];
        $defaultGateway = Gateway::getDefault([], $request->get('gateway'), $cart['final_price']);
        $view = WebResponse::viewExist('salesflow.cart.index') ?
            'salesflow.cart.index' :
            'sdk.salesflow.cart.index';

        return WebResponse::view($view, compact('cart', 'defaultGateway'));
    }

    public function gateways(Request $request)
    {
        $cart = Cart::screen(['coupon', 'lmsProductItems.entity', 'lmsProductItems.coupon'])['data'] ?? [];
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

        $res = Cart::addItem(
            base64_decode($request->get('et')),
            (int) $request->get('ei'),
            $request->get('coupon'),
            $request->getClientIp()
        );

        if (! $res->get('success')) {
            return JsonResponse::unprocessableEntity($res->get('message') ?? '');
        }

        return JsonResponse::success(
            $res->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }

    public function delete(Request $request, $itemId)
    {
        $res = Cart::deleteItem($itemId);
        if (! $res->get('success')) {
            return JsonResponse::unprocessableEntity($res->get('message') ?? '');
        }

        return JsonResponse::success($res->get('message'));
    }

    public function applyCoupon(Request $request, $cart)
    {
        $res = Coupon::apply(
            $request->cookies->get('token'),
            $cart,
            $request->request->get('coupon')
        );

        if (! $res->get('success')) {
            return JsonResponse::unprocessableEntity($res->get('message') ?? '');
        }

        return JsonResponse::success(
            $res->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }

    public function unapplyCoupon(Request $request, $cart, $coupon)
    {
        $res = Coupon::unapply(
            $request->cookies->get('token'),
            $cart,
            $coupon
        );

        if (! $res->get('success')) {
            return JsonResponse::unprocessableEntity($res->get('message') ?? '');
        }

        return JsonResponse::success(
            $res->get('message'),
            ['backUrl' => route('cart.checkout')]
        );
    }
}