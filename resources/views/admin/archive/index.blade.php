@extends('layouts.admin')

@section('title', 'Archive')
@section('subtitle', 'Past work')

@section('content')
  <div class="page-head">
    <div><h2>Archive</h2><p>Older performances, exhibitions and press, shown as cards on the Archive page.</p></div>
    <div class="actions"><a href="{{ route('admin.archive.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add item</a></div>
  </div>

  <div class="card">
    @if ($items->isEmpty())
      <div class="empty"><i class="bi bi-archive"></i>The archive is empty. Visitors see “Coming soon”.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Year</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($items as $item)
              <tr>
                <td>@if ($item->image)<img class="thumb" src="{{ thumb_url($item->image) }}" alt="">@else<span class="thumb video"><i class="bi bi-archive"></i></span>@endif</td>
                <td><strong>{{ $item->title }}</strong><small>{{ Str::limit($item->description, 80) }}</small></td>
                <td>{{ $item->year ?: '—' }}</td>
                <td>@include('admin.partials.status', ['active' => $item->is_active])</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.archive.edit', $item) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.archive.destroy', $item)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
