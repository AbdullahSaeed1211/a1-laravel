<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Providers\SeoPageRegistry;
use App\Repositories\BlogRepository;
use App\Services\GhlBlogService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $now = now();
        $sitemap = Sitemap::create();

        $this->addStaticPages($sitemap, $now);
        $this->addWixLegacyPages($sitemap, $now);
        $this->addTrainers($sitemap, $now);
        $this->addServices($sitemap, $now);
        $this->addServiceSubPages($sitemap, $now);
        $this->addBlogs($sitemap, $now);

        return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
    }

    private function addStaticPages(Sitemap $sitemap, $now): void
    {
        $pages = SeoPageRegistry::getPages();
        $locales = ['en', 'es'];

        foreach ($locales as $locale) {
            foreach ($pages as $page) {
                $routeName = $locale === 'en' ? $page['routeName'] : $page['routeName'] . '.es';

                if (! Route::has($routeName)) {
                    $routeName = $locale === 'en' ? $page['routeName'] : 'es.' . $page['routeName'];
                    if (! Route::has($routeName)) {
                        continue;
                    }
                }

                $priority = $page['key'] === 'home' ? 1.0 : 0.8;
                $freq = $page['key'] === 'home' ? Url::CHANGE_FREQUENCY_DAILY : Url::CHANGE_FREQUENCY_WEEKLY;

                $sitemap->add(Url::create(route($routeName))
                    ->setLastModificationDate($now)
                    ->setChangeFrequency($freq)
                    ->setPriority($priority));
            }
        }
    }

    private function addWixLegacyPages(Sitemap $sitemap, $now): void
    {
        $wixPages = [
            '/privacy-policy' => 0.7,
            '/terms-and-conditions' => 0.7,
            '/about-9' => 0.6,
            '/testimonials' => 0.6,
            '/what-sets-us-apart' => 0.5,
            '/referral' => 0.5,
            '/loyalty' => 0.5,
            '/personal-training-packages' => 0.6,
            '/boxing' => 0.6,
        ];

        foreach ($wixPages as $path => $priority) {
            $sitemap->add(Url::create(url($path))
                ->setLastModificationDate($now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority($priority));
        }
    }

    private function addTrainers(Sitemap $sitemap, $now): void
    {
        $trainers = load_content('trainers.json');
        $locales = ['en', 'es'];

        foreach ($trainers as $trainer) {
            $slug = $trainer['slug'] ?? null;
            if (! $slug) {
                continue;
            }

            foreach ($locales as $locale) {
                $routeName = $locale === 'en' ? 'trainers.show' : 'trainers.show.es';

                if (! Route::has($routeName)) {
                    $routeName = $locale === 'en' ? 'trainers.show' : 'es.trainers.show';
                    if (! Route::has($routeName)) {
                        continue;
                    }
                }

                $sitemap->add(Url::create(route($routeName, ['slug' => $slug]))
                    ->setLastModificationDate($now)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7));
            }
        }
    }

    private function addServices(Sitemap $sitemap, $now): void
    {
        $services = load_content('services.json');
        $locales = ['en', 'es'];

        foreach ($services as $service) {
            $slug = $service['slug'] ?? null;
            if (! $slug) {
                continue;
            }

            foreach ($locales as $locale) {
                $routeName = $locale === 'en' ? 'services.show' : 'services.show.es';

                if (! Route::has($routeName)) {
                    $routeName = $locale === 'en' ? 'services.show' : 'es.services.show';
                    if (! Route::has($routeName)) {
                        continue;
                    }
                }

                $sitemap->add(Url::create(route($routeName, ['slug' => $slug]))
                    ->setLastModificationDate($now)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.7));
            }
        }
    }

    private function addServiceSubPages(Sitemap $sitemap, $now): void
    {
        $path = base_path('content/service-pages.json');
        if (! File::exists($path)) {
            return;
        }

        $pages = json_decode(File::get($path), true) ?? [];
        $locales = ['en', 'es'];

        foreach ($pages as $slug => $subs) {
            foreach ($subs as $sub => $data) {
                foreach ($locales as $locale) {
                    $routeName = $locale === 'en' ? 'services.sub' : 'services.sub.es';

                    if (! Route::has($routeName)) {
                        $routeName = $locale === 'en' ? 'services.sub' : 'es.services.sub';
                        if (! Route::has($routeName)) {
                            continue;
                        }
                    }

                    $sitemap->add(Url::create(route($routeName, ['slug' => $slug, 'sub' => $sub]))
                        ->setLastModificationDate($now)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.6));
                }
            }
        }
    }

    private function getBlogs(): array
    {
        $ghl = app(GhlBlogService::class);
        if ($ghl->isConfigured()) {
            return $ghl->all();
        }

        try {
            $blogs = BlogRepository::all();
            if (! empty($blogs)) {
                return $blogs;
            }
        } catch (\Throwable) {
            //
        }

        return json_decode(
            File::get(base_path('content/blogs.json')),
            true
        ) ?? [];
    }

    private function addBlogs(Sitemap $sitemap, $now): void
    {
        $blogs = $this->getBlogs();

        foreach ($blogs as $blog) {
            if (! ($blog['published'] ?? false)) {
                continue;
            }

            $slug = $blog['slug'] ?? null;
            if (! $slug) {
                continue;
            }

            $lang = $blog['language'] ?? 'en';
            $routeName = $lang === 'en' ? 'blog.show' : 'blog.show.es';

            if (! Route::has($routeName)) {
                $routeName = $lang === 'en' ? 'blog.show' : 'es.blog.show';
                if (! Route::has($routeName)) {
                    continue;
                }
            }

            $updated = $blog['updated_at'] ?? $blog['createdAt'] ?? $now;

            $sitemap->add(Url::create(route($routeName, ['slug' => $slug]))
                ->setLastModificationDate(is_string($updated) ? new \DateTime($updated) : $now)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.6));
        }
    }

    public function robots(): Response
    {
        $baseUrl = config('app.url');
        $lines = [
            'User-agent: *',
            'Disallow: /api/',
            'Disallow: /admin',
            'Disallow: /register',
            'Disallow: /login',
            'Disallow: /forgot-password',
            'Disallow: /reset-password/',
            'Disallow: /en/',
            "Sitemap: {$baseUrl}/sitemap.xml",
        ];

        return response(implode("\n", $lines) . "\n", 200, ['Content-Type' => 'text/plain']);
    }
}
