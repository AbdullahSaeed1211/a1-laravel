<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    public function test_contact_page_renders(): void
    {
        $this->get('/contact')->assertOk();
    }

    public function test_contact_page_renders_spanish(): void
    {
        $this->get('/es/contact')->assertOk();
    }

    public function test_contact_form_submission_success(): void
    {
        Mail::fake();

        $response = $this->post('/api/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '555-1234',
            'message' => 'This is a test message.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_contact_form_returns_success(): void
    {
        Mail::fake();

        $this->post('/api/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Test body.',
        ])->assertRedirect()->assertSessionHas('success');
    }

    public function test_contact_form_validation_name_required(): void
    {
        $response = $this->post('/api/contact', [
            'email' => 'test@example.com',
            'message' => 'Test message.',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_contact_form_validation_email_required(): void
    {
        $response = $this->post('/api/contact', [
            'name' => 'Test User',
            'message' => 'Test message.',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_form_validation_email_format(): void
    {
        $response = $this->post('/api/contact', [
            'name' => 'Test User',
            'email' => 'not-an-email',
            'message' => 'Test message.',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_form_validation_message_required(): void
    {
        $response = $this->post('/api/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('message');
    }

    public function test_contact_form_spanish_submission(): void
    {
        Mail::fake();

        $response = $this->post('/es/api/contact', [
            'name' => 'Usuario de Prueba',
            'email' => 'test@example.com',
            'message' => 'Mensaje de prueba.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
