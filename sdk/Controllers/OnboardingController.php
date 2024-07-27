<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\User;

class OnboardingController
{
    public function index(Request $request)
    {
        return WebResponse::view(
            'vue-apps.views.vue-onboarding',
        );

    }
}