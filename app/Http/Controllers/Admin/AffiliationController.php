<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
use Illuminate\Http\Request;

/** About page: "Current Status" cards. */
class AffiliationController extends Controller
{
    public function index()
    {
        return view('admin.affiliations.index', ['affiliations' => Affiliation::orderBy('sort_order')->get()]);
    }

    public function create()
    {
        return view('admin.affiliations.form', ['affiliation' => new Affiliation]);
    }

    public function store(Request $request)
    {
        Affiliation::create($this->data($request) + ['sort_order' => Affiliation::max('sort_order') + 1]);

        return redirect()->route('admin.affiliations.index')->with('success', 'Card added.');
    }

    public function edit(Affiliation $affiliation)
    {
        return view('admin.affiliations.form', compact('affiliation'));
    }

    public function update(Request $request, Affiliation $affiliation)
    {
        $affiliation->update($this->data($request));

        return redirect()->route('admin.affiliations.index')->with('success', 'Card updated.');
    }

    public function destroy(Affiliation $affiliation)
    {
        $affiliation->delete();

        return back()->with('success', 'Card deleted.');
    }

    private function data(Request $request): array
    {
        return $request->validate([
            'role' => ['required', 'string', 'max:120'],
            'organization' => ['required', 'string', 'max:1000'],
            'url' => ['nullable', 'url', 'max:500'],
        ]);
    }
}
