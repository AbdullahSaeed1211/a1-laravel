<?php

use App\Http\Middleware\CacheResponseWithVary;
use Spatie\ResponseCache\Replacers\CsrfTokenReplacer;

return [
    'request_replacers' => [
        CsrfTokenReplacer::class,
    ],
    'cache_profile' => CacheResponseWithVary::class,
    'cache_tag' => 'responsecache',
    'cache_store' => env('RESPONSE_CACHE_STORE', env('CACHE_STORE', 'file')),
    'enable_cache' => env('RESPONSE_CACHE_ENABLED', true),
    'override_response_cache_control' => env('RESPONSE_CACHE_CONTROL', 'public, max-age=3600'),
    'replicate_api_calls' => false,
];
