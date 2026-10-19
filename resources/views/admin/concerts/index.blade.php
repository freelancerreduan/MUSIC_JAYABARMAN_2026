@extends('layouts.admin')

@section('title', 'Performance')
@section('subtitle', 'Concerts and live shows')

@section('content')
  <div class="page-head">
    <div>
      <h2>Performances</h2>
      <p>Concerts shown at the top of the Performance page. The featured one is “Latest” on the home page.</p>
    </div>
    <div class="actions">
      <a href="{{ route('admin.videos.index', ['place' => 'performance']) }}" class="btn"><i class="bi bi-camera-video"></i>Performance videos</a>
      <a href="{{ route('admin.concerts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add performance</a>
    </div>
  </div>

  <div class="card">
    @if ($concerts->isEmpty())
      <div class="empty"><i class="bi bi-music-note-beamed"></i>No performances yet.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Date</th><th>Location</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($concerts as $concert)
              <tr>
                <td>@if ($concert->image)<img class="thumb" src="{{ thumb_url($concert->image) }}" alt="">@else<span class="thumb video"><i class="bi bi-music-note"></i></span>@endif</td>
                <td><strong>{{ $concert->title }}</strong><small>{{ $concert->eyebrow }}</small></td>
                <td>{{ $concert->event_date?->format('d M Y') ?? '—' }}</td>
                <td>{{ $concert->location ?: '—' }}</td>
                <td>
                  @include('admin.partials.status', ['active' => $concert->is_active])
                  @if ($concert->is_featured)<span class="badge tone-orange"><i class="bi bi-star-fill"></i>Featured</span>@endif
                </td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.concerts.edit', $concert) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.concerts.destroy', $concert)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
