@extends('layouts.admin')

@section('title', $video->exists ? 'Edit video' : 'Add video')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ $video->exists ? route('admin.videos.update', [$video, 'place' => request('place')]) : route('admin.videos.store', ['place' => request('place')]) }}">
    @csrf
    @if ($video->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $video->exists ? $video->title : 'New video' }}</h2><p>Upload an MP4 file, or paste a YouTube / Facebook link.</p></div>
      <div class="actions">
        <a href="{{ route('admin.videos.index', ['place' => request('place')]) }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="grid g-form">
      <div class="card">
        <div class="card-body form-grid">
          <x-admin.input name="title" label="Title" :value="$video->title" :full="true" required />
          <x-admin.input name="title_bn" label="Subtitle" :value="$video->title_bn" :full="true" hint="Performance page, under the title (e.g. the song name in Bangla)." />
          <x-admin.textarea name="body" label="Description" :value="plain_paragraphs($video->body)" rows="9" hint="Performance page, next to the video. Leave one empty line between paragraphs. **word** = bold." />
          <x-admin.media name="video_url" label="Video" :value="$video->video_url" :video="true" />
        </div>
      </div>

      <div class="card">
        <div class="card-head"><h3>Where to show</h3></div>
        <div class="card-body" style="display:grid;gap:14px">
          <x-admin.toggle name="in_project" label="Project page (video grid)" :checked="$video->in_project" />
          <x-admin.toggle name="in_performance" label="Performance page (with text)" :checked="$video->in_performance" />
          <x-admin.toggle name="is_active" label="Show on website" :checked="$video->is_active" hint="Turn off to hide without deleting." />
        </div>
      </div>
    </div>
  </form>
@endsection
