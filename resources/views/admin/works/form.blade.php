@extends('layouts.admin')

@section('title', $work->exists ? 'Edit image card' : 'Add image card')

@section('content')
  <form method="POST" enctype="multipart/form-data" action="{{ $work->exists ? route('admin.works.update', $work) : route('admin.works.store') }}">
    @csrf
    @if ($work->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $work->exists ? $work->title : 'New image card' }}</h2><p>Project page, top: a big photo card that opens a link when clicked.</p></div>
      <div class="actions">
        <a href="{{ route('admin.works.index') }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="card" style="max-width:860px">
      <div class="card-body form-grid">
        <x-admin.input name="title" label="Title on the card" :value="$work->title" required hint="Bangla or English." />
        <x-admin.input name="source" label="Channel / newspaper name" :value="$work->source" hint="Small text above the title, e.g. Jugantor." />
        <x-admin.input name="link" label="Link to open" type="url" :value="$work->link" :full="true" placeholder="https://…" hint="Facebook, YouTube or news page link." />
        <x-admin.media name="image" label="Card photo" :value="$work->image" />
        <x-admin.toggle name="is_active" label="Show on website" :checked="$work->is_active" />
      </div>
    </div>
  </form>
@endsection
