@extends('layouts.admin')

@php $pageName = \App\Models\MediaItem::TYPES[$item->type]; @endphp
@section('title', ($item->exists ? 'Edit' : 'Add').' '.$pageName.' video')

@section('content')
  <form method="POST" action="{{ $item->exists ? route('admin.media.update', [$item, 'type' => $item->type]) : route('admin.media.store', ['type' => $item->type]) }}">
    @csrf
    @if ($item->exists) @method('PUT') @endif
    <input type="hidden" name="type" value="{{ $item->type }}">

    <div class="page-head">
      <div><h2>{{ $item->exists ? 'Edit' : 'New' }} video – {{ $pageName }} page</h2><p>Just paste the normal YouTube or Facebook link. The video player is made automatically.</p></div>
      <div class="actions">
        <a href="{{ route('admin.media.index', ['type' => $item->type]) }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="grid g-form">
      <div class="card">
        <div class="card-body form-grid">
          <x-admin.input name="link_url" label="Video link" type="url" :value="$item->link_url" :full="true" required placeholder="https://www.facebook.com/…  or  https://youtu.be/…" />
          <x-admin.input name="title" label="Title" :value="$item->title" class="bn" :full="true" required hint="Bangla or English." />
          <x-admin.input name="source" label="TV / newspaper name" :value="$item->source" hint="Small coloured text, e.g. Jugantor, Channel i." />
          <x-admin.input name="meta" label="Programme name or date" :value="$item->meta" hint="Grey line under the title." />
          <x-admin.toggle name="is_active" label="Show on website" :checked="$item->is_active" />
        </div>
      </div>
      @if ($item->embed_url)
        <div class="card">
          <div class="card-head"><h3>Preview</h3></div>
          <div class="card-body"><iframe src="{{ $item->embed_url }}" style="width:100%;aspect-ratio:16/9;border:0;border-radius:10px" loading="lazy" allowfullscreen></iframe></div>
        </div>
      @endif
    </div>
  </form>
@endsection
