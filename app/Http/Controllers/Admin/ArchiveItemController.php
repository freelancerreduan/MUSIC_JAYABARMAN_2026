<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\ArchiveItem;
use App\Support\ImageService;
use Illuminate\Http\Request;

class ArchiveItemController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        return view('admin.archive.index', ['items' => ArchiveItem::orderBy('sort_order')->orderByDesc('year')->get()]);
    }

    public function create()
    {
        return view('admin.archive.form', ['item' => new ArchiveItem(['is_active' => true])]);
    }

    public function store(Request $request)
    {
        ArchiveItem::create($this->data($request) + ['sort_order' => ArchiveItem::max('sort_order') + 1]);

        return redirect()->route('admin.archive.index')->with('success', 'Archive item added.');
    }

    public function edit(ArchiveItem $item)
    {
        return view('admin.archive.form', compact('item'));
    }

    public function update(Request $request, ArchiveItem $item)
    {
        $item->update($this->data($request, $item));

        return redirect()->route('admin.archive.index')->with('success', 'Archive item updated.');
    }

    public function destroy(ArchiveItem $item)
    {
        ImageService::delete($item->image);
        $item->delete();

        return back()->with('success', 'Archive item deleted.');
    }

    private function data(Request $request, ?ArchiveItem $item = null): array
    {
        $data = $request->validate([
            'year' => ['nullable', 'string', 'max:30'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'link' => ['nullable', 'url', 'max:1000'],
            'is_active' => ['boolean'],
        ] + $this->mediaRules('image'));

        $data['image'] = $this->storeMedia($request, 'image', 'archive', $item?->image);

        return $this->clean($data);
    }
}
