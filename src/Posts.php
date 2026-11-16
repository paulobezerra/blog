<?php
declare(strict_types=1);

use League\CommonMark\GithubFlavoredMarkdownConverter;

final class Posts
{
    public function __construct(private readonly string $directory) {}

    /** @return list<array<string, mixed>> */
    public function all(): array
    {
        $posts = [];
        foreach (glob($this->directory . '/*.md') ?: [] as $file) {
            $post = $this->read($file);
            if ($post !== null && $post['published']) $posts[] = $post;
        }
        usort($posts, static fn(array $a, array $b): int => [$b['date'], $b['slug']] <=> [$a['date'], $a['slug']]);
        return $posts;
    }

    /** @return array<string, mixed>|null */
    public function find(string $slug): ?array
    {
        if (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) return null;
        $file = $this->directory . '/' . $slug . '.md';
        if (is_file($file)) return $this->read($file);
        foreach (glob($this->directory . '/????_??_??_' . $slug . '.md') ?: [] as $datedFile) {
            if (preg_match('/^\d{4}_\d{2}_\d{2}_' . preg_quote($slug, '/') . '\.md$/D', basename($datedFile))) {
                return $this->read($datedFile);
            }
        }
        return null;
    }

    /** @return array<string, mixed>|null */
    private function read(string $file): ?array
    {
        $raw = file_get_contents($file);
        if ($raw === false || !preg_match('/\A---\s*\R(.*?)\R---\s*\R(.*)\z/s', $raw, $matches)) return null;
        $meta = [];
        foreach (preg_split('/\R/', $matches[1]) ?: [] as $line) {
            if (preg_match('/^([a-z_]+):\s*(.*?)\s*$/', $line, $item)) $meta[$item[1]] = trim($item[2], " \t\"'");
        }
        $slug = preg_replace('/^\d{4}_\d{2}_\d{2}_/', '', basename($file, '.md')) ?? basename($file, '.md');
        $published = strtolower((string)($meta['published'] ?? 'false')) === 'true';
        $body = $matches[2];
        $articleTitle = $meta['title'] ?? $slug;
        $body = preg_replace('/\A#\s+' . preg_quote($articleTitle, '/') . '\s*\R+/u', '', $body, 1) ?? $body;
        $affiliate = str_contains($body, '{{button|') || str_contains($body, '{{sponsored|');
        $body = preg_replace_callback('/^\{\{(button|sponsored)\|([^|\r\n]+)\|([^|\r\n]+)\}\}$/m', static function(array $m) use (&$replacements): string {
            $replacements ??= [];
            $key = 'MARKDOWNACTION' . count($replacements) . 'TOKEN';
            $label = htmlspecialchars(trim($m[2]), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $url = trim($m[3]);
            if ((!preg_match('~^https?://~i', $url) && (!str_starts_with($url, '/') || str_starts_with($url, '//'))) || str_contains($url, chr(92))) return '';
            $href = htmlspecialchars($url, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $class = $m[1] === 'button' ? ' class="button-link"' : '';
            $rel = $m[1] === 'sponsored' ? ' rel="sponsored nofollow"' : '';
            $replacements[$key] = '<a' . $class . ' href="' . $href . '"' . $rel . '>' . $label . '</a>';
            return "\n\n" . $key . "\n\n";
        }, $body) ?? $body;
        $replacements ??= [];
        $converter = new GithubFlavoredMarkdownConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);
        $html = $converter->convert($body)->getContent();
        foreach ($replacements as $key => $value) $html = str_replace('<p>' . $key . '</p>', $value, $html);
        return [
            'slug' => $slug, 'title' => $meta['title'] ?? $slug,
            'description' => $meta['description'] ?? '', 'date' => $meta['date'] ?? '1970-01-01',
            'category' => $meta['category'] ?? '', 'tags' => isset($meta['tags']) ? array_map('trim', explode(',', $meta['tags'])) : [],
            'cover' => $meta['cover'] ?? '', 'published' => $published,
            'content' => $html, 'affiliate' => $affiliate,
        ];
    }
}
