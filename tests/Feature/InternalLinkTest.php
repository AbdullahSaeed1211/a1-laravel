<?php

namespace Tests\Feature;

use Tests\TestCase;

class InternalLinkTest extends TestCase
{
    // ─── Homepage links ───

    public function test_homepage_links_to_personal_training(): void
    {
        $this->get('/')->assertSee('/services/personal-training');
    }

    public function test_homepage_links_to_physical_therapy(): void
    {
        $this->get('/')->assertSee('/services/physical-therapy');
    }

    public function test_homepage_links_to_boxing(): void
    {
        $this->get('/')->assertSee('/services/boxing');
    }

    public function test_homepage_links_to_consultations(): void
    {
        $this->get('/')->assertSee('/services/consultations');
    }

    public function test_homepage_links_to_services_index(): void
    {
        $this->get('/')->assertSee('/services');
    }

    public function test_homepage_links_to_trainers(): void
    {
        $this->get('/')->assertSee('/trainers');
    }

    public function test_homepage_links_to_blog(): void
    {
        $this->get('/')->assertSee('/blog');
    }

    // ─── Service page cross-links ───

    public function test_service_detail_links_to_consultations(): void
    {
        $response = $this->get('/services/boxing');
        $response->assertOk();
        $response->assertSee('/services/consultations');
    }

    public function test_service_detail_links_to_free_consultation(): void
    {
        $this->get('/services/personal-training')->assertSee('/services/consultations');
    }

    // ─── Sub-page links ───

    public function test_service_sub_page_links_to_parent(): void
    {
        $this->get('/services/personal-training/studio')->assertSee('/services/personal-training');
    }

    public function test_service_sub_page_links_to_other_services(): void
    {
        $this->get('/services/personal-training/studio')->assertSee('/services/partner-training');
    }

    public function test_service_sub_page_links_to_contact(): void
    {
        $this->get('/services/personal-training/in-home')->assertSee('/contact');
    }

    // ─── Trainer page links ───

    public function test_trainer_index_links_to_detail(): void
    {
        $this->get('/trainers')->assertSee('/trainers/hai-lin');
    }

    public function test_trainer_detail_links_to_related_services(): void
    {
        $this->get('/trainers/hai-lin')
            ->assertSee('/services/personal-training')
            ->assertSee('/services/physical-therapy');
    }

    public function test_trainer_detail_links_to_consultations(): void
    {
        $this->get('/trainers/hai-lin')->assertSee('/services/consultations');
    }

    // ─── Blog links ───

    public function test_blog_index_links_to_detail(): void
    {
        $this->get('/blog')->assertSee('/blog/creatine-truth');
    }

    public function test_blog_detail_links_to_related_posts(): void
    {
        $this->get('/blog/creatine-truth')->assertSee('/blog/');
    }

    public function test_blog_detail_has_category_cta(): void
    {
        $this->get('/blog/sleep-performance')->assertSee('/services/consultations');
    }

    // ─── Content page links ───

    public function test_about_page_links_to_trainers(): void
    {
        $this->get('/about')->assertSee('/trainers');
    }

    public function test_a1_black_member_links_to_consultations(): void
    {
        $this->get('/a1-black-member')->assertSee('/services/consultations');
    }

    public function test_refer_friends_links_to_contact(): void
    {
        $this->get('/refer-friends')->assertSee('/contact');
    }

    // ─── Navbar links ───

    public function test_navbar_links_to_all_major_sections(): void
    {
        $this->get('/')
            ->assertSee('/services')
            ->assertSee('/trainers')
            ->assertSee('/blog')
            ->assertSee('/about')
            ->assertSee('/contact')
            ->assertSee('/a1-black-member');
    }

    // ─── Footer links ───

    public function test_footer_links_to_privacy_and_terms(): void
    {
        $this->get('/')
            ->assertSee('/privacy')
            ->assertSee('/terms');
    }

    // ─── CTA links ───

    public function test_all_cta_sections_link_to_consultations(): void
    {
        $this->get('/')
            ->assertSee('/services/consultations');
    }

    // ─── Spanish internal links ───

    public function test_spanish_homepage_links_to_spanish_services(): void
    {
        $this->get('/es')->assertSee('/es/services');
    }

    public function test_spanish_service_links_spanish_consultations(): void
    {
        $this->get('/es/services/boxing')->assertSee('/es/services/consultations');
    }
}
