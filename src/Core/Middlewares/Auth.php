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
        if (!isset($_COOKIE['token'])) {
            redirect(site_url('auth'));
        }

        $user = User::me($_COOKIE['token']);
        if (is_null($user['data'])) {
            redirect(site_url('auth'));
        }

        $response = $handler->handle($request);
        $existingContent = (string)$response->getBody();

        return $response;
    }
}