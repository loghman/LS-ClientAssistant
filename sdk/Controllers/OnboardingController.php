<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;

class OnboardingController
{
    public function index(Request $request)
    {
        return WebResponse::view(
            'vue-apps.views.vue-onboarding',
        );

    }
}