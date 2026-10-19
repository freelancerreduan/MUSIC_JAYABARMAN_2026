@extends('layouts.admin')

@php $label = $category === 'portfolio' ? 'Portfolio' : 'Project photos'; @endphp
@section('title', $label)
@section('subtitle', 'Photo galleries')

@section('content')
  <div class="page-head">
    <div>
      <h2>{{ $label }}</h2>
      <p>{{ $category === 'portfolio' ? 'All photos on the Portfolio page.' : 'The Photos gallery at the bottom of the Project page.' }}</p>
    </div>
    <div class="actions">
      <div class="tabs">
        @foreach (\App\Models\Photo::CATEGORIES as $key => $text)
          <a href="{{ route('admin.photos.index', ['category' => $key]) }}" @class(['active' => $category === $key])>{{ $text }}</a>
        @endforeach
      </div>
      <a href="{{ route('admin.photos.create', ['category' => $category]) }}" class="btn btn-primary"><i class="bi bi-cloud-arrow-up"></i>Upload photos</a>
    </div>
  </div>

  <div class="card">
    <div class="card-head"><div><h3>{{ $photos->count() }} photos</h3><p>Click a photo to change it.</p></div></div>
    @if ($photos->isEmpty())
      <div class="empty"><i class="bi bi-images"></i>No photos yet. Visitors see “Coming soon”.</div>
    @else
      <div class="photo-grid">
        @foreach ($photos as $photo)
          <div class="photo-card">
            <a href="{{ route('admin.photos.edit', [$photo, 'category' => $photo->category]) }}"><img src="{{ thumb_url($photo->image) }}" alt="{{ $photo->caption }}" loading="lazy" @unless ($photo->is_active) style="opacity:.45" @endunless></a>
            <div class="info">
              <div class="grow">
                <div class="truncate">{{ $photo->caption ?: 'Untitled' }}</div>
                @unless ($photo->is_active)<small style="color:var(--muted)">hidden</small>@endunless
              </div>
              <a href="{{ route('admin.photos.edit', [$photo, 'category' => $photo->category]) }}" class="btn btn-sm btn-icon" title="Edit"><i class="bi bi-pencil"></i></a>
              @include('admin.partials.delete', ['action' => route('admin.photos.destroy', $photo)])
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection
