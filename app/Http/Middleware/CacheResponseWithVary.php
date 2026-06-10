<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheAllSuccessfulGetRequests;
use Symfony\Component\HttpFoundation\Response;

class CacheResponseWithVary extends CacheAllSuccessfulGetRequests
{
    public function makeCacheKey(Request $request): string
    {
        $key = parent::makeCacheKey($request);
        $locale = app()->getLocale();

        return "{$key}:{$locale}";
    }

    public function renderResponse(Request $request, Response $response): Response
    {
        $response->headers->set('Vary', 'Accept-Language, Cookie');

        return parent::renderResponse($request, $response);
    }
}
