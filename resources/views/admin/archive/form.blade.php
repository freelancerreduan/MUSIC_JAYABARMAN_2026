@extends('layouts.admin')

@section('title', $item->exists ? 'Edit archive item' : 'Add archive item')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.archive.update', $item) : route('admin.archive.store') }}">
    @csrf
    @if ($item->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $item->exists ? $item->title : 'New archive item' }}</h2><p>Archive page: one card for an old performance, exhibition or news.</p></div>
      <div class="actions">
        <a href="{{ route('admin.archive.index') }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="card" style="max-width:860px">
      <div class="card-body form-grid">
        <x-admin.input name="title" label="Title" :value="$item->title" required />
        <x-admin.input name="year" label="Year" :value="$item->year" placeholder="2008  or  2010-2014" />
        <x-admin.textarea name="description" label="Short description" :value="$item->description" rows="4" />
        <x-admin.input name="link" label="Link (optional)" type="url" :value="$item->link" :full="true" placeholder="https://…" />
        <x-admin.media name="image" label="Photo (optional)" :value="$item->image" />
        <x-admin.toggle name="is_active" label="Show on website" :checked="$item->is_active" />
      </div>
    </div>
  </form>
@endsection
