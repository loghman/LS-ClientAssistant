<?php
namespace Ls\ClientAssistant\Core\Middlewares;
use Ls\ClientAssistant\Utilities\Modules\User;

class PwaMiddleware
{
    public function handle($request, $next)
    {
        $_GET = sanitizeInput($_GET);

        if (!User::loggedIn()) {
            redirect(site_url('pwa/auth'));
        }

        return $next($request);
    }
}