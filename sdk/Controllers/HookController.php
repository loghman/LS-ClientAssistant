<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\Hook;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Utilities\Tools\Token;

class HookController
{
    public function landing(Request $request, $slug)
    {
        $hook = Hook::get($slug)['result']['data'][0][0];
        $user = current_user();

        if(!$hook){
            abort(404, 'قلاب پیدا نشد');
        }

        if (empty($user) && $hook['fields']['conditions']['required_login']) {
            Token::token($hook['id'], 'from_hook')->weeks()->save();
        }

        if ($request->cookies->has('from_hook') && $hook['fields']['conditions']['required_login'] && !empty($user)) {
            Token::token($hook['id'], 'from_hook')->remove();
        }

        WebResponse::view('sdk.hook.landing', compact('hook', 'user'));
    }


    public function download(Request $request, $slug)
    {
        $hook = Hook::get($slug)['result']['data'][0][0];
        if (!$hook) {
            return JsonResponse::notFound('هوک پیدا نشد');
        }

        $user = current_user();
        if (empty($user) && $hook['fields']['conditions']['required_login']) {
            return JsonResponse::badRequest('ابتدا وارد حساب کاربری خود شود', [
                'backUrl' => route('auth.index')
            ]);
        }

        $data = [
            'full_name' => $request->get('full_name'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
        ];

        $response = Hook::sendFile($hook['id'], $data);

        if (!$response['status']) {
            return JsonResponse::badRequest('لطفا مجدد تلاش کنید');
        }

        return JsonResponse::success('لینک دانلود فایل برای شما ارسال شد');
    }
}