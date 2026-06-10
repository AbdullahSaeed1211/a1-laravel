<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SEOService;

class PageController extends Controller
{
    public function about()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('about', $lang);

        return view('public.pages.about', compact('meta', 'lang'));
    }

    public function a1BlackMember()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('a1-black-member', $lang);

        return view('public.pages.a1-black-member', compact('meta', 'lang'));
    }

    public function referFriends()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('refer-friends', $lang);

        return view('public.pages.refer-friends', compact('meta', 'lang'));
    }

    public function reviews()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('reviews', $lang);

        return view('public.pages.reviews', compact('meta', 'lang'));
    }

    public function privacy()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('privacy', $lang);

        return view('public.pages.privacy', compact('meta', 'lang'));
    }

    public function terms()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('terms', $lang);

        return view('public.pages.terms', compact('meta', 'lang'));
    }

    public function calendar()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('calendar', $lang);

        return view('public.pages.calendar', compact('meta', 'lang'));
    }

    public function renewals()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('renewals', $lang);

        return view('public.pages.renewals', compact('meta', 'lang'));
    }
}
