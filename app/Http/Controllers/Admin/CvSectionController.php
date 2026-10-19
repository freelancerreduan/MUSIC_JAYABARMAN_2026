<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvBlock;
use App\Models\CvSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

/** About page: the CV boxes under the profile. The website splits them into two columns by itself. */
class CvSectionController extends Controller
{
    /** Icons the admin can pick for a box. */
    const ICONS = [
        'star', 'briefcase', 'globe2', 'airplane', 'heart', 'stars', 'mask', 'easel', 'lightbulb', 'image',
        'palette', 'music-note-beamed', 'mic', 'trophy', 'mortarboard', 'people', 'camera-video', 'book', 'link-45deg',
    ];

    public function index()
    {
        return view('admin.cv.index', ['sections' => CvSection::with('blocks')->orderBy('sort_order')->get()]);
    }

    public function create()
    {
        $section = new CvSection(['icon' => 'star']);
        $section->setRelation('blocks', collect([new CvBlock(['type' => 'timeline'])]));

        return view('admin.cv.form', $this->formData($section));
    }

    public function store(Request $request)
    {
        DB::transaction(fn () => $this->save($request, new CvSection));

        return redirect()->route('admin.cv.index')->with('success', 'CV box added.');
    }

    public function edit(CvSection $section)
    {
        $section->load('blocks');

        return view('admin.cv.form', $this->formData($section));
    }

    public function update(Request $request, CvSection $section)
    {
        DB::transaction(fn () => $this->save($request, $section));

        return redirect()->route('admin.cv.index')->with('success', 'CV box updated.');
    }

    public function destroy(CvSection $section)
    {
        $section->delete();

        return back()->with('success', 'CV box deleted.');
    }

    private function formData(CvSection $section): array
    {
        $others = CvSection::whereKeyNot($section->id ?? 0)->orderBy('sort_order')->get();
        $before = $section->exists ? $others->where('sort_order', '<', $section->sort_order)->last() : $others->last();

        return [
            'section' => $section,
            'icons' => self::ICONS,
            'positions' => ['first' => 'At the top (first box)'] + $others->mapWithKeys(fn ($s) => [$s->id => 'After “'.$s->title.'”'])->all(),
            'after' => $before?->id ?? 'first',
        ];
    }

    /** The box plus its parts; parts removed from the form are deleted. */
    private function save(Request $request, CvSection $section): void
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['required', Rule::in(self::ICONS)],
            'after' => ['required', 'string'],
            'blocks' => ['array'],
            'blocks.*.id' => ['nullable', 'integer'],
            'blocks.*.heading' => ['nullable', 'string', 'max:255'],
            'blocks.*.type' => ['required', Rule::in(array_keys(CvBlock::TYPES))],
            'blocks.*.content' => ['nullable', 'string'],
        ]);

        $section->fill(['title' => $data['title'], 'icon' => $data['icon']])->save();
        $this->place($section, $data['after']);

        $keep = [];
        foreach (array_values($data['blocks'] ?? []) as $i => $row) {
            $block = $section->blocks()->find($row['id'] ?? 0) ?? new CvBlock(['cv_section_id' => $section->id]);
            $block->fill([
                'heading' => $row['heading'] ?? null,
                'type' => $row['type'],
                'content' => trim($row['content'] ?? ''),
                'sort_order' => $i,
            ])->save();
            $keep[] = $block->id;
        }
        $section->blocks()->whereNotIn('id', $keep)->get()->each->delete();
    }

    /** Puts the box right after the chosen one ("first" = at the top) and renumbers all boxes. */
    private function place(CvSection $section, string $after): void
    {
        $order = CvSection::whereKeyNot($section->id)->orderBy('sort_order')->pluck('id')->all();
        $pos = $after === 'first' ? 0 : array_search((int) $after, $order, true);
        $pos = $pos === false ? count($order) : ($after === 'first' ? 0 : $pos + 1);
        array_splice($order, $pos, 0, [$section->id]);

        foreach ($order as $i => $id) {
            CvSection::whereKey($id)->update(['sort_order' => $i]);
        }
    }
}
