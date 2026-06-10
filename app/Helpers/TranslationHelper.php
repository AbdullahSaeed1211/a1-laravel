<?php

use Illuminate\Support\Facades\App;

if (! function_exists('load_translations')) {
    function load_translations(?string $locale = null): array
    {
        static $cache = [];
        $locale = $locale ?? App::getLocale();
        if (isset($cache[$locale])) {
            return $cache[$locale];
        }

        $jsonPath = lang_path("{$locale}.json");
        if (! file_exists($jsonPath)) {
            $jsonPath = base_path("lang/{$locale}.json");
        }

        $cache[$locale] = file_exists($jsonPath) ? (json_decode(file_get_contents($jsonPath), true) ?? []) : [];

        return $cache[$locale];
    }
}

if (! function_exists('t')) {
    function t(string $key, array $replace = [], ?string $locale = null): string
    {
        $translations = load_translations($locale);

        $value = $translations[$key] ?? $key;

        if (! is_string($value)) {
            return $key;
        }

        foreach ($replace as $placeholder => $replacement) {
            $value = str_replace(':'.$placeholder, $replacement, $value);
        }

        return $value;
    }
}

if (! function_exists('tc')) {
    function tc(string $key, ?string $locale = null): array
    {
        $translations = load_translations($locale);
        $value = $translations[$key] ?? [];

        return is_array($value) ? $value : [];
    }
}

if (! function_exists('load_faq')) {
    function load_faq(string $page, ?string $locale = null): array
    {
        static $cache = [];
        $locale = $locale ?? App::getLocale();
        $cacheKey = "{$page}:{$locale}";
        if (isset($cache[$cacheKey])) {
            return $cache[$cacheKey];
        }

        $faqPath = content_path('faq.json');
        if (! file_exists($faqPath)) {
            return [];
        }

        $allFaqs = json_decode(file_get_contents($faqPath), true);
        $faqs = $allFaqs[$page] ?? [];

        $cache[$cacheKey] = $faqs;

        return $faqs;
    }
}
