<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Guess implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (User::loggedIn()) {
            redirect(site_url(''));
        }

        return $handler->handle($request);
    }
}