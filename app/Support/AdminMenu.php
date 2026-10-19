<?php

namespace App\Support;

use App\Models\Page;
use App\Models\User;

/**
 * Admin sidebar. The "Website" part mirrors the public navbar (same names and order),
 * so every section of the site has its own menu entry with the things you can edit there.
 */
class AdminMenu
{
    const ICONS = [
        'home' => 'house-door', 'project' => 'collection-play', 'performance' => 'music-note-beamed',
        'interview' => 'mic', 'news-views' => 'newspaper', 'portfolio' => 'images', 'archive' => 'archive',
        'about' => 'person-vcard', 'contact' => 'telephone',
    ];

    /** Query keys that tell two entries of the same admin page apart. */
    const KEYS = ['section', 'place', 'type', 'category'];

    /**
     * What can be edited for each website section, in the order it appears on the page (top to bottom):
     * [label, route, parameters, active route pattern, where it shows on the page].
     */
    private static function sections(): array
    {
        return [
            'home' => [
                ['About the artist (text & photo)', 'admin.home-about', [], 'admin.home-about', 'Photo and text below the big banner'],
                ['Latest concert box', 'admin.concerts.index', ['section' => 'home'], 'admin.concerts.*', 'Title, short description and photo at the bottom'],
            ],
            'project' => [
                ['Big image cards', 'admin.works.index', [], 'admin.works.*', 'Large picture cards right under the banner'],
                ['Videos', 'admin.videos.index', ['place' => 'project'], 'admin.videos.*', 'Video grid in the middle of the page'],
                ['Photos', 'admin.photos.index', ['category' => 'project'], 'admin.photos.*', 'Photo gallery at the bottom of the page'],
            ],
            'performance' => [
                ['Concert details', 'admin.concerts.index', [], 'admin.concerts.*', 'Title, date, place and description under the banner'],
                ['Performance videos', 'admin.videos.index', ['place' => 'performance'], 'admin.videos.*', 'Title, subtitle, description and video'],
            ],
            'interview' => [
                ['Interview videos', 'admin.media.index', ['type' => 'interview'], 'admin.media.*', 'All videos listed on the page'],
            ],
            'news-views' => [
                ['News & TV videos', 'admin.media.index', ['type' => 'news'], 'admin.media.*', 'All news and TV videos on the page'],
            ],
            'portfolio' => [
                ['Portfolio photos', 'admin.photos.index', ['category' => 'portfolio'], 'admin.photos.*', 'Photo gallery on the page'],
            ],
            'archive' => [
                ['Archive items', 'admin.archive.index', [], 'admin.archive.*', 'All items listed on the page'],
            ],
            'about' => [
                ['Photo', 'admin.home-about', ['section' => 'about'], 'admin.home-about', 'Photo next to Personal Details, under the banner'],
                ['Current status', 'admin.affiliations.index', [], 'admin.affiliations.*', 'Current Status list next to personal details'],
                ['CV boxes (Workshops, Awards…)', 'admin.cv.index', [], 'admin.cv.*', 'All boxes at the bottom of the page. Add new ones here'],
            ],
        ];
    }

    public static function build(User $user, int $unread = 0): array
    {
        $website = [];
        // The Contacts page has no editable content; its messages are under "Messages"
        foreach (Page::where('slug', '!=', 'contact')->orderBy('sort_order')->get() as $page) {
            // Top banners are fixed content, so only the sections below them are listed
            $children = array_map(fn ($c) => [
                $c[0],
                route($c[1], $c[2]),
                self::active($c[3], $c[2]),
                $c[1] === 'admin.messages.index' ? $unread : 0,
                $c[4],
            ], self::sections()[$page->slug] ?? []);
            $website[] = [
                'label' => $page->nav_label,
                'icon' => self::ICONS[$page->slug] ?? 'file-earmark',
                'url' => $page->url(),
                'children' => $children,
                'open' => collect($children)->contains(fn ($c) => $c[2]),
                'badge' => 0,
            ];
        }

        $main = [
            ['Dashboard', 'grid-1x2', route('admin.dashboard'), request()->routeIs('admin.dashboard')],
            ['Messages', 'envelope', route('admin.messages.index'), request()->routeIs('admin.messages.*'), $unread],
            ['View website', 'globe2', route('home'), false, 0, true],
        ];

        return ['main' => $main, 'website' => $website];
    }

    /** "Project › Videos" for the page being edited, with a link to that section of the site. */
    public static function crumb(array $menu): ?array
    {
        foreach ($menu['website'] as $section) {
            foreach ($section['children'] as $child) {
                if ($child[2]) {
                    return ['section' => $section['label'], 'item' => $child[0], 'hint' => $child[4], 'url' => $section['url'], 'icon' => $section['icon']];
                }
            }
        }

        return null;
    }

    private static function active(string $pattern, array $params): bool
    {
        if (! request()->routeIs($pattern)) {
            return false;
        }
        foreach (self::KEYS as $key) {
            if (request()->query($key) !== ($params[$key] ?? null)) {
                return false;
            }
        }

        return true;
    }
}
