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

if (! function_exists('clean_blog_html')) {
    function clean_blog_html(string $html): string
    {
        return preg_replace_callback(
            '/(?<!-)color\s*:\s*(#[0-9a-fA-F]{3,8}|rgba?\([^)]*\)|black|white|inherit)\s*;/i',
            function (array $m): string {
                $color = strtolower(trim($m[1]));

                if (preg_match('/^#[0-9a-f]+$/', $color)) {
                    $hex = ltrim($color, '#');
                    if (strlen($hex) === 3) {
                        $hex = implode('', array_map(fn ($c) => $c.$c, str_split($hex)));
                    }
                    if (strlen($hex) === 8) {
                        $hex = substr($hex, 0, 6);
                    }
                    [$r, $g, $b] = array_map('hexdec', str_split($hex, 2));
                } elseif (preg_match('/rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)/i', $color, $c)) {
                    $r = (int) $c[1];
                    $g = (int) $c[2];
                    $b = (int) $c[3];
                } elseif ($color === 'black') {
                    $r = $g = $b = 0;
                } else {
                    return $m[0];
                }

                $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

                return $luminance < 0.5 ? 'color: inherit;' : $m[0];
            },
            $html
        );
    }
}
