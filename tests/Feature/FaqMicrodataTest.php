<?php

namespace Tests\Feature;

use Tests\TestCase;

class FaqMicrodataTest extends TestCase
{
    public function test_about_page_has_faq_jsonld(): void
    {
        $html = $this->get('/about')->getContent();
        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);
        $this->assertNotEmpty($matches[1] ?? '');
        $schemas = json_decode($matches[1], true);
        $this->assertIsArray($schemas);

        $found = false;
        foreach ($schemas as $schema) {
            if (($schema['@type'] ?? '') === 'WebPage') {
                $found = true;
                $this->assertArrayHasKey('breadcrumb', $schema);
                break;
            }
        }
        $this->assertTrue($found, 'WebPage schema with breadcrumb not found');
    }

    public function test_services_page_has_faq_content(): void
    {
        $response = $this->get('/services');
        $response->assertOk();
        $html = $response->getContent();
        preg_match_all('/<button[^>]*>.*?<span[^>]*class="text-white font-bold text-sm[^"]*"[^>]*>([^<]+)</s', $html, $questions);
        $this->assertGreaterThanOrEqual(3, count($questions[1]), 'Services page should have 3+ FAQ questions visible');

        $alpineCount = substr_count($html, 'x-data="{ open: false }"');
        $this->assertGreaterThanOrEqual(3, $alpineCount, 'Services page should have 3+ FAQ accordion items');
    }

    public function test_about_page_has_visible_faq(): void
    {
        $response = $this->get('/about');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('Frequently Asked Questions', $html);
        $this->assertStringContainsString('x-data="{ open: false }"', $html);
    }

    public function test_reviews_page_has_visible_faq(): void
    {
        $response = $this->get('/reviews');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('Frequently Asked Questions', $html);
    }

    public function test_calendar_page_has_visible_faq(): void
    {
        $response = $this->get('/calendar');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('FAQs', $html);
    }

    public function test_renewals_page_has_visible_faq(): void
    {
        $response = $this->get('/renewals');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('FAQs', $html);
    }

    public function test_a1_black_member_page_has_visible_faq(): void
    {
        $response = $this->get('/a1-black-member');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('FAQs', $html);
    }

    public function test_refer_friends_page_has_visible_faq(): void
    {
        $response = $this->get('/refer-friends');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('FAQs', $html);
    }

    public function test_contact_page_has_visible_faq(): void
    {
        $response = $this->get('/contact');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('Common Questions', $html);
    }
}
