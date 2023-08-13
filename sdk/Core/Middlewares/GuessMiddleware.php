<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class GuessMiddleware
{
    public function handle($request, $next)
    {
        if (User::loggedIn()) {
            redirect(site_url(''));
        }

        return $next($request);
    }
}