<?php

namespace Ls\ClientAssistant\Core\Router;

use Ls\ClientAssistant\Core\Kernel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

class RequestResponseArgs implements InvocationStrategyInterface
{
    public function __invoke(callable $callable, ServerRequestInterface $request, ResponseInterface $response, array $routeArguments): ResponseInterface
    {
        $blade = (new Kernel())->registerBlade();

        $symfonyRequest = Request::createFromGlobals();
        $symfonyRequest->setRouteArguments($routeArguments);

        $customResponse = new Response($response);
        $customResponse->setBlade($blade);

        return $callable($symfonyRequest, $customResponse, ...array_values($routeArguments));
    }
}