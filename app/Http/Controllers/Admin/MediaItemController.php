<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Interview and News & Views pages: embedded YouTube / Facebook videos. */
class MediaItemController extends Controller
{
    public function index(Request $request)
    {
        $type = $this->type($request->type);

        return view('admin.media.index', [
            'type' => $type,
            'items' => MediaItem::where('type', $type)->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.media.form', ['item' => new MediaItem(['type' => $this->type($request->type), 'is_active' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->data($request);
        $item = MediaItem::create($data + ['sort_order' => MediaItem::where('type', $data['type'])->max('sort_order') + 1]);

        return redirect()->route('admin.media.index', ['type' => $item->type])->with('success', 'Video added.');
    }

    public function edit(MediaItem $medium)
    {
        return view('admin.media.form', ['item' => $medium]);
    }

    public function update(Request $request, MediaItem $medium)
    {
        $medium->update($this->data($request));

        return redirect()->route('admin.media.index', ['type' => $medium->type])->with('success', 'Video updated.');
    }

    public function destroy(MediaItem $medium)
    {
        $medium->delete();

        return back()->with('success', 'Video deleted.');
    }

    private function type(?string $type): string
    {
        return array_key_exists($type, MediaItem::TYPES) ? $type : 'interview';
    }

    private function data(Request $request): array
    {
        $data = $request->validate([
            'type' => ['required', Rule::in(array_keys(MediaItem::TYPES))],
            'source' => ['nullable', 'string', 'max:120'],
            'title' => ['required', 'string', 'max:255'],
            'meta' => ['nullable', 'string', 'max:255'],
            'link_url' => ['required', 'url', 'max:1000'],
            'is_active' => ['boolean'],
        ]);

        // The player and the button text come from the link
        $data['embed_url'] = self::embedUrl($data['link_url']);
        $data['link_label'] = str_contains($data['link_url'], 'youtu') ? 'YouTube' : (str_contains($data['link_url'], 'facebook') ? 'Facebook' : 'Open');

        return $data;
    }

    /** Turns a normal YouTube / Facebook link into an embeddable player URL. */
    public static function embedUrl(?string $url): ?string
    {
        if (! $url) {
            return null;
        }
        if (preg_match('~(?:youtu\.be/|youtube\.com/(?:watch\?v=|embed/|shorts/|live/))([\w-]{11})~', $url, $m)) {
            return 'https://www.youtube-nocookie.com/embed/'.$m[1];
        }
        if (str_contains($url, 'facebook.com') && ! str_contains($url, '/plugins/')) {
            return 'https://www.facebook.com/plugins/video.php?href='.rawurlencode($url).'&show_text=false&width=560';
        }

        return $url;
    }
}
