<?php

namespace Tests\Feature;

use Tests\TestCase;

class RedirectAndRouteTest extends TestCase
{
    // ─── Wix legacy 301 redirects ───

    public function test_wix_pages_serve_content(): void
    {
        $this->get('/privacy-policy')->assertOk();
        $this->get('/terms-and-conditions')->assertOk();
        $this->get('/about-9')->assertOk();
        $this->get('/boxing')->assertOk();
        $this->get('/testimonials')->assertOk();
        $this->get('/referral')->assertOk();
        $this->get('/loyalty')->assertOk();
        $this->get('/personal-training-packages')->assertOk();
        $this->get('/what-sets-us-apart')->assertOk();
    }

    public function test_book_online_redirects(): void
    {
        $this->get('/book-online')->assertRedirect('/services/consultations')->assertStatus(301);
    }

    public function test_book_consult_redirects(): void
    {
        $this->get('/book-a-consult')->assertRedirect('/services/consultations')->assertStatus(301);
    }

    public function test_pre_contact_form_redirects(): void
    {
        $this->get('/pre-contact-form')->assertRedirect('/contact')->assertStatus(301);
    }

    // ─── Legacy coach URL redirects ───

    public function test_coach_wei_redirects(): void
    {
        $this->get('/coach-wei')->assertRedirect('/trainers/wei')->assertStatus(301);
    }

    public function test_coach_kate_redirects(): void
    {
        $this->get('/coach-kate')->assertRedirect('/trainers/kate')->assertStatus(301);
    }

    public function test_coach_jamie_redirects(): void
    {
        $this->get('/coach-jamie')->assertRedirect('/trainers/jamie')->assertStatus(301);
    }

    public function test_coach_phillip_redirects(): void
    {
        $this->get('/coach-phillip')->assertRedirect('/trainers/phillip')->assertStatus(301);
    }

    public function test_coach_abby_redirects(): void
    {
        $this->get('/coach-abby')->assertRedirect('/trainers/abby')->assertStatus(301);
    }

    // ─── Legacy blog redirect ───

    public function test_legacy_blog_post_redirects(): void
    {
        $this->get('/post/some-blog-post')->assertRedirect('/blog/some-blog-post')->assertStatus(301);
    }

    // ─── Landing pages return 200 ───

    public function test_homepage_returns_200(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_about_page_returns_200(): void
    {
        $this->get('/about')->assertOk();
    }

    public function test_services_returns_200(): void
    {
        $this->get('/services')->assertOk();
    }

    public function test_all_service_details_return_200(): void
    {
        foreach (['personal-training', 'partner-training', 'physical-therapy', 'massage-therapy', 'registered-dietitians', 'kettlebell', 'boxing', 'online-hybrid', 'consultations'] as $slug) {
            $this->get("/services/{$slug}")->assertOk();
        }
    }

    public function test_all_service_sub_pages_return_200(): void
    {
        foreach (['studio', 'in-home'] as $sub) {
            $this->get("/services/personal-training/{$sub}")->assertOk();
            $this->get("/services/physical-therapy/{$sub}")->assertOk();
        }
        $this->get('/services/kettlebell/course')->assertOk();
        $this->get('/services/boxing/studio')->assertOk();
    }

    public function test_trainers_returns_200(): void
    {
        $this->get('/trainers')->assertOk();
    }

    public function test_all_trainer_details_return_200(): void
    {
        foreach (['hai-lin', 'wei', 'kate', 'jamie', 'phillip', 'abby'] as $slug) {
            $this->get("/trainers/{$slug}")->assertOk();
        }
    }

    public function test_blog_returns_200(): void
    {
        $this->get('/blog')->assertOk();
    }

    public function test_blog_posts_return_200(): void
    {
        $this->get('/blog/creatine-truth')->assertOk();
        $this->get('/blog/grip-strength-matters')->assertOk();
        $this->get('/blog/sleep-performance')->assertOk();
    }

    public function test_static_pages_return_200(): void
    {
        foreach (['a1-black-member', 'refer-friends', 'reviews', 'contact', 'privacy', 'terms', 'calendar', 'renewals'] as $page) {
            $this->get("/{$page}")->assertOk();
        }
    }

    public function test_sitemap_returns_200(): void
    {
        $this->get('/sitemap.xml')->assertOk();
    }

    public function test_robots_returns_200(): void
    {
        $this->get('/robots.txt')->assertOk();
    }

    public function test_non_existent_route_returns_404(): void
    {
        $this->get('/this-does-not-exist')->assertNotFound();
    }

    // ─── Admin routes ───

    public function test_admin_redirects_unauthenticated(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_admin_blogs_redirects_unauthenticated(): void
    {
        $this->get('/admin/blogs')->assertRedirect('/login');
    }

    public function test_admin_seo_redirects_unauthenticated(): void
    {
        $this->get('/admin/seo')->assertRedirect('/login');
    }

    // ─── Auth routes ───

    public function test_login_page_returns_200(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_register_page_returns_200(): void
    {
        $this->get('/register')->assertOk();
    }
}
