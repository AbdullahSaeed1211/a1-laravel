<?php

namespace App\Repositories;

use App\Models\Mongo\PageSEO;

class SEORepository extends BaseRepository
{
    protected const CACHE_PREFIX = 'seo';

    protected static function model(): string
    {
        return PageSEO::class;
    }

    public static function findBySlug(string $slug): ?PageSEO
    {
        return PageSEO::where('slug', $slug)->first();
    }

    public static function allSlugs(): array
    {
        return static::cacheRemember(static::cacheKey('all_slugs'), function () {
            return PageSEO::pluck('slug')->toArray();
        });
    }
}
