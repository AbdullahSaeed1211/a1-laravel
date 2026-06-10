<?php

namespace Database\Seeders;

use App\Models\Mongo\BlogPost;
use App\Models\Mongo\PageSEO;
use Illuminate\Database\Seeder;
use MongoDB\BSON\ObjectId;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        if (! extension_loaded('mongodb')) {
            $this->command->warn('MongoDB extension not loaded, skipping content seed.');

            return;
        }

        $this->seedBlogs();
        $this->seedPageSEO();
    }

    protected function seedBlogs(): void
    {
        $blogsPath = content_path('blogs.json');
        if (! file_exists($blogsPath)) {
            $this->command->warn('blogs.json not found, skipping blog seed.');

            return;
        }

        $blogs = json_decode(file_get_contents($blogsPath), true);
        if (empty($blogs)) {
            return;
        }

        $model = new BlogPost;
        foreach ($blogs as $blog) {
            $model::updateOrCreate(
                ['slug' => $blog['slug']],
                [
                    '_id' => $blog['id'] ?? (string) new ObjectId,
                    'title' => $blog['title'],
                    'slug' => $blog['slug'],
                    'author' => $blog['author'] ?? 'A1 Training',
                    'content' => $blog['content'] ?? null,
                    'coverImage' => $blog['coverImage'] ?? null,
                    'coverImageAlt' => $blog['coverImageAlt'] ?? null,
                    'published' => $blog['published'] ?? true,
                    'language' => $blog['language'] ?? 'en',
                    'seo' => $blog['seo'] ?? null,
                ]
            );
        }

        $this->command->info('Seeded '.count($blogs).' blog posts.');
    }

    protected function seedPageSEO(): void
    {
        $seoPath = content_path('pages_seo.json');
        if (! file_exists($seoPath)) {
            $this->command->warn('pages_seo.json not found, skipping SEO seed.');

            return;
        }

        $pages = json_decode(file_get_contents($seoPath), true);
        if (empty($pages)) {
            return;
        }

        $model = new PageSEO;
        foreach ($pages as $slug => $data) {
            $data['slug'] = $slug;
            $model::updateOrCreate(
                ['slug' => $slug],
                $data
            );
        }

        $this->command->info('Seeded '.count($pages).' SEO pages.');
    }
}
