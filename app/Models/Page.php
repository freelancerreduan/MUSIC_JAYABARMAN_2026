<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use LogsActivity;

    protected $fillable = ['slug', 'nav_label', 'eyebrow', 'title', 'subtitle', 'hero_image', 'hero_position', 'meta_description', 'show_in_nav', 'sort_order'];

    protected $casts = ['show_in_nav' => 'boolean'];

    const ROUTES = [
        'home' => 'home', 'project' => 'project', 'performance' => 'performance', 'interview' => 'interview',
        'news-views' => 'news', 'portfolio' => 'portfolio', 'archive' => 'archive', 'about' => 'about', 'contact' => 'contact',
    ];

    public function routeName(): string
    {
        return self::ROUTES[$this->slug] ?? 'home';
    }

    public function url(): string
    {
        return route($this->routeName());
    }

    public function activityLabel(): string
    {
        return $this->nav_label;
    }

    public static function bySlug(string $slug): self
    {
        return static::where('slug', $slug)->first() ?? new static(['slug' => $slug, 'title' => ucfirst($slug), 'nav_label' => ucfirst($slug)]);
    }
}
