<?php

namespace App\Services;

use App\Models\Mongo\PageSEO;

class SEOService
{
    protected const CANONICAL_DOMAIN = 'https://www.a1traininggroupllc.com';

    public static function forPage(string $pageSlug, string $lang = 'en'): array
    {
        $seo = self::getSeo($pageSlug);

        if (! $seo) {
            return self::defaultMeta($lang);
        }

        $isEs = $lang === 'es';
        $title = $isEs && ! empty($seo['title_es']) ? $seo['title_es'] : ($seo['title'] ?? '');
        $description = $isEs && ! empty($seo['description_es']) ? $seo['description_es'] : ($seo['description'] ?? '');
        $keywords = $isEs && ! empty($seo['keywords_es']) ? $seo['keywords_es'] : ($seo['keywords'] ?? []);
        $ogTitle = $isEs && ! empty($seo['ogTitle_es']) ? $seo['ogTitle_es'] : ($seo['ogTitle'] ?? $title);
        $ogDescription = $isEs && ! empty($seo['ogDescription_es']) ? $seo['ogDescription_es'] : ($seo['ogDescription'] ?? $description);
        $twitterTitle = $isEs && ! empty($seo['twitterTitle_es']) ? $seo['twitterTitle_es'] : ($seo['twitterTitle'] ?? $title);
        $twitterDescription = $isEs && ! empty($seo['twitterDescription_es']) ? $seo['twitterDescription_es'] : ($seo['twitterDescription'] ?? $description);

        $currentPath = request()->path();
        $canonicalUrl = $isEs ? self::buildUrl("/{$currentPath}") : self::buildUrl("/{$currentPath}");
        $ogImage = $seo['ogImage'] ?? self::buildUrl('/images/logo.avif');

        return [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonicalUrl,
            'ogTitle' => $ogTitle,
            'ogDescription' => $ogDescription,
            'ogType' => $seo['ogType'] ?? 'website',
            'ogImage' => $ogImage,
            'twitterCard' => $seo['twitterCard'] ?? 'summary_large_image',
            'twitterTitle' => $twitterTitle,
            'twitterDescription' => $twitterDescription,
            'hreflang' => self::getHreflang($currentPath),
            'jsonld' => self::getJsonLd($pageSlug, $title, $description, $canonicalUrl, $ogImage, $lang),
        ];
    }

    protected static function getSeo(string $slug): ?array
    {
        static $memory = [];
        if (isset($memory[$slug])) {
            return $memory[$slug];
        }

        if (extension_loaded('mongodb') && class_exists('MongoDB\Laravel\Eloquent\Model')) {
            try {
                $record = PageSEO::where('slug', $slug)->first();
                if ($record) {
                    $memory[$slug] = $record->toArray();

                    return $memory[$slug];
                }
            } catch (\Throwable $e) {
                // MongoDB unavailable, fall through
            }
        }

        $pages = load_content('pages_seo.json');
        if (! empty($pages) && isset($pages[$slug])) {
            $memory[$slug] = $pages[$slug];

            return $memory[$slug];
        }

        $memory[$slug] = null;

        return null;
    }

    public static function defaultMeta(string $lang = 'en'): array
    {
        $isEs = $lang === 'es';
        $title = $isEs ? 'A1 Training Group | Entrenamiento Personal en NYC' : 'A1 Training Group | NYC\'s #1 In-Home Personal Training';
        $desc = $isEs
            ? 'Entrenamiento personal, terapia física y boxeo en NYC. En tu hogar, en nuestro gimnasio o en línea.'
            : 'Personal training, physical therapy, and boxing in NYC. In-home, gym, or online.';
        $canonical = self::buildUrl('/');

        return [
            'title' => $title,
            'description' => $desc,
            'keywords' => [],
            'canonical' => $canonical,
            'ogTitle' => 'A1 Training Group',
            'ogDescription' => $desc,
            'ogType' => 'website',
            'ogImage' => self::buildUrl('/images/logo.avif'),
            'twitterCard' => 'summary_large_image',
            'twitterTitle' => 'A1 Training Group',
            'twitterDescription' => $desc,
            'hreflang' => self::getHreflang('/'),
            'jsonld' => self::getJsonLd('home', $title, $desc, $canonical, self::buildUrl('/images/logo.avif'), $lang),
        ];
    }

    public static function buildUrl(string $path): string
    {
        return self::CANONICAL_DOMAIN.'/'.ltrim($path, '/');
    }

    public static function getHreflang(string $path): array
    {
        $path = '/'.ltrim($path, '/');
        $path = preg_replace('#^/(en|es)(/|$)#', '/', $path);

        return [
            'en' => self::buildUrl($path),
            'es' => self::buildUrl('/es'.$path),
            'x-default' => self::buildUrl($path),
        ];
    }

    public static function getJsonLd(string $pageSlug, string $title, string $description, string $url, string $image, string $lang): string
    {
        $isEs = $lang === 'es';
        $schemas = [];

        // Organization schema
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => self::CANONICAL_DOMAIN.'/#organization',
            'name' => 'A1 Training Group',
            'alternateName' => 'A1 Training Group LLC',
            'url' => self::CANONICAL_DOMAIN,
            'telephone' => '(917) 732-6520',
            'email' => 'info@a1traininggroupllc.com',
            'logo' => self::buildUrl('/images/logo.avif'),
            'image' => $image,
            'description' => $description,
            'foundingDate' => '2012',
            'founders' => [['@type' => 'Person', 'name' => 'A1 Training Group']],
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'New York',
                'addressRegion' => 'NY',
                'addressCountry' => 'US',
            ],
            'sameAs' => [
                'https://www.instagram.com/a1traininggroup/',
                'https://www.linkedin.com/in/a1-training-group-110905344/',
            ],
        ];

        // LocalBusiness schema
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            '@id' => self::CANONICAL_DOMAIN.'/#localbusiness',
            'name' => 'A1 Training Group',
            'image' => $image,
            'url' => self::CANONICAL_DOMAIN,
            'telephone' => '(917) 732-6520',
            'priceRange' => '$$$',
            'openingHoursSpecification' => [
                ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], 'opens' => '06:00', 'closes' => '21:00'],
            ],
            'areaServed' => ['New York', 'Manhattan', 'Brooklyn', 'The Hamptons'],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => $isEs ? 'Servicios de A1 Training' : 'A1 Training Services',
                'itemListElement' => [
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Personal Training']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Physical Therapy']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Massage Therapy']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Boxing']],
                    ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Kettlebell Training']],
                ],
            ],
        ];

        // WebSite schema with search action
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => self::CANONICAL_DOMAIN.'/#website',
            'name' => $title,
            'description' => $description,
            'url' => $url,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => self::CANONICAL_DOMAIN.'/?s={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        // WebPage schema with breadcrumb
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => $url.'/#webpage',
            'url' => $url,
            'name' => $title,
            'description' => $description,
            'isPartOf' => ['@id' => self::CANONICAL_DOMAIN.'/#website'],
            'breadcrumb' => [
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => $isEs ? 'Inicio' : 'Home', 'item' => self::CANONICAL_DOMAIN],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => $url],
                ],
            ],
        ];

        return json_encode($schemas, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}
