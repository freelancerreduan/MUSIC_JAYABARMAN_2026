<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/** Home "About the artist" text and the portrait, shared with the About page. */
class ProfileContentController extends Controller
{
    use HandlesUploads;

    public function edit()
    {
        return view('admin.home-about');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'home_intro' => ['nullable', 'string'],
        ] + $this->mediaRules('portrait'));

        $data['portrait'] = $this->storeMedia($request, 'portrait', 'profile', setting('portrait'));
        // The About page form only has the photo, so keep the text when it is not sent
        if (! $request->has('home_intro')) {
            unset($data['home_intro']);
        }
        Setting::put($this->clean($data));

        return back()->with('success', 'Saved.');
    }
}
