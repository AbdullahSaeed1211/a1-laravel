<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoHighLevelService
{
    private string $apiKey;
    private string $locationId;
    private string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.ghl.api_key');
        $this->locationId = config('services.ghl.location_id');
        $this->baseUrl = config('services.ghl.base_url');
    }

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Version' => '2021-07-28',
            'Content-Type' => 'application/json',
        ];
    }

    public function createBlogPost(array $data): ?array
    {
        $payload = array_merge([
            'locationId' => $this->locationId,
        ], $data);

        $response = Http::withHeaders($this->headers())
            ->post("{$this->baseUrl}/blog/post", $payload);

        if (! $response->successful()) {
            Log::error('GHL blog post creation failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;
        }

        return $response->json();
    }

    public function updateBlogPost(string $postId, array $data): ?array
    {
        $response = Http::withHeaders($this->headers())
            ->put("{$this->baseUrl}/blog/post/{$postId}", $data);

        if (! $response->successful()) {
            Log::error('GHL blog post update failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;
        }

        return $response->json();
    }

    public function deleteBlogPost(string $postId): bool
    {
        $response = Http::withHeaders($this->headers())
            ->delete("{$this->baseUrl}/blog/post/{$postId}");

        return $response->successful();
    }

    public function getBlogPosts(int $limit = 50, int $offset = 0): ?array
    {
        $response = Http::withHeaders($this->headers())
            ->get("{$this->baseUrl}/blog/post", [
                'locationId' => $this->locationId,
                'limit' => $limit,
                'offset' => $offset,
            ]);

        if (! $response->successful()) {
            Log::error('GHL blog posts fetch failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return null;
        }

        return $response->json();
    }

    public static function textToHtml(string $text): string
    {
        $paragraphs = array_filter(explode("\n", $text), fn ($p) => trim($p) !== '');
        $html = '';

        foreach ($paragraphs as $p) {
            $trimmed = trim($p);

            if (str_starts_with($trimmed, '#')) {
                $level = 1;
                $content = ltrim($trimmed, '# ');
                $html .= "<h{$level}>" . htmlspecialchars($content) . "</h{$level}>";
            } else {
                $html .= '<p>' . htmlspecialchars($trimmed) . '</p>';
            }
        }

        return $html;
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->locationId);
    }
}
