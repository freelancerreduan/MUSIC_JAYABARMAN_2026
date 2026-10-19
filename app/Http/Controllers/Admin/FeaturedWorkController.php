<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\FeaturedWork;
use App\Support\ImageService;
use Illuminate\Http\Request;

/** Project page: the big image cards at the top. */
class FeaturedWorkController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.works.index', ['works' => FeaturedWork::orderBy('sort_order')->get()]);
    }

    public function create()
    {
        return view('admin.works.form', ['work' => new FeaturedWork(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        FeaturedWork::create($this->data($request) + ['sort_order' => FeaturedWork::max('sort_order') + 1]);

        return redirect()->route('admin.works.index')->with('success', 'Card added.');
    }

    public function edit(FeaturedWork $work)
    {
        return view('admin.works.form', compact('work'));
    }

    public function update(Request $request, FeaturedWork $work)
    {
        $work->update($this->data($request, $work));

        return redirect()->route('admin.works.index')->with('success', 'Card updated.');
    }

    public function destroy(FeaturedWork $work)
    {
        ImageService::delete($work->image);
        $work->delete();

        return back()->with('success', 'Card deleted.');
    }

    private function data(Request $request, ?FeaturedWork $work = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:120'],
            'link' => ['nullable', 'url', 'max:1000'],
            'is_active' => ['boolean'],
        ] + $this->mediaRules('image', true));

        $data['image'] = $this->storeMedia($request, 'image', 'works', $work?->image);
        // Bangla titles get the Bangla font automatically
        $data['is_bangla'] = (bool) preg_match('/\p{Bengali}/u', $data['title']);

        return $this->clean($data);
    }
}
