<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoMetaTest extends TestCase
{
    public function test_homepage_has_brand_name(): void
    {
        $this->get('/')->assertSee('A1 Training');
    }

    public function test_about_page_renders_content(): void
    {
        $this->get('/about')->assertOk();
    }

    public function test_services_page_renders(): void
    {
        $this->get('/services')->assertOk();
    }

    public function test_blog_page_renders(): void
    {
        $this->get('/blog')->assertOk();
    }

    public function test_contact_page_has_canonical(): void
    {
        $this->get('/contact')
            ->assertSee('canonical');
    }

    public function test_homepage_has_canonical_link(): void
    {
        $this->get('/')->assertSee('canonical');
    }

    public function test_spanish_homepage_has_spanish_content(): void
    {
        $this->get('/es')
            ->assertSee('A1 Training Group');
    }

    public function test_service_detail_has_pricing_sidebar(): void
    {
        $this->get('/services/boxing')
            ->assertOk()
            ->assertSee('$');
    }

    public function test_trainer_detail_shows_trainer_name(): void
    {
        $this->get('/trainers/hai-lin')
            ->assertSee('Dr. Hai Lin');
    }

    public function test_blog_index_has_posts(): void
    {
        $response = $this->get('/blog');
        $response->assertOk();
    }

    public function test_reviews_page_has_google_rating(): void
    {
        $this->get('/reviews')
            ->assertSee('Google Rating');
    }

    public function test_service_sub_page_has_breadcrumbs(): void
    {
        $this->get('/services/personal-training/studio')
            ->assertSee('Home')
            ->assertSee('Services');
    }

    public function test_sitemap_contains_routes(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertSee('urlset');
        $response->assertSee('about');
        $response->assertSee('services');
        $response->assertSee('trainers');
    }

    public function test_robots_contains_sitemap(): void
    {
        $this->get('/robots.txt')
            ->assertSee('Sitemap')
            ->assertSee('sitemap.xml');
    }

    public function test_spanish_page_has_canonical(): void
    {
        $this->get('/es/about')
            ->assertSee('canonical');
    }

    public function test_service_sub_page_has_full_content(): void
    {
        $this->get('/services/personal-training/studio')
            ->assertSee('Sanctuary')
            ->assertSee('Performance');
    }

    public function test_service_page_has_benefits(): void
    {
        $this->get('/services/boxing')
            ->assertSee('What You Get');
    }
}
