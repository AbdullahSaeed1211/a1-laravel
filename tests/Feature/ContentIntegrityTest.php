<?php

namespace Tests\Feature;

use Tests\TestCase;

class ContentIntegrityTest extends TestCase
{
    private function loadJson(string $path): array
    {
        $fullPath = base_path("content/{$path}");
        $this->assertFileExists($fullPath, "Missing content file: {$path}");

        return json_decode(file_get_contents($fullPath), true) ?? [];
    }

    // ─── Services ───

    public function test_services_json_is_valid(): void
    {
        $services = $this->loadJson('services.json');
        $this->assertNotEmpty($services);

        foreach ($services as $service) {
            $this->assertArrayHasKey('slug', $service);
            $this->assertArrayHasKey('title', $service);
            $this->assertArrayHasKey('titleEs', $service);
            $this->assertArrayHasKey('description', $service);
            $this->assertArrayHasKey('descriptionEs', $service);
            $this->assertArrayHasKey('category', $service);
            $this->assertArrayHasKey('benefits', $service);
            $this->assertArrayHasKey('benefitsEs', $service);
            $this->assertNotEmpty($service['benefits']);
            $this->assertNotEmpty($service['benefitsEs']);
            $this->assertCount(count($service['benefits']), $service['benefitsEs'],
                "Benefits count mismatch for {$service['slug']}");
        }
    }

    public function test_all_services_have_pricing(): void
    {
        $services = $this->loadJson('services.json');
        $pricing = $this->loadJson('pricing.json');

        foreach ($services as $service) {
            $this->assertArrayHasKey($service['slug'], $pricing,
                "Missing pricing for service: {$service['slug']}");
            $this->assertNotEmpty($pricing[$service['slug']],
                "Empty pricing for service: {$service['slug']}");
        }
    }

    // ─── Pricing ───

    public function test_pricing_json_is_valid(): void
    {
        $pricing = $this->loadJson('pricing.json');
        $this->assertNotEmpty($pricing);

        foreach ($pricing as $slug => $plans) {
            foreach ($plans as $plan) {
                $this->assertArrayHasKey('name', $plan, "Missing name in {$slug}");
                $this->assertArrayHasKey('price', $plan, "Missing price in {$slug}");
                $this->assertArrayHasKey('location', $plan, "Missing location in {$slug}");
                $this->assertContains($plan['location'], ['home', 'gym', 'any', 'virtual'],
                    "Invalid location '{$plan['location']}' in {$slug}");
            }
        }
    }

    // ─── Service Pages ───

    public function test_service_pages_json_is_valid(): void
    {
        $servicePages = $this->loadJson('service-pages.json');
        $this->assertNotEmpty($servicePages);

        foreach ($servicePages as $slug => $subPages) {
            foreach ($subPages as $key => $page) {
                $this->assertArrayHasKey('title', $page, "Missing title in {$slug}.{$key}");
                $this->assertArrayHasKey('titleEs', $page, "Missing titleEs in {$slug}.{$key}");
                $this->assertArrayHasKey('headline', $page, "Missing headline in {$slug}.{$key}");
                $this->assertArrayHasKey('headlineEs', $page, "Missing headlineEs in {$slug}.{$key}");
                $this->assertArrayHasKey('intro', $page, "Missing intro in {$slug}.{$key}");
                $this->assertArrayHasKey('introEs', $page, "Missing introEs in {$slug}.{$key}");
                $this->assertArrayHasKey('sections', $page, "Missing sections in {$slug}.{$key}");
                $this->assertArrayHasKey('faq', $page, "Missing faq in {$slug}.{$key}");
            }
        }
    }

    public function test_all_service_pages_have_routes(): void
    {
        $servicePages = $this->loadJson('service-pages.json');

        foreach ($servicePages as $slug => $subPages) {
            foreach ($subPages as $key => $page) {
                $response = $this->get("/services/{$slug}/{$key}");
                $response->assertOk("Service sub-page /services/{$slug}/{$key} returned {$response->getStatusCode()}");
            }
        }
    }

    // ─── Trainers ───

    public function test_trainers_json_is_valid(): void
    {
        $trainers = $this->loadJson('trainers.json');
        $this->assertCount(6, $trainers);

        foreach ($trainers as $trainer) {
            $this->assertArrayHasKey('slug', $trainer);
            $this->assertArrayHasKey('name', $trainer);
            $this->assertArrayHasKey('title', $trainer);
            $this->assertArrayHasKey('titleEs', $trainer);
            $this->assertArrayHasKey('bio', $trainer);
            $this->assertArrayHasKey('bioEs', $trainer);
            $this->assertArrayHasKey('specialties', $trainer);
            $this->assertArrayHasKey('specialtiesEs', $trainer);
            $this->assertNotEmpty($trainer['specialties']);
            $this->assertNotEmpty($trainer['specialtiesEs']);
            $this->assertCount(count($trainer['specialties']), $trainer['specialtiesEs'],
                "Specialties count mismatch for {$trainer['slug']}");
        }
    }

    // ─── Blogs ───

    public function test_blogs_json_is_valid(): void
    {
        $blogs = $this->loadJson('blogs.json');
        $this->assertNotEmpty($blogs);

        foreach ($blogs as $blog) {
            $this->assertArrayHasKey('slug', $blog);
            $this->assertArrayHasKey('title', $blog);
            $this->assertArrayHasKey('title_es', $blog);
            $this->assertArrayHasKey('excerpt', $blog);
            $this->assertArrayHasKey('content', $blog);
            $this->assertArrayHasKey('published', $blog);
            $this->assertArrayHasKey('createdAt', $blog);
            $this->assertArrayHasKey('category', $blog);
            $this->assertArrayHasKey('author', $blog);
        }
    }

    public function test_published_blogs_render(): void
    {
        $blogs = $this->loadJson('blogs.json');
        $published = array_filter($blogs, fn ($b) => $b['published'] ?? false);

        $this->assertNotEmpty($published, 'No published blog posts found');

        foreach ($published as $blog) {
            $response = $this->get("/blog/{$blog['slug']}");
            $response->assertOk("Blog post /blog/{$blog['slug']} returned {$response->getStatusCode()}");
        }
    }

    // ─── SEO ───

    public function test_pages_seo_json_is_valid(): void
    {
        $seo = $this->loadJson('pages_seo.json');
        $this->assertNotEmpty($seo);

        foreach ($seo as $slug => $data) {
            $this->assertArrayHasKey('title', $data, "Missing title for {$slug}");
            $this->assertArrayHasKey('description', $data, "Missing description for {$slug}");
            $this->assertArrayHasKey('title_es', $data, "Missing title_es for {$slug}");
            $this->assertArrayHasKey('description_es', $data, "Missing description_es for {$slug}");
            $this->assertArrayHasKey('keywords', $data, "Missing keywords for {$slug}");
        }
    }

    // ─── Translations ───

    public function test_translations_are_complete(): void
    {
        $en = json_decode(file_get_contents(lang_path('en.json')), true);
        $es = json_decode(file_get_contents(lang_path('es.json')), true);

        $this->assertNotNull($en, 'en.json is not valid JSON');
        $this->assertNotNull($es, 'es.json is not valid JSON');

        foreach ($en as $key => $value) {
            $this->assertArrayHasKey($key, $es, "Missing Spanish translation for key: {$key}");
        }

        $this->assertCount(count($en), $es, 'Translation key count mismatch');
    }
}
