@extends('layouts.admin')

@section('title', 'CV boxes')
@section('subtitle', 'About page')

@section('content')
  <div class="page-head">
    <div><h2>CV boxes</h2><p>The boxes at the bottom of the About page (Residency Program, Workshops Given, Awards…), listed in the order they appear.</p></div>
    <div class="actions">
      <a href="{{ route('about') }}" target="_blank" class="btn"><i class="bi bi-eye"></i>View page</a>
      <a href="{{ route('admin.cv.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add new box</a>
    </div>
  </div>

  <div class="form-note" style="margin-bottom:16px"><i class="bi bi-info-circle"></i>The website places the boxes in two columns by itself, so long and short boxes always fit together. You only choose the order.</div>

  <div class="card">
    @if ($sections->isEmpty())
      <div class="empty"><i class="bi bi-journal"></i>No boxes yet. Click “Add new box”.</div>
    @else
      <ul class="list">
        @foreach ($sections as $section)
          <li>
            <span class="cv-order">{{ $loop->iteration }}</span>
            <span class="list-icon tone-blue"><i class="bi bi-{{ $section->icon ?: 'journal' }}"></i></span>
            <div class="grow" style="min-width:0">
              <strong class="truncate">{{ $section->title }}</strong>
              <small>{{ $section->blocks->sum(fn ($b) => count($b->lines())) }} lines</small>
            </div>
            <div class="end row-actions" style="display:flex;gap:6px">
              <a href="{{ route('admin.cv.edit', $section) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
              @include('admin.partials.delete', ['action' => route('admin.cv.destroy', $section), 'confirm' => 'Delete this box and everything in it?'])
            </div>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@endsection
