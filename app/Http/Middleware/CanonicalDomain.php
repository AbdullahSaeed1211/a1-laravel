<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalDomain
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (! str_contains($host, 'a1traininggroupllc.com')) {
            return $next($request);
        }

        $canonicalHost = 'www.a1traininggroupllc.com';

        if ($host !== $canonicalHost || ! $request->isSecure()) {
            if (! $request->isMethod('GET')) {
                return $next($request);
            }

            $url = "https://{$canonicalHost}{$request->getRequestUri()}";
            $query = $request->getQueryString();
            if ($query) {
                $url .= '?' . $query;
            }

            return redirect($url, 301);
        }

        return $next($request);
    }
}
