<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Concert;
use App\Support\ImageService;
use Illuminate\Http\Request;

class ConcertController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.concerts.index', [
            'concerts' => Concert::orderByDesc('is_featured')->orderByDesc('event_date')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.concerts.form', ['concert' => new Concert(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        $this->saveFeatured(Concert::create($this->data($request)));

        return redirect()->route('admin.concerts.index')->with('success', 'Concert added.');
    }

    public function edit(Concert $concert)
    {
        return view('admin.concerts.form', compact('concert'));
    }

    public function update(Request $request, Concert $concert)
    {
        $concert->update($this->data($request, $concert));
        $this->saveFeatured($concert);

        return redirect()->route('admin.concerts.index')->with('success', 'Concert updated.');
    }

    public function destroy(Concert $concert)
    {
        ImageService::delete($concert->image);
        $concert->delete();

        return back()->with('success', 'Concert deleted.');
    }

    /** Only one concert is shown as "Latest" on the home page. */
    private function saveFeatured(Concert $concert): void
    {
        if ($concert->is_featured) {
            Concert::whereKeyNot($concert->id)->where('is_featured', true)->update(['is_featured' => false]);
        }
    }

    private function data(Request $request, ?Concert $concert = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'event_date' => ['nullable', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'genres' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:600'],
            'body' => ['nullable', 'string'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
        ] + $this->mediaRules('image'));

        $data['image'] = $this->storeMedia($request, 'image', 'performances', $concert?->image);

        return $this->clean($data);
    }
}
