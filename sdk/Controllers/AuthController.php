<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class AuthController
{
    public function index(Request $request)
    {
        return WebResponse::view(
            'vue-apps.views.vue-auth',
        );

    }
}