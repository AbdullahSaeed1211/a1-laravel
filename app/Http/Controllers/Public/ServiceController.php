<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\SEOService;

class ServiceController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('services', $lang);
        $services = load_content('services.json');

        return view('public.services.index', compact('meta', 'services', 'lang'));
    }

    public function show(string $slug, ?string $canonical = null)
    {
        $lang = app()->getLocale();
        $services = load_content('services.json');
        $pricing = load_content('pricing.json');
        $servicePages = load_content('service-pages.json');

        $service = null;
        foreach ($services as $s) {
            if ($s['slug'] === $slug) {
                $service = $s;
                break;
            }
        }

        if (! $service) {
            abort(404);
        }

        $slugPricing = $pricing[$slug] ?? [];
        $slugSubPages = $servicePages[$slug] ?? [];

        $meta = SEOService::forPage($slug, $lang);
        if (empty($meta['title']) || str_contains($meta['title'], 'A1 Training Group')) {
            $meta = SEOService::forPage('services', $lang);
        }

        if ($canonical) {
            $meta['canonical'] = $canonical;
        }

        return view('public.services.show', compact('meta', 'service', 'slugPricing', 'slugSubPages', 'lang'));
    }

    public function showSub(string $slug, string $sub)
    {
        $lang = app()->getLocale();
        $servicePages = load_content('service-pages.json');
        $pricing = load_content('pricing.json');

        $page = $servicePages[$slug][$sub] ?? null;

        if (! $page) {
            abort(404);
        }

        $slugPricing = $pricing[$slug] ?? [];

        $metaTitle = $lang === 'es' && ! empty($page['metaTitle_es']) ? $page['metaTitle_es'] : ($page['metaTitle'] ?? '');
        $metaDescription = $lang === 'es' && ! empty($page['metaDescription_es']) ? $page['metaDescription_es'] : ($page['metaDescription'] ?? '');

        $pageSlug = "{$slug}-{$sub}";
        $title = ($metaTitle ?: ($lang === 'es' ? $page['titleEs'] : $page['title'])).' | A1 Training Group';
        $description = $metaDescription ?: ($lang === 'es' ? $page['introEs'] : $page['intro']);
        $canonical = url(($lang === 'es' ? '/es' : '')."/services/{$slug}/{$sub}");

        $meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => [],
            'canonical' => $canonical,
            'ogTitle' => $title,
            'ogDescription' => $description,
            'ogType' => 'website',
            'ogImage' => SEOService::buildUrl('/images/logo.avif'),
            'twitterCard' => 'summary_large_image',
            'twitterTitle' => $title,
            'twitterDescription' => $description,
            'hreflang' => SEOService::getHreflang("services/{$slug}/{$sub}"),
            'jsonld' => SEOService::getJsonLd($pageSlug, $title, $description, $canonical, SEOService::buildUrl('/images/logo.avif'), $lang),
        ];

        return view('public.services.sub-page', compact('meta', 'page', 'slug', 'sub', 'slugPricing', 'lang'));
    }
}
