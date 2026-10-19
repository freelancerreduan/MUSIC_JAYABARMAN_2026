@extends('layouts.admin')

@php $label = \App\Models\MediaItem::TYPES[$type]; @endphp
@section('title', $label)
@section('subtitle', 'Press')

@section('content')
  <div class="page-head">
    <div>
      <h2>{{ $label }}</h2>
      <p>Embedded YouTube and Facebook videos on the {{ $label }} page.</p>
    </div>
    <div class="actions">
      <div class="tabs">
        @foreach (\App\Models\MediaItem::TYPES as $key => $text)
          <a href="{{ route('admin.media.index', ['type' => $key]) }}" @class(['active' => $type === $key])>{{ $text }}</a>
        @endforeach
      </div>
      <a href="{{ route('admin.media.create', ['type' => $type]) }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add item</a>
    </div>
  </div>

  <div class="card">
    @if ($items->isEmpty())
      <div class="empty"><i class="bi bi-mic"></i>Nothing here yet.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th>Source</th><th>Title</th><th>Link</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($items as $item)
              <tr>
                <td><span class="badge tone-blue">{{ $item->source ?: '—' }}</span></td>
                <td><strong class="bn">{{ $item->title }}</strong><small>{{ $item->meta }}</small></td>
                <td>@if ($item->link_url)<a href="{{ $item->link_url }}" target="_blank" rel="noopener">{{ $item->link_label }} <i class="bi bi-box-arrow-up-right"></i></a>@endif</td>
                <td>@include('admin.partials.status', ['active' => $item->is_active])</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.media.edit', [$item, 'type' => $item->type]) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.media.destroy', $item)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
