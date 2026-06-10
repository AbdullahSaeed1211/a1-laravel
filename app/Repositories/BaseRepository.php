<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Cache;

abstract class BaseRepository
{
    protected static function model(): string
    {
        throw new \RuntimeException('Model class must be defined');
    }

    protected static function cacheKey(string $key): string
    {
        return static::CACHE_PREFIX.'_'.$key;
    }

    protected static function cacheForAll(): string
    {
        return static::cacheKey('all');
    }

    protected static function cacheRemember(string $key, \Closure $callback, int $ttl = 3600): mixed
    {
        return Cache::remember($key, $ttl, $callback);
    }

    protected static function cacheForget(string $key): void
    {
        Cache::forget($key);
    }

    public static function flushCache(): void
    {
        Cache::forget(static::cacheForAll());
    }

    public static function all(): array
    {
        $model = static::model();

        return static::cacheRemember(static::cacheForAll(), function () use ($model) {
            return $model::all()->toArray();
        });
    }

    public static function findById(string $id): mixed
    {
        $model = static::model();

        return $model::find($id);
    }

    public static function findBySlug(string $slug): mixed
    {
        $model = static::model();

        return $model::where('slug', $slug)->first();
    }

    public static function findByIds(array $ids): array
    {
        $model = static::model();

        return $model::whereIn('_id', $ids)->get()->toArray();
    }
}
