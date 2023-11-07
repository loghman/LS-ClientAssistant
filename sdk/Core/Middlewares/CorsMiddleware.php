<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Ls\ClientAssistant\Helpers\Config;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        if (! $this->hasMatchingPath($request)) {
            return $next($request);
        }

        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', implode(', ', Config::get('cors.allowed_origins')));
        $response->headers->set('Access-Control-Allow-Methods', implode(', ', Config::get('cors.allowed_methods')));
        $response->headers->set('Access-Control-Allow-Headers', implode(', ', Config::get('cors.allowed_headers')));

        if (Config::get('cors.supports_credentials')) {
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        if (($maxAge = Config::get('cors.max_age')) !== null) {
            $response->headers->set('Access-Control-Max-Age', (string) $maxAge);
        }

        if (($exposedHeaders = Config::get('cors.exposed_headers'))) {
            $response->headers->set('Access-Control-Expose-Headers', implode(', ', $exposedHeaders));
        }

        return $response;
    }

    protected function hasMatchingPath(Request $request): bool
    {
        $paths = $this->getPathsByHost($request->getHost());

        foreach ($paths as $path) {
            if ($path !== '/') {
                $path = trim($path, '/');
            }

            if ($request->fullUrlIs($path) || $request->is($path)) {
                return true;
            }
        }

        return false;
    }

    protected function getPathsByHost(string $host)
    {
        $paths = Config::get('cors.paths');

        if (isset($paths[$host])) {
            return $paths[$host];
        }

        return array_filter($paths, function ($path) {
            return is_string($path);
        });
    }
}
