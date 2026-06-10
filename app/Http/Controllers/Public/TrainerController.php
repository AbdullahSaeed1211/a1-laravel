<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SEOService;

class TrainerController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('trainers', $lang);
        $trainers = load_content('trainers.json');
        usort($trainers, fn ($a, $b) => ($a['order'] ?? 0) - ($b['order'] ?? 0));

        return view('public.trainers.index', compact('meta', 'trainers', 'lang'));
    }

    public function show(string $slug)
    {
        $lang = app()->getLocale();
        $trainers = load_content('trainers.json');

        $trainer = null;
        foreach ($trainers as $t) {
            if ($t['slug'] === $slug) {
                $trainer = $t;
                break;
            }
        }

        if (! $trainer) {
            abort(404);
        }

        $meta = SEOService::forPage('trainers', $lang);
        $meta['title'] = $trainer['name'].' — '.($lang === 'es' ? ($trainer['titleEs'] ?? $trainer['title']) : $trainer['title']).' | A1 Training Group';

        return view('public.trainers.show', compact('meta', 'trainer', 'lang'));
    }
}
