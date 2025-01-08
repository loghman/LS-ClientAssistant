<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class AuthController
{
    public function index(Request $request)
    {
        setcookie("auth_backurl", self::backurl(), time() + (30 * 60), "/");
        return WebResponse::view(
            'vue-apps.views.vue-auth',
        );
    }


    private static function backurl(){
        $backurl = $_GET['backurl'] ?? $_GET['refer'] ?? false;
        if($backurl){
            return $backurl;
        }
        if(str_contains($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))
            return $_SERVER['HTTP_REFERER'];
        return site_url('pwa/dashboard');
    }
}

