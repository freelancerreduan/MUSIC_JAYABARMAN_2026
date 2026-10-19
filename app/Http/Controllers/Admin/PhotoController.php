<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Support\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/** Photo galleries: Project page photos and the Portfolio page. */
class PhotoController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $category = $this->category($request->category);

        return view('admin.photos.index', [
            'category' => $category,
            'photos' => Photo::where('category', $category)->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.photos.create', ['category' => $this->category($request->category)]);
    }

    /** Several photos can be uploaded at once. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'category' => ['required', Rule::in(array_keys(Photo::CATEGORIES))],
            'images' => ['required', 'array', 'max:30'],
            'images.*' => ['mimes:jpg,jpeg,png,webp,gif', 'max:15360'],
        ]);

        $order = (int) Photo::where('category', $data['category'])->max('sort_order');
        foreach ($request->file('images') as $file) {
            Photo::create([
                'image' => ImageService::store($file, 'photos'),
                'caption' => Str::headline(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
                'category' => $data['category'],
                'sort_order' => ++$order,
            ]);
        }

        return redirect()->route('admin.photos.index', ['category' => $data['category']])
            ->with('success', count($request->file('images')).' photo(s) uploaded.');
    }

    public function edit(Photo $photo)
    {
        return view('admin.photos.edit', compact('photo'));
    }

    public function update(Request $request, Photo $photo)
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ] + $this->mediaRules('image', true));

        $data['image'] = $this->storeMedia($request, 'image', 'photos', $photo->image);
        $photo->update($this->clean($data));

        return redirect()->route('admin.photos.index', ['category' => $photo->category])->with('success', 'Photo updated.');
    }

    public function destroy(Photo $photo)
    {
        ImageService::delete($photo->image);
        $photo->delete();

        return back()->with('success', 'Photo deleted.');
    }

    private function category(?string $category): string
    {
        return array_key_exists($category, Photo::CATEGORIES) ? $category : 'portfolio';
    }
}
