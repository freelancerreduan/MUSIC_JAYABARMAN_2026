@extends('layouts.admin')

@section('title', $concert->exists ? 'Edit concert' : 'Add concert')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ $concert->exists ? route('admin.concerts.update', $concert) : route('admin.concerts.store') }}">
    @csrf
    @if ($concert->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $concert->exists ? $concert->title : 'New concert' }}</h2><p>Performance page, top box. The concert marked “Latest” also appears on the Home page.</p></div>
      <div class="actions">
        <a href="{{ route('admin.concerts.index') }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="grid g-form">
      <div class="card">
        <div class="card-body form-grid">
          <x-admin.input name="title" label="Concert name" :value="$concert->title" :full="true" required />
          <x-admin.input name="event_date" label="Date" type="date" :value="$concert->event_date?->format('Y-m-d')" />
          <x-admin.input name="location" label="Place" :value="$concert->location" placeholder="City, Country" />
          <x-admin.input name="genres" label="Music styles" :value="$concert->genres" :full="true" />
          <x-admin.textarea name="body" label="Description" :value="plain_paragraphs($concert->body)" rows="12" hint="Performance page. Leave one empty line between paragraphs. **word** = bold, *word* = italic." />
          <x-admin.textarea name="excerpt" label="Short description for Home page" :value="$concert->excerpt" rows="3" hint="Home page, “Latest” box (1–2 lines)." />
        </div>
      </div>

      <div class="card">
        <div class="card-body" style="display:grid;gap:14px">
          <x-admin.toggle name="is_featured" label="Show as “Latest” on Home page" :checked="$concert->is_featured" />
          <x-admin.toggle name="is_active" label="Show on website" :checked="$concert->is_active" />
          <x-admin.media name="image" label="Photo" :value="$concert->image" hint="Shown on the Performance page (left side, under place and music styles) and in the Home page “Latest” box." />
        </div>
      </div>
    </div>
  </form>
@endsection
