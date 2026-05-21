<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GhlBlogService
{
    private string $rssUrl;
    private string $locationId;
    private string $blogId;

    public function __construct()
    {
        $this->locationId = config('services.ghl.location_id');
        $this->blogId = config('services.ghl.blog_id');
        $this->rssUrl = "https://rss-link.com/feed/{$this->locationId}?blogId={$this->blogId}&limit=100&loadContent=true";
    }

    public function all(): array
    {
        $response = Http::timeout(30)->get($this->rssUrl);

        if (! $response->successful()) {
            return [];
        }

        $xml = simplexml_load_string($response->body());
        if (! $xml) {
            return [];
        }

        $posts = [];
        foreach ($xml->channel->item as $item) {
            $namespaces = $item->getNamespaces(true);

            $content = '';
            if (isset($namespaces['content'])) {
                $content = (string) $item->children($namespaces['content'])->encoded;
            }

            $image = '';
            if (isset($namespaces['media'])) {
                $image = (string) $item->children($namespaces['media'])->content;
            }

            $link = (string) $item->link;
            $slug = '';
            if (preg_match('/\/post\/([^\/]+)$/', $link, $m)) {
                $slug = $m[1];
            }

            $pubDate = (string) $item->pubDate;
            $createdAt = $pubDate ? date('Y-m-d', strtotime($pubDate)) : date('Y-m-d');

            $posts[] = [
                'slug' => $slug,
                'title' => (string) $item->title,
                'title_es' => (string) $item->title,
                'content' => $content,
                'content_es' => $content,
                'excerpt' => strip_tags((string) $item->description),
                'excerpt_es' => strip_tags((string) $item->description),
                'coverImage' => $image,
                'category' => (string) $item->category,
                'category_es' => (string) $item->category,
                'author' => 'A1 Training Group',
                'createdAt' => $createdAt,
                'published' => true,
                'language' => 'en',
            ];
        }

        return $posts;
    }

    public function findBySlug(string $slug): ?array
    {
        $posts = $this->all();
        foreach ($posts as $post) {
            if ($post['slug'] === $slug) {
                return $post;
            }
        }
        return null;
    }

    public function isConfigured(): bool
    {
        return ! empty($this->locationId) && ! empty($this->blogId);
    }
}
