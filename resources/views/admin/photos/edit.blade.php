@extends('layouts.admin')

@section('title', 'Edit photo')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ route('admin.photos.update', [$photo, 'category' => $photo->category]) }}">
    @csrf @method('PUT')
    <div class="page-head">
      <div><h2>Edit photo</h2><p>{{ $photo->category === 'portfolio' ? 'Portfolio page' : 'Project page, Photos section' }}</p></div>
      <div class="actions">
        <a href="{{ route('admin.photos.index', ['category' => $photo->category]) }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="card" style="max-width:860px">
      <div class="card-body form-grid">
        <x-admin.media name="image" label="Photo" :value="$photo->image" hint="Choose a new file to replace this photo." />
        <x-admin.input name="caption" label="Short description" :value="$photo->caption" :full="true" hint="Not shown as text; helps Google and blind visitors." />
        <x-admin.toggle name="is_active" label="Show on website" :checked="$photo->is_active" />
      </div>
    </div>
  </form>
@endsection
