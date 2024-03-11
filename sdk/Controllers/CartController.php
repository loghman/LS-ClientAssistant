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
            abort(404);
        }
    }

    public function checkout()
    {
        $cart = Cart::screen(['coupon', 'lmsProductItems.entity', 'lmsProductItems.coupon'])['data'] ?? [];
        $defaultGateway = Gateway::getDefault();

        $view = WebResponse::viewExist('salesflow.cart.index') ?
            'salesflow.cart.index' :
            'sdk.salesflow.cart.index';

        return WebResponse::view($view, compact('cart', 'defaultGateway'));
    }

    public function add(Request $request)
    {
        if (! User::loggedIn()) {
            return JsonResponse::unprocessableEntity(
                'ابتدا وارد شوید.',
                ['backUrl' => route('auth.index')]
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