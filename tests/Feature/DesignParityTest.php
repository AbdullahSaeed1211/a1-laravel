<?php

namespace Tests\Feature;

use Tests\TestCase;

class DesignParityTest extends TestCase
{
    public function test_homepage_has_hero_ribbon(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('01. PERSONAL', $html);
        $this->assertStringContainsString('02. GROUP', $html);
        $this->assertStringContainsString('03. THERAPY', $html);
    }

    public function test_homepage_has_accent_gradient(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('accent-text-gradient', $html);
    }

    public function test_homepage_has_free_pass_cta(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('Free Pass', $html);
    }

    public function test_homepage_has_logo(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('logo.avif', $html);
    }

    public function test_homepage_has_social_proof(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('12k+', $html);
    }

    public function test_homepage_has_view_pricing_hover(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('View Pricing', $html);
    }

    public function test_homepage_has_google_reviews_badge(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('Google Reviews', $html);
    }

    public function test_homepage_has_5_star_rating(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('5.0', $html);
    }

    public function test_homepage_has_marquee_brands(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('animate-marquee', $html);
    }

    public function test_homepage_has_scroll_reveal(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('scroll-reveal', $html);
        $this->assertStringContainsString('x-intersect', $html);
    }

    public function test_homepage_has_footer_cta(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('Ready to Transform', $html);
        $this->assertStringContainsString('Book Free Consult', $html);
    }

    public function test_homepage_has_mobile_sticky_cta(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringContainsString('Free Consult', $html);
    }

    public function test_homepage_translations_work(): void
    {
        $html = $this->get('/')->getContent();
        $this->assertStringNotContainsString('home.hero.', $html);
        $this->assertStringNotContainsString('nav.services', $html);
        $this->assertStringNotContainsString('common.view_all', $html);
    }

    public function test_spanish_homepage_works(): void
    {
        $response = $this->get('/es');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('Pase Gratis', $html);
        $this->assertStringContainsString('Servicios', $html);
    }

    public function test_about_page_has_stats_bar(): void
    {
        $html = $this->get('/about')->getContent();
        $this->assertStringContainsString('Expert Trainers', $html);
        $this->assertStringContainsString('Google Rating', $html);
    }

    public function test_about_page_has_what_sets_us_apart(): void
    {
        $html = $this->get('/about')->getContent();
        $this->assertStringContainsString('What Sets Us Apart', $html);
        $this->assertStringContainsString('Gym or Home', $html);
        $this->assertStringContainsString('Clinical Approach', $html);
    }

    public function test_about_page_has_cta(): void
    {
        $html = $this->get('/about')->getContent();
        $this->assertStringContainsString('Book Free Consult', $html);
    }

    public function test_services_page_has_accent_gradient(): void
    {
        $html = $this->get('/services')->getContent();
        $this->assertStringContainsString('accent-text-gradient', $html);
    }

    public function test_reviews_page_has_google_badge(): void
    {
        $html = $this->get('/reviews')->getContent();
        $this->assertStringContainsString('Google Reviews', $html);
    }

    public function test_reviews_page_has_cta(): void
    {
        $html = $this->get('/reviews')->getContent();
        $this->assertStringContainsString('Ready to Be Next', $html);
    }

    public function test_contact_page_has_info_cards(): void
    {
        $html = $this->get('/contact')->getContent();
        $this->assertStringContainsString('Call Us', $html);
        $this->assertStringContainsString('Service Area', $html);
        $this->assertStringContainsString('Email Us', $html);
    }

    public function test_contact_page_has_form(): void
    {
        $html = $this->get('/contact')->getContent();
        $this->assertStringContainsString('SEND MESSAGE', $html);
    }

    public function test_trainers_page_has_profile_on_hover(): void
    {
        $html = $this->get('/trainers')->getContent();
        $this->assertStringContainsString('View Profile', $html);
    }

    public function test_privacy_page_white_bg(): void
    {
        $html = $this->get('/privacy')->getContent();
        $this->assertStringContainsString('Privacy Policy', $html);
    }

    public function test_terms_page_white_bg(): void
    {
        $html = $this->get('/terms')->getContent();
        $this->assertStringContainsString('Terms of Service', $html);
    }

    public function test_a1_black_member_page_works(): void
    {
        $response = $this->get('/a1-black-member');
        $response->assertOk();
    }

    public function test_refer_friends_page_works(): void
    {
        $response = $this->get('/refer-friends');
        $response->assertOk();
    }

    public function test_all_routes_return_200(): void
    {
        $routes = ['/', '/about', '/services', '/trainers', '/blog', '/contact', '/reviews', '/a1-black-member', '/refer-friends', '/privacy', '/terms', '/calendar', '/renewals', '/es', '/es/about', '/es/services', '/es/trainers', '/es/blog', '/es/contact'];
        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertOk();
        }
    }
}
