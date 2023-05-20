<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Ls\ClientAssistant\Utilities\Modules\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Guess implements \Psr\Http\Server\MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (isset($_COOKIE['token'])) {
            $user = User::loggedIn($_COOKIE['token']);
            if ($user) {
                redirect(site_url(''));
            }
        }

        $response = $handler->handle($request);

        return $response;
    }
}