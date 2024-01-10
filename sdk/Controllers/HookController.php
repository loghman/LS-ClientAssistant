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
        $hook = Hook::get($slug)['result'][0][0];
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

        $brandName = setting('brand_name_fa');
        $logoUrl = setting('logo_url');

        WebResponse::view('sdk.hook.landing.index', compact('hook', 'user', 'brandName', 'logoUrl'));
    }


    public function download(Request $request, $slug)
    {
        $hook = Hook::get($slug)['result'][0][0];
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
            'full_name' => $request->get('fullname'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
        ];

        $response = Hook::sendFile($hook['id'], $data);

        if (!$response['status']) {
            return JsonResponse::badRequest($response['message']);
        }

        $hookDownloadType = $hook['fields']['conditions']['hook_download_type'];
        if($hookDownloadType == 'sendable'){
            return JsonResponse::success('لینک دانلود فایل برای شما ارسال شد');
        }

        $shortLink = $response['result']['short_link'];
        $redirectTime = 10;
        $subClass = 'ls-client-hook-';

        return JsonResponse::ajaxView('sdk.hook.landing._partials.download', compact('shortLink', 'redirectTime', 'hook', 'subClass'));
    }
}