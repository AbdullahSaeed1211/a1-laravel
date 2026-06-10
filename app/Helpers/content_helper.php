<?php

use Illuminate\Support\Facades\Cache;

if (! function_exists('content_path')) {
    function content_path(string $path = ''): string
    {
        return base_path('content'.($path ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : ''));
    }
}

if (! function_exists('load_content')) {
    function load_content(string $filename): array
    {
        static $memory = [];
        if (isset($memory[$filename])) {
            return $memory[$filename];
        }

        $path = content_path($filename);
        if (! file_exists($path)) {
            $memory[$filename] = [];

            return [];
        }

        $cacheKey = 'content_'.md5($filename).'_'.filemtime($path);
        $cached = Cache::get($cacheKey);
        if ($cached !== null) {
            $memory[$filename] = $cached;

            return $cached;
        }

        $data = json_decode(file_get_contents($path), true) ?? [];
        Cache::put($cacheKey, $data, 3600);
        $memory[$filename] = $data;

        return $data;
    }
}

if (! function_exists('load_content_keyed')) {
    function load_content_keyed(string $filename, string $key): mixed
    {
        $data = load_content($filename);

        return $data[$key] ?? null;
    }
}
