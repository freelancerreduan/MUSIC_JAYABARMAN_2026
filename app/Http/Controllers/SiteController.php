<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\ArchiveItem;
use App\Models\Concert;
use App\Models\CvSection;
use App\Models\FeaturedWork;
use App\Models\MediaItem;
use App\Models\Message;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home', [
            'page' => Page::bySlug('home'),
            'latest' => Concert::where('is_active', true)->orderByDesc('is_featured')->orderByDesc('event_date')->first(),
        ]);
    }

    public function project()
    {
        return view('site.project', [
            'page' => Page::bySlug('project'),
            'works' => FeaturedWork::where('is_active', true)->orderBy('sort_order')->get(),
            'videos' => Video::where('is_active', true)->where('in_project', true)->orderBy('sort_order')->get(),
            'photos' => Photo::where('is_active', true)->where('category', 'project')->orderBy('sort_order')->get(),
        ]);
    }

    public function performance()
    {
        return view('site.performance', [
            'page' => Page::bySlug('performance'),
            'concerts' => Concert::where('is_active', true)->orderByDesc('is_featured')->orderByDesc('event_date')->get(),
            'videos' => Video::where('is_active', true)->where('in_performance', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function interview()
    {
        return $this->media('interview');
    }

    public function news()
    {
        return $this->media('news', 'news-views');
    }

    private function media(string $type, ?string $slug = null)
    {
        return view('site.media', [
            'page' => Page::bySlug($slug ?? $type),
            'items' => MediaItem::where('is_active', true)->where('type', $type)->orderBy('sort_order')->get(),
        ]);
    }

    public function portfolio()
    {
        $photos = Photo::where('is_active', true)->where('category', 'portfolio')->orderBy('sort_order')->get();

        return view('site.portfolio', [
            'page' => Page::bySlug('portfolio'),
            'photos' => $photos,
            'tags' => $photos->pluck('tag')->filter()->unique()->values(),
        ]);
    }

    public function archive()
    {
        return view('site.archive', [
            'page' => Page::bySlug('archive'),
            'items' => ArchiveItem::where('is_active', true)->orderBy('sort_order')->orderByDesc('year')->get(),
        ]);
    }

    public function about()
    {
        return view('site.about', [
            'page' => Page::bySlug('about'),
            'affiliations' => Affiliation::orderBy('sort_order')->get(),
            'sections' => CvSection::with('blocks')->orderBy('sort_order')->get(),
        ]);
    }

    public function contact()
    {
        return view('site.contact', ['page' => Page::bySlug('contact')]);
    }

    public function sendMessage(Request $request)
    {
        // Honeypot: real visitors never fill the hidden "website" field
        if ($request->filled('website')) {
            return back()->with('sent', true);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        Message::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'] ?? 'Other',
            'body' => $data['message'],
            'ip' => $request->ip(),
        ]);

        return redirect()->to(route('contact').'#message')->with('sent', true);
    }
}
