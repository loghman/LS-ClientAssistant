<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;

class GuessMiddleware
{
    public function handle($request, $next)
    {
        if (User::loggedIn()) {
            $ref = $request->query('referer') ?? $request->header('referer') ?? site_url('');
            redirect($ref);
        }

        return $next($request);
    }
}