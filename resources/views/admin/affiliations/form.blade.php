@extends('layouts.admin')

@section('title', $affiliation->exists ? 'Edit status card' : 'Add status card')

@section('content')
  <form method="POST" action="{{ $affiliation->exists ? route('admin.affiliations.update', $affiliation) : route('admin.affiliations.store') }}">
    @csrf
    @if ($affiliation->exists) @method('PUT') @endif

    <div class="page-head">
      <div><h2>{{ $affiliation->exists ? $affiliation->role : 'New status card' }}</h2><p>About page, “Current Status”: one small box.</p></div>
      <div class="actions">
        <a href="{{ route('admin.affiliations.index') }}" class="btn">Cancel</a>
        <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>Save</button>
      </div>
    </div>

    <div class="card" style="max-width:860px">
      <div class="card-body form-grid">
        <x-admin.input name="role" label="Position" :value="$affiliation->role" required placeholder="e.g. Founder Member" />
        <x-admin.input name="url" label="Website (optional)" type="url" :value="$affiliation->url" placeholder="https://…" />
        <x-admin.textarea name="organization" label="Group / organisation" :value="$affiliation->organization" rows="4" hint="One per line." />
      </div>
    </div>
  </form>
@endsection
