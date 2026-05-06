<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class AuthController
{
    public function index(Request $request)
    {
        set_secure_cookie('auth_backurl', self::backurl(), time() + (30 * 60));
        return WebResponse::view(
            'vue-apps.views.vue-auth',
        );
    }


    private static function backurl(){
        $backurl = $_GET['backurl'] ?? $_GET['refer'] ?? false;
        if($backurl){
            return urldecode($backurl);
        }
        if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))
            return $_SERVER['HTTP_REFERER'];
        return site_url('pwa/dashboard');
    }
}

