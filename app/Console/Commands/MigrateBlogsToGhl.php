<?php

namespace App\Console\Commands;

use App\Services\GoHighLevelService;
use Illuminate\Console\Command;

class MigrateBlogsToGhl extends Command
{
    protected $signature = 'blogs:migrate-to-ghl
        {--force : Re-migrate already migrated blogs}
        {--dry-run : Preview what would be migrated without actually sending}';

    protected $description = 'Migrate all blogs from content/blogs.json to GoHighLevel';

    private const MAPPING_FILE = 'storage/app/ghl-blog-mapping.json';

    public function handle(GoHighLevelService $ghl): int
    {
        if (! $ghl->isConfigured()) {
            $this->error('GHL is not configured. Set GHL_API_KEY and GHL_LOCATION_ID in .env');
            return self::FAILURE;
        }

        $blogs = json_decode(file_get_contents(base_path('content/blogs.json')), true);
        if (empty($blogs)) {
            $this->error('No blogs found in content/blogs.json');
            return self::FAILURE;
        }

        $mapping = $this->loadMapping();
        $migrated = 0;
        $skipped = 0;
        $failed = 0;

        $this->info("Found " . count($blogs) . " blogs in content/blogs.json");

        foreach ($blogs as $blog) {
            if (! ($blog['published'] ?? false)) {
                $skipped++;
                continue;
            }

            $slug = $blog['slug'] ?? null;
            if (! $slug) {
                $skipped++;
                continue;
            }

            if (isset($mapping[$slug]) && ! $this->option('force')) {
                $this->line("  ⏭ Skipped {$slug} (already migrated, use --force to re-migrate)");
                $skipped++;
                continue;
            }

            $coverImageUrl = $blog['coverImage'] ?? null;
            if ($coverImageUrl && ! str_starts_with($coverImageUrl, 'http')) {
                $coverImageUrl = url($coverImageUrl);
            }

            $contentHtml = GoHighLevelService::textToHtml($blog['content'] ?? $blog['content_es'] ?? '');
            $lang = $blog['language'] ?? 'en';

            $payload = [
                'title' => $blog['title'] ?? $blog['title_es'] ?? 'Untitled',
                'content' => $contentHtml,
                'status' => 'PUBLISHED',
                'slug' => $lang === 'es' ? "es/{$slug}" : $slug,
                'featuredImageUrl' => $coverImageUrl,
                'metaDescription' => $blog['excerpt'] ?? $blog['excerpt_es'] ?? '',
                'categories' => [$blog['category'] ?? $blog['category_es'] ?? 'General'],
                'author' => $blog['author'] ?? 'A1 Training Group',
                'publishedAt' => $blog['createdAt'] ?? now()->toDateString(),
            ];

            if ($this->option('dry-run')) {
                $this->line("  📝 Would migrate: {$slug} — {$payload['title']}");
                $migrated++;
                continue;
            }

            $this->line("  📤 Migrating: {$slug}...");
            $result = $ghl->createBlogPost($payload);

            if ($result && isset($result['post']['id'])) {
                $mapping[$slug] = [
                    'ghl_post_id' => $result['post']['id'],
                    'title' => $payload['title'],
                    'migrated_at' => now()->toIso8601String(),
                ];
                $this->line("  ✅ Migrated: {$slug} → GHL ID: {$result['post']['id']}");
                $migrated++;
            } else {
                $this->error("  ❌ Failed to migrate: {$slug}");
                $failed++;
            }
        }

        $this->saveMapping($mapping);

        $this->newLine();
        $this->table(
            ['Result', 'Count'],
            [
                ['Migrated', $migrated],
                ['Skipped', $skipped],
                ['Failed', $failed],
                ['Total', count($blogs)],
            ]
        );

        return $failed > 0 ? self::FAILURE : self::SUCCESS;
    }

    private function loadMapping(): array
    {
        $path = storage_path(self::MAPPING_FILE);
        if (! file_exists($path)) {
            return [];
        }
        return json_decode(file_get_contents($path), true) ?? [];
    }

    private function saveMapping(array $mapping): void
    {
        $path = storage_path(self::MAPPING_FILE);
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($path, json_encode($mapping, JSON_PRETTY_PRINT));
    }
}
