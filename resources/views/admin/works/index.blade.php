@extends('layouts.admin')

@section('title', 'Featured work')
@section('subtitle', 'Project page')

@section('content')
  <div class="page-head">
    <div><h2>Featured work</h2><p>The large cards at the top of the Project page. Each card opens its link in a new tab.</p></div>
    <div class="actions"><a href="{{ route('admin.works.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i>Add card</a></div>
  </div>

  <div class="card">
    @if ($works->isEmpty())
      <div class="empty"><i class="bi bi-collection-play"></i>No featured work yet.</div>
    @else
      <div class="table-wrap">
        <table class="table">
          <thead><tr><th></th><th>Title</th><th>Link</th><th>Status</th><th class="num">Action</th></tr></thead>
          <tbody>
            @foreach ($works as $work)
              <tr>
                <td><img class="thumb" src="{{ thumb_url($work->image) }}" alt=""></td>
                <td><strong @class(['bn' => $work->is_bangla])>{{ $work->title }}</strong><small>{{ $work->source }}</small></td>
                <td style="max-width:260px">@if ($work->link)<a href="{{ $work->link }}" target="_blank" rel="noopener" class="truncate" style="display:block">{{ $work->link }}</a>@endif</td>
                <td>@include('admin.partials.status', ['active' => $work->is_active])</td>
                <td class="num"><div class="row-actions">
                  <a href="{{ route('admin.works.edit', $work) }}" class="btn btn-sm"><i class="bi bi-pencil"></i>Edit</a>
                  @include('admin.partials.delete', ['action' => route('admin.works.destroy', $work)])
                </div></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
