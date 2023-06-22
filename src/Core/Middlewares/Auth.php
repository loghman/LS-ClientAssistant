<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class Auth implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (!User::loggedIn()) {
            redirect(site_url('auth'));
        }

        if (in_array($request->getUri()->getPath(), ['/auth/logout', '/auth/verify', '/email/update', '/mobile/update'])) {
            return $handler->handle($request);
        }

        $verificationFields = get_verification_fields();
        if (
            (in_array('email', $verificationFields) && ! User::emailVerified()) ||
            (in_array('mobile', $verificationFields) && ! User::mobileVerified())
        ) {
            redirect(site_url('auth/verify'));
        }

        return $handler->handle($request);
    }
}