@extends('layouts.admin')

@section('title', 'Videos')
@section('subtitle', 'Project and Performance videos')

@section('content')
  <div class="page-head">
    <div>
      <h2>Videos</h2>
      <p>Choose where each video appears: the Project page grid, the Performance page, or both.</p>
    </div>
    <div class="actions">
      <div class="tabs">
        <a href="{{ route('admin.videos.index') }}" @class(['active' => ! request('place')])>All</a>
        <a href="{{ route('admin.videos.index', ['place' => 'project']) }}" @class(['active' => request('place') === 'project'])>Project</a>
        <a href="{{ route('admin.videos.index', ['place' => 'performance']) }}" @class(['active' => request('place') === 'performance'])>Performance</a>
      </div>
      <a href="{{ route('admin.videos.create', ['place' => request('place')]) }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add video</a>
    </div>
  </div>

  <div class="card">
    @if ($videos->isEmpty())
      <div class="empty"><i class="bi bi-camera-video"></i>No videos here yet.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Shown on</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($videos as $video)
              <tr>
                <td>
                  @if ($video->poster)<img class="thumb" src="{{ thumb_url($video->poster) }}" alt="">
                  @else<span class="thumb video"><i class="bi bi-{{ $video->isExternal() ? 'link-45deg' : 'play-btn' }}"></i></span>@endif
                </td>
                <td><strong>{{ $video->title }}</strong><small>{{ $video->meta ?: $video->video_url }}</small></td>
                <td>
                  @if ($video->in_project)<span class="badge tone-blue">Project</span>@endif
                  @if ($video->in_performance)<span class="badge tone-violet">Performance</span>@endif
                </td>
                <td>@include('admin.partials.status', ['active' => $video->is_active])</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ media_url($video->video_url) }}" target="_blank" class="btn btn-sm btn-icon" title="Open"><i class="bi bi-play-fill"></i></a>
                  <a href="{{ route('admin.videos.edit', [$video, 'place' => request('place')]) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.videos.destroy', $video)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
