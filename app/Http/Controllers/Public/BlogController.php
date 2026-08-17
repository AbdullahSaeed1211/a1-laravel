<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Services\GhlBlogService;
use App\Services\SEOService;
use Spatie\ResponseCache\Attributes\Cache;

class BlogController extends Controller
{
    #[Cache(lifetime: 60)]
    public function index(GhlBlogService $ghl)
    {
        $lang = app()->getLocale();
        $meta = SEOService::forPage('blog', $lang);

        if ($ghl->isConfigured()) {
            $blogs = $ghl->all();
        } else {
            $allBlogs = load_content('blogs.json');
            $blogs = array_filter($allBlogs, fn ($b) => $b['published'] ?? false);
        }

        usort($blogs, fn ($a, $b) => strtotime($b['createdAt'] ?? 'now') - strtotime($a['createdAt'] ?? 'now'));

        return view('public.blog.index', compact('meta', 'blogs', 'lang'));
    }

    #[Cache(lifetime: 60)]
    public function show(string $slug, GhlBlogService $ghl)
    {
        $lang = app()->getLocale();

        if ($ghl->isConfigured()) {
            $blog = $ghl->findBySlug($slug);
        } else {
            $allBlogs = load_content('blogs.json');
            $blog = null;
            foreach ($allBlogs as $b) {
                if ($b['slug'] === $slug) {
                    $blog = $b;
                    break;
                }
            }
        }

        if (! $blog) {
            abort(404);
        }

        $meta = SEOService::forPage('blog', $lang);
        $meta['title'] = ($lang === 'es' && ! empty($blog['title_es']) ? $blog['title_es'] : $blog['title']).' | A1 Training Group';

        return view('public.blog.show', compact('meta', 'blog', 'lang'));
    }
}
