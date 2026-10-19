<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $videos = Video::query()
            ->when($request->place === 'performance', fn ($q) => $q->where('in_performance', true))
            ->when($request->place === 'project', fn ($q) => $q->where('in_project', true))
            ->orderBy('sort_order')->orderBy('id')
            ->get();

        return view('admin.videos.index', compact('videos'));
    }

    public function create(Request $request)
    {
        return view('admin.videos.form', ['video' => new Video([
            'is_active' => true,
            'in_project' => $request->place !== 'performance',
            'in_performance' => $request->place === 'performance',
        ])]);
    }

    public function store(Request $request)
    {
        Video::create($this->data($request) + ['sort_order' => Video::max('sort_order') + 1]);

        return redirect()->route('admin.videos.index', ['place' => $request->place])->with('success', 'Video added.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $video->update($this->data($request, $video));

        return redirect()->route('admin.videos.index', ['place' => $request->place])->with('success', 'Video updated.');
    }

    public function destroy(Video $video)
    {
        $this->deleteUpload($video->video_url);
        $video->delete();

        return back()->with('success', 'Video deleted.');
    }

    private function data(Request $request, ?Video $video = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_bn' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'in_project' => ['boolean'],
            'in_performance' => ['boolean'],
            'is_active' => ['boolean'],
        ] + $this->mediaRules('video_url', true, true), [
            'video_url.required_without' => 'Please choose a video file or paste a video link.',
            'video_url.url' => 'Please paste a full link, starting with https://',
            'video_url_file.mimetypes' => 'The video must be an MP4, WebM, OGG or MOV file.',
            'video_url_file.max' => 'The video file is too big (500 MB max).',
            'video_url_file.uploaded' => 'The video could not be uploaded. It may be too big for the server.',
        ]);

        $data['video_url'] = $this->storeMedia($request, 'video_url', 'videos', $video?->video_url, true);

        return $this->clean($data);
    }
}
