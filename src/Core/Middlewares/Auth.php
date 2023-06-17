<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class Auth implements \Psr\Http\Server\MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (!User::loggedIn()) {
            redirect(site_url('auth'));
        }

        return $handler->handle($request);
    }
}