<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('media_url')) {
    /** Stored paths are either full URLs or paths inside /public (assets/..., uploads/...). */
    function media_url(?string $path): string
    {
        if (! $path) {
            return '';
        }

        return preg_match('#^(https?:)?//#', $path) ? $path : asset(ltrim($path, '/'));
    }
}

if (! function_exists('short_number')) {
    /** Short number: 1.2k, 3.4M. */
    function short_number(int|float $n): string
    {
        return match (true) {
            $n >= 1_000_000 => round($n / 1_000_000, 1).'M',
            $n >= 1_000 => round($n / 1_000, 1).'k',
            default => (string) $n,
        };
    }
}

if (! function_exists('thumb_url')) {
    /** Small version of an uploaded image (made by Intervention Image), for grids and lists. */
    function thumb_url(?string $path): string
    {
        return media_url(\App\Support\ImageService::thumb($path));
    }
}

if (! function_exists('plain_paragraphs')) {
    /**
     * Text for the admin text boxes: plain paragraphs separated by an empty line.
     * Old HTML is turned into simple marks: **bold**, *italic*, [name](link).
     */
    function plain_paragraphs(?string $text): string
    {
        $text = preg_replace('~</p>\s*<p[^>]*>~i', "\n\n", (string) $text);
        $text = preg_replace('~<(b|strong)>(.*?)</\1>~is', '**$2**', $text);
        $text = preg_replace('~<(em|i)>(.*?)</\1>~is', '*$2*', $text);
        $text = preg_replace('~<a [^>]*href="([^"]+)"[^>]*>(.*?)</a>~is', '[$2]($1)', $text);
        $text = html_entity_decode(strip_tags($text), ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace("/\n{3,}/", "\n\n", $text));
    }
}

if (! function_exists('paragraphs')) {
    /** Admin text as <p> paragraphs: **bold**, *italic*, [name](link); Bangla words get the Bangla font. */
    function paragraphs(?string $text, string $lastClass = 'mb-0'): string
    {
        $parts = array_values(array_filter(array_map('trim', preg_split('/\n\s*\n/', plain_paragraphs($text)))));
        $html = '';
        foreach ($parts as $i => $part) {
            $part = e($part);
            $part = preg_replace('/\*\*(.+?)\*\*/s', '<b>$1</b>', $part);
            $part = preg_replace('/(?<![\w*])\*(?!\s)(.+?)(?<!\s)\*(?![\w*])/s', '<em>$1</em>', $part);
            $part = preg_replace('~\[([^\]]+)\]\((https?://[^)\s]+)\)~', '<a href="$2" target="_blank" rel="noopener">$1</a>', $part);
            $part = preg_replace('/[\x{0980}-\x{09FF}][\x{0980}-\x{09FF}\s,.·।\-]*[\x{0980}-\x{09FF}]|[\x{0980}-\x{09FF}]/u', '<span class="bn">$0</span>', $part);
            $part = nl2br($part, false);
            $html .= ($i === count($parts) - 1 && $lastClass ? "<p class=\"{$lastClass}\">" : '<p>').$part."</p>\n";
        }

        return $html;
    }
}