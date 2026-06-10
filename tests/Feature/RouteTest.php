<?php

namespace Tests\Feature;

use Tests\TestCase;

class RouteTest extends TestCase
{
    // ─── English Public Routes ───

    public function test_homepage(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_about_page(): void
    {
        $this->get('/about')->assertOk();
    }

    public function test_services_index(): void
    {
        $this->get('/services')->assertOk();
    }

    public function test_service_detail(): void
    {
        $this->get('/services/personal-training')->assertOk();
        $this->get('/services/partner-training')->assertOk();
        $this->get('/services/physical-therapy')->assertOk();
        $this->get('/services/massage-therapy')->assertOk();
        $this->get('/services/registered-dietitians')->assertOk();
        $this->get('/services/kettlebell')->assertOk();
        $this->get('/services/boxing')->assertOk();
        $this->get('/services/online-hybrid')->assertOk();
        $this->get('/services/consultations')->assertOk();
    }

    public function test_service_sub_pages(): void
    {
        $this->get('/services/personal-training/studio')->assertOk();
        $this->get('/services/personal-training/in-home')->assertOk();
        $this->get('/services/physical-therapy/studio')->assertOk();
        $this->get('/services/physical-therapy/in-home')->assertOk();
        $this->get('/services/boxing/studio')->assertOk();
        $this->get('/services/massage-therapy/studio')->assertOk();
        $this->get('/services/kettlebell/course')->assertOk();
    }

    public function test_service_404(): void
    {
        $this->get('/services/non-existent-service')->assertNotFound();
    }

    public function test_trainers_index(): void
    {
        $this->get('/trainers')->assertOk();
    }

    public function test_trainer_detail(): void
    {
        $this->get('/trainers/hai-lin')->assertOk();
        $this->get('/trainers/wei')->assertOk();
        $this->get('/trainers/kate')->assertOk();
        $this->get('/trainers/jamie')->assertOk();
        $this->get('/trainers/phillip')->assertOk();
        $this->get('/trainers/abby')->assertOk();
    }

    public function test_trainer_404(): void
    {
        $this->get('/trainers/non-existent-trainer')->assertNotFound();
    }

    public function test_blog_index(): void
    {
        $this->get('/blog')->assertOk();
    }

    public function test_blog_detail(): void
    {
        $this->get('/blog/creatine-truth')->assertOk();
    }

    public function test_blog_404(): void
    {
        $this->get('/blog/non-existent-post')->assertNotFound();
    }

    public function test_a1_black_member(): void
    {
        $this->get('/a1-black-member')->assertOk();
    }

    public function test_refer_friends(): void
    {
        $this->get('/refer-friends')->assertOk();
    }

    public function test_reviews(): void
    {
        $this->get('/reviews')->assertOk();
    }

    public function test_contact_page(): void
    {
        $this->get('/contact')->assertOk();
    }

    public function test_privacy(): void
    {
        $this->get('/privacy')->assertOk();
    }

    public function test_terms(): void
    {
        $this->get('/terms')->assertOk();
    }

    public function test_calendar(): void
    {
        $this->get('/calendar')->assertOk();
    }

    public function test_renewals(): void
    {
        $this->get('/renewals')->assertOk();
    }

    public function test_sitemap(): void
    {
        $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml');
    }

    public function test_robots(): void
    {
        $this->get('/robots.txt')->assertOk()->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
    }

    // ─── Spanish Routes ───

    public function test_spanish_homepage(): void
    {
        $this->get('/es')->assertOk();
    }

    public function test_spanish_about(): void
    {
        $this->get('/es/about')->assertOk();
    }

    public function test_spanish_services(): void
    {
        $this->get('/es/services')->assertOk();
    }

    public function test_spanish_service_detail(): void
    {
        $this->get('/es/services/personal-training')->assertOk();
    }

    public function test_spanish_blog(): void
    {
        $this->get('/es/blog')->assertOk();
    }

    public function test_spanish_contact(): void
    {
        $this->get('/es/contact')->assertOk();
    }

    public function test_spanish_trainers(): void
    {
        $this->get('/es/trainers')->assertOk();
        $this->get('/es/trainers/hai-lin')->assertOk();
    }

    public function test_spanish_service_sub_page(): void
    {
        $this->get('/es/services/personal-training/studio')->assertOk();
    }

    public function test_spanish_privacy(): void
    {
        $this->get('/es/privacy')->assertOk();
    }

    public function test_spanish_terms(): void
    {
        $this->get('/es/terms')->assertOk();
    }

    // ─── Wix 301 Redirects ───

    public function test_wix_pages_serve_content(): void
    {
        $this->get('/privacy-policy')->assertOk();
        $this->get('/terms-and-conditions')->assertOk();
        $this->get('/about-9')->assertOk();
        $this->get('/testimonials')->assertOk();
        $this->get('/what-sets-us-apart')->assertOk();
        $this->get('/referral')->assertOk();
        $this->get('/loyalty')->assertOk();
        $this->get('/boxing')->assertOk();
        $this->get('/personal-training-packages')->assertOk();
    }

    public function test_book_online_redirect(): void
    {
        $this->get('/book-online')->assertRedirect('/services/consultations');
    }

    public function test_pre_contact_form_redirect(): void
    {
        $this->get('/pre-contact-form')->assertRedirect('/contact');
    }

    public function test_book_consult_redirect(): void
    {
        $this->get('/book-a-consult')->assertRedirect('/services/consultations');
    }

    public function test_coach_redirect(): void
    {
        $this->get('/coach-wei')->assertRedirect('/trainers/wei');
        $this->get('/coach-kate')->assertRedirect('/trainers/kate');
        $this->get('/coach-jamie')->assertRedirect('/trainers/jamie');
        $this->get('/coach-phillip')->assertRedirect('/trainers/phillip');
        $this->get('/coach-abby')->assertRedirect('/trainers/abby');
    }

    public function test_post_redirect(): void
    {
        $this->get('/post/some-blog-slug')->assertRedirect('/blog/some-blog-slug');
    }

    // ─── Admin Routes ───

    public function test_admin_dashboard_redirects_when_guest(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }

    public function test_admin_blogs_redirects_when_guest(): void
    {
        $this->get('/admin/blogs')->assertRedirect('/login');
    }

    public function test_admin_seo_redirects_when_guest(): void
    {
        $this->get('/admin/seo')->assertRedirect('/login');
    }

    // ─── 404 Routes ───

    public function test_non_existent_route_returns_404(): void
    {
        $this->get('/this-route-definitely-does-not-exist')->assertNotFound();
    }

    public function test_spanish_non_existent_route_returns_404(): void
    {
        $this->get('/es/this-route-definitely-does-not-exist')->assertNotFound();
    }
}
