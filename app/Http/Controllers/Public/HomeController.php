<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SEOService;

class HomeController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('home', $lang);
        $trainers = load_content('trainers.json');
        $services = load_content('services.json');

        return view('public.home', compact('meta', 'trainers', 'services', 'lang'));
    }
}
