<?php

namespace Ls\ClientAssistant\Core\Middlewares;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Helpers\Config;

class UtmLogMiddleware
{
    /**
     * Store utm data
     * Sample: https://7learn.com?utm_source=insta&utm_medium=ads&utm_campaign=bendaz&utm_id=ds458
     */
    public function handle(Request $request, $next)
    {
        $referer = $request->header('referer');
        if ($request->has('utm_campaign')) {
            $defaultSource = $referer ? $this->getSecondLevelDomainName($referer) : 'direct';
            $utmData = [
                'source' => $request->get('utm_source', $defaultSource),
                'medium' => $request->get('utm_medium'),
                'campaign' => $request->get('utm_campaign'),
            ];
            $this->storeCookie($utmData);
        } else if ($this->fromSearchEngine($referer)) {
            $utmData = [
                'campaign' => 'seo',
                'source' => $this->getSecondLevelDomainName($referer),
                'medium' => parse_url($request->url(), PHP_URL_PATH),
            ];
            $this->storeCookie($utmData);
        }

        return $next($request);
    }

    private function fromSearchEngine($referer): bool
    {
        if (empty($referer)) return false;
        
        $referrerHost = parse_url($referer, PHP_URL_HOST);

        return in_array($referrerHost, Config::get('utmlog.search_engines'));
    }

    private function storeCookie(array $utmData): void
    {
        $lifetime = setting('utm_log_cookie_lifetime', 20160);

        setcookie(
            Config::get('utmlog.utm_log_cookie_name'),
            json_encode($utmData),
            time() + ($lifetime * 60),
            '/'
        );
    }

    private function getSecondLevelDomainName($url): string
    {
        $domain = parse_url($url, PHP_URL_HOST);
        $domainParts = explode('.', $domain);

        return $domainParts[count($domainParts) - 2];
    }
}