<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);
        $supported = ['en', 'es'];

        if (in_array($locale, $supported, true)) {
            App::setLocale($locale);
            URL::defaults(['locale' => $locale]);
        } else {
            App::setLocale('en');
            URL::defaults(['locale' => 'en']);
        }

        return $next($request);
    }
}
