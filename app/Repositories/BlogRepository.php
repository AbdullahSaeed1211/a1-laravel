<?php

namespace App\Repositories;

use App\Models\Mongo\BlogPost;

class BlogRepository extends BaseRepository
{
    protected const CACHE_PREFIX = 'blogs';

    protected static function model(): string
    {
        return BlogPost::class;
    }

    public static function all(): array
    {
        return static::cacheRemember(static::cacheForAll(), function () {
            return BlogPost::published()->orderBy('createdAt', 'desc')->get()->toArray();
        });
    }

    public static function forLocale(string $locale): array
    {
        $cacheKey = static::cacheKey('locale_'.$locale);

        return static::cacheRemember($cacheKey, function () use ($locale) {
            return BlogPost::published()->forLocale($locale)->orderBy('createdAt', 'desc')->get()->toArray();
        });
    }

    public static function findBySlug(string $slug): ?BlogPost
    {
        return BlogPost::where('slug', $slug)->first();
    }
}
